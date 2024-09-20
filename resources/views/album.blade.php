@extends('layouts.app')

@section('title', 'Альбом')

@section('content')
    <body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('layouts.menu')
            </div>
            <div class="col-8 ms-3">
                <h2>
                    Альбом пользователя <a href="{{ route('profile.index', $user->id) }}">{{ $user->name }} {{ $user->last_name }}</a>
                </h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                    @foreach($images as $image)
                        <a href="{{ route('image.show', $image->id) }}">
                            <div class="col">
                                <div class="card shadow-sm square-image">
                                    <div class="card-body">
                                        <img class="w-100" src="{{ asset('storage/' . $image->photo) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
    <style>
        .square-image {
            width: 100%;
            padding-top: 100%;
            position: relative;
        }
        .square-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection
