@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('layouts.menu')
            </div>
            <div class="col-8 ms-3">
                <div class="row">
                    <div class="row"><h3>{{ $user->name }} {{ $user->last_name }}</h3></div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            @isset($profileImage)
                                <a href="{{ route('image.show', $profileImage->id) }}">
                                    <img class="w-100" src="{{ asset('storage/' . $profileImage->photo) }}" alt="Фото профиля">
                                </a>
                            @endisset
                                <a href=""><img class="w-100" src="" alt=""></a>
                                @if(request()->route('user')->id == Auth::user()->id)
                            <div><!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                    Загрузить новое фото профиля
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                        <label for="formFileMultiple" class="form-label"></label>
                                                        <input class="form-control" name="photo" type="file" id="formFileMultiple" multiple>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endif
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="row">
                                    <div class="col-4">
                                        <p style="margin-bottom: 0; margin-top: 0"> Пол: </p>
                                    </div>
                                    <div class="col-8">
                                        <p style="margin-bottom: 0; margin-top: 0">{{ $user->gender }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p style="margin-bottom: 0; margin-top: 0"> Дата рождения: </p>
                                    </div>
                                    <div class="col-8">
                                        <p style="margin-bottom: 0; margin-top: 0">{{ $user->day_of_birth }} {{ $user->month_of_birth }} {{ $user->years_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="row"></div>
                            </div>
                            <div class="row">
                                <div class="row bg-info-subtle"><strong>
                                        <a href="{{ route('album.show', request()->route('user')->id) }}"> Фотографии профиля </a>
                                    </strong></div>
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                                    @foreach($previewAlbumImages as $previewImage)
                                            <a href="{{ route('image.show', $previewImage->id) }}">
                                                <div class="col">
                                                    <div class="card shadow-sm square-image">
                                                        <div class="card-body">
                                                            <img  src="{{ asset('storage/' . $previewImage->photo) }}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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
        .row.bg-info-subtle {
            margin-bottom: 0;
        }

        .row.row-cols-1 {
            margin-top: 0;
        }
    </style>
@endsection
