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
            <div class="row">
                <div class="col"><strong>Приоритетность:</strong><br>
                    {{ $task->priority }}</div>
                <div class="col"><strong>Дата создания задачи:</strong><br>
                    {{ $task->created_at }}</div>
                <div class="col"><strong>Сроки выполнения задачи:</strong> <br>
                    {{ $task->due_date }}</div>
                <div class="col mb-3"><strong>Статус:</strong> <br>
                    @if($task->status == 'Выполнено')
                        <span class="me-5" style="color: green">{{ $task->status }}</span>
                    @elseif($task->status == 'Не выполнено')
                        <span class="me-5" style="color: red">{{ $task->status }}</span>
                    @elseif($task->status == 'Выполняется')
                        <span class="me-5" style="color: blue">{{ $task->status }}</span>
                    @endif</div>
            </div>
            <a class="btn btn-primary mb-3" href="{{ route('subtask.view', $task->id) }}">Добавить подзадачу</a>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if($subtasks->count() > 0)
        @foreach($subtasks as $subtask)
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
            <div>
                {{ $subtasks->links() }}
            </div>
        @else
        <div>
            <h4>У данной задачи еше нету подзадач.</h4>
        </div>
        @endif
    </div>
@endsection
