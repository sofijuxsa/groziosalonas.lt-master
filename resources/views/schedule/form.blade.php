@extends('layouts.app')
<title>Grafikas</title>
<script src="{{ asset('js/app.js') }}"></script>
@section('page-script')
    <script type ="text/javascript">
        $(document).ready( function () {

            $.ajax({
                url: "{{ route('schedule.filter2') }}",
                data:{},
                method:'get',
                dataType: 'json',
                success: function(response) {

                    console.log(response);

                    function disableDates(date) {
                        var string = $.datepicker.formatDate('yy-mm-dd', date);
                        return [response.indexOf(string) == -1];
                    };

                    function available(date) {

                        dmy = date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getDate();

                        console.log(dmy+' : '+($.inArray(dmy, response)));

                        if ($.inArray(dmy, response) != -1) {
                            return [true];
                        } else {
                            return [false];
                        }
                    };

                    $( "#datepickerDisable1" ).datepicker({
                        beforeShowDay: disableDates,
                        dateFormat: 'yy-mm-dd',
                        maxDate: +30,
                        minDate : 0,
                        timepicker: false,
                    });

                    $( "#datepickerEnable" ).datepicker({
                        beforeShowDay: available,
                        dateFormat: 'yy-mm-dd',
                        maxDate: +30,
                        minDate : 0,
                        timepicker: false,
                    });
                }});
        });
    </script>

    @section('content')
        <div class="container">
            <div class="row-cols-auto">
                <div class="flex-row float-lg-start">
                    <form id="disableDay" method="POST" action="{{ route ('schedule.disableDay')}}">
                        @csrf
                        <input id="datepickerDisable1" type="text" name="disableDay">
                        <input type="submit" value="Deaktyvuoti dieną" class="btn btn-primary">
                    </form>
                </div>
                <div class="flex-row float-lg-end">
                    <form id="enableDay" method="POST" action="{{ route ('schedule.enableDay')}}">
                        @csrf
                        <input id="datepickerEnable" type="text" name="enableDay">
                        <input type="submit" value="Aktyvuoti dieną" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    @endsection
