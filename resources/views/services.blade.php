@extends('layouts.app')

@section('content')
    <div class="container my-5 py-5">
        <div class="services">
            <div class="card-header">
                <h2 class="service-title">Paslaugos</h2>
            </div>
            @foreach($services as $service)
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2> {{ $service->name }} </h2>
                    </div>
                </div>
            </div>
                 @foreach($service->children as $child)
                <div class="service-list">
                    <ul>
                        <li>{{$child->name}}</li>
                    </ul>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection

