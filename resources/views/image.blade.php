@extends('layouts.app')

@section('title', 'Альбом')

@section('content')
    <body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                @include('layouts.menu')
            </div>
            <div class="col-9 ms-3">
                <div class="row">
                    <div class="col-7">
                        <img class="w-100" src="{{ asset('storage/' . $image->photo) }}" alt="">
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <form action="{{ route('commentary.store', $image->id) }}" method="POST">
                                @csrf
                                <div class="row mb-1">
                                    <strong>Добавить комментарий:</strong>
                                </div>
                                <div class="row ">
                                    <div class="col-10">
                                        <input type="text" class="form-control w-100" name="text_comment"
                                               placeholder="Введите комментарий">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary rounded-circle"
                                                style="margin: 0; padding: 0; width: 40px; height: 40px; position: absolute"
                                                type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                 fill="currentColor" class="bi bi-arrow-right-circle"
                                                 viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        @foreach($image->commentaries as $commentary)
                            <div class="row">
                                <div class="row d-flex text-body-secondary pt-3">
                                    <div class="col-4">
                                        <a href="{{ route('profile.index', $commentary->user->id) }}">
                                            @if($commentary->user->images->isNotEmpty() && $commentary->user->images()->latest()->first()->photo)
                                                <div>
                                                    <img class="w-100 me-2 rounded-circle" style="width: 55px; height: 55px"
                                                         src="{{ asset('storage/' . $commentary->user->images()->latest()->first()->photo) }}"
                                                         alt="">
                                                </div>
                                            @else

                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-8">
                                        <p class="pb-3 mb-0 small lh-sm border-bottom">
                                            <strong class="d-block"><a
                                                    href="{{ route('profile.index', $commentary->user->id) }}">{{ $commentary->user->name }}</a></strong>
                                            {{ $commentary->text_comment }} <br>
                                            {{ $commentary->created_at->format('d M y') }} в {{ $commentary->created_at->format('H:i') }}<br>
                                            @if(Auth::user()->id == $commentary->user_id)
                                            <form action="{{ route('commentary.delete',  $commentary->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-primary" type="submit" value="Удалить комментарий">
                                            </form>
                                            @endif

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
