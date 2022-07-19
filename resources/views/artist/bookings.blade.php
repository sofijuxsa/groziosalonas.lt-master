@extends('layouts.app')

<head>
    <title>Mano rezervacijos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css">

    <style>
        th {
            line-height: 25px;
            min-height: 25px;
            height: 25px;
        }
    </style>
</head>

@section('content')
    <table
        id="table"
        data-toggle="table"
        data-search="true"
        data-pagination="true">
        <thead>
        <tr>
            <th data-sortable="true">Id</th>
            <th data-sortable="true">Kliento vardas</th>
            <th data-sortable="true">El. paštas</th>
            <th data-sortable="true">Tel. numeris</th>
            <th data-sortable="true">Data</th>
            <th data-sortable="true">Rezervacijos pradžia</th>
            <th data-sortable="true">Rezervacijos pabaiga</th>
            <th data-sortable="true">Ar aktyvi</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
        @foreach($bookings as $booking)
            <tr>
                <td>{{$booking->id}}</td>
                <td>{{$booking->client->name}}</td>
                <td>{{$booking->client->email}}</td>
                <td>{{$booking->client->phone_number}}</td>
                <td>{{$booking->date}}</td>
                <td>{{$booking->start_time}}</td>
                <td>{{$booking->end_time}}</td>
                <td>{{$booking->active}}</td>
                <td>
                    <form method="POST" action="{{route('booking.delete', [$booking->id])}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light" value="{{$booking->id}}" name="delete">Ištrinti</button>
                    </form>
                    <form method="POST" action="{{route('booking.activity', $booking->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light" value="{{$booking->id}}" name="activity">Pakeisti statusą</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
</body>
</html>
@endsection
