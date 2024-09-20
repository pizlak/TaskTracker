@extends('layouts.app')

@section('title', 'Test')

@section('content')
<body>
<div>
   <h1>Всего задач в ДБ: {{ $tasks->count() }}</h1>
    <hr>
</div>
@foreach($users as $user)
    <div>ID пользователя: {{ $user->id }}</div>
    <div>Кол-во выполненых задач: {{ $user->tasks->count() }}</div>
    <hr>
@endforeach
</body>
@endsection
