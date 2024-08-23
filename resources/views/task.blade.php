@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div class="row">
                <label class="mb-1" for="title">Название задачи</label>
                    <h4><input type="text" id="title" readonly class="form-control-plaintext" value="{{ $task->title }}"></h4>
            </div>
            <div class="row">
                <label class="mb-1" for="description">Описание задачи</label>
                <div id="description" readonly class="ms-2 form-control-plaintext"><h5>{{ $task->description }}</h5></div>

            </div>
            <a class="btn btn-primary mb-3" href="{{ route('subtask.view', $task->id) }}">Добавить подзадачу</a>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if($task->subtasks->count() > 0)
        @foreach($task->subtasks as $subtask)
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <label for="">Название подзадачи:</label>
                             <strong>{{ $subtask->title }}</strong>
                        </div>
                        {{ $subtask->status }}
                    </div>
                </div>
                <div class="card-body">
                    <text class="text-muted">Описание:</text>
                    <br>
                    {{ $subtask->description }}<br>
                    <a href="{{ route('task.setting', $subtask->id) }}">Изменить подзадачу</a>
                </div>
            </div>
        @endforeach
        @else
        <div>
            <h4>У данной задачи еше нету подзадач.</h4>
        </div>
        @endif
    </div>
@endsection
