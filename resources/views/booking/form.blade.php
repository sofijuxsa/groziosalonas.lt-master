@extends('layouts.app')

<title>Rezervacija</title>
<script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(function chooseService() {

            document.getElementById('chooseService').addEventListener('change', function() {

                var service_id = this.value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: "{{ route('artist.filter') }}",
                    type: 'post',
                    data: {id: service_id},
                    dataType: 'json',
                    success: function(response) {

                        var select = $('#chooseArtist').empty();

                        select.append( '<option value="-1">Pasirinkite meistrą</option>');

                        $.each(response, function(index, artist) {
                            select.append( '<option id="chooseArtist" value="'
                                + artist.id
                                + '">'
                                + artist.name
                                + '</option>');
                        });

                    },
                    error: function (response) {
                        console.log('Error', response);
                    }
                });
            });
        });
    </script>

    <script>
        $(function chooseArtist() {

            document.getElementById('chooseArtist').addEventListener('change', function() {

                var artist = this.value;

                $.ajax({
                    url: "{{ route('schedule.filter') }}",
                    method: 'post',
                    data: {id: artist},
                    dataType: 'json',
                    success: function (response) {

                        function disableDates(date) {
                            var string = $.datepicker.formatDate('yy-mm-dd', date);
                            return [response.indexOf(string) == -1];
                        }

                        $("#datepicker").datepicker({
                            beforeShowDay: disableDates,
                            minDate: 0,
                            maxDate: +30,
                            dateFormat: 'yy-mm-dd', })

                        $('input.date-pick').datepicker().on('change', function (ev) {
                            console.log(1)

                                var artist = $('#chooseArtist').val();
                                var date = $(this).val();

                                $.ajax
                                ({
                                    type: "post",
                                    url: "{{route ('booking.filter')}}",
                                    data: {artist: artist, date: date},
                                    dataType: 'json',
                                    success: function (response) {

                                        $("#timepicker").timepicker({
                                            minTime: '08:00',
                                            maxTime: '19:00',
                                            timeFormat: 'H:i',
                                            step: 15,
                                            disableTimeRanges: response,
                                        })
                                    }
                                });
                        });
                        },
                        error: function (response) {
                            console.log('Error', response);
                    }
                });
            });
        });
    </script>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rezervacija') }}</div>
                    <div class="card-body">
                        <form class="form" method="POST" action="{{ route('booking.store') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input id="name" type="text" name="name" class="form-control"
                                       placeholder="Vardas">
                                <input id="email" type="email" name="email" class="form-control"
                                       placeholder="El. paštas">
                                <input id="phone_number" type="text" name="phone_number" class="form-control"
                                       placeholder="Tel. numeris">
                                <label for="services">Pasirinkite paslaugą:</label> <br>
                                    <select name="chooseService" id="chooseService" >
                                        @foreach($services as $service)
                                            <optgroup label="{{$service->name}}">
                                                @foreach($service->children as $child)
                                                    <option id="service" value="{{$child->id}}">{{$child->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select><br>
                                <select name="chooseArtist" id="chooseArtist"></select><br>
                                    <input type="text" id="datepicker" name="date" class="date-pick"><br>
                                        <input id="timepicker" type="text" name="time">
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Rezervuoti</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
