@extends('layouts.app')
<title>Redaguoti profilį</title>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Redaguoti profilį') }}</div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('artist.update', $artist->id) }}">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label>{{$artist->name}}</label>
                                    <input value="{{$artist->name}}" type="text" name="name" class="form-control"
                                           placeholder="{{$artist->name}}">
                                    <input value="{{$artist->last_name}}" type="text" name="last_name" class="form-control"
                                           placeholder="Pavardė">
                                    <input value="{{$artist->password}}" name="password" type="password" class="form-control"
                                           placeholder="**********">
                                    <input value="{{$artist->email}}" name="email" type="text" class="form-control"
                                           placeholder="email">
                                    <input value="{{$artist->phone_number}}" name="phone_number" type="text" class="form-control"
                                           placeholder="Tel. numeris">
                                    <input type="submit" value="Atnaujinti" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
