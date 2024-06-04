@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Редактирование данных') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label"><strong>Имя</strong></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="floatingInput" value="{{ $user->name }}">
                        </div>
                        <label class="col-sm-3 col-form-label mt-2"><strong>Электронная почта</strong></label>
                        <div class="col-sm-9 mt-2">
                            <input type="text" class="form-control" name="email" id="floatingInput" value="{{ $user->email }}">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Изменить данные</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="card-header">{{ __('Изменение пароля') }}</div>
                <div class="card-body">
                    <form  method="post" action="{{ route('profile.edit.password') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"><strong>Введите старый пароль</strong></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="old_password" id="floatingInput">
                            </div>
                            <label class="col-sm-3 col-form-label"><strong>Введите новый пароль</strong></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="new_password" id="floatingInput">
                            </div>
                            <label class="col-sm-3 col-form-label mt-1"><strong>Повторите новый пароль</strong></label>
                            <div class="col-sm-9 mt-4">
                                <input type="password" class="form-control" name="confirmed_password" id="floatingInput">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Изменить пароль</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
