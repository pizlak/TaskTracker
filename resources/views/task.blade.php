@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3 row"><h1>Редактирование напоминания</h1></div>
        <form method="post" action="{{ route('task.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $task->id }}">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"><strong>Название</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="floatingInput" value="{{ $task->title }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"><strong>Описание</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" id="floatingInput"
                           value="{{ $task->description }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"><strong>Статус</strong></label>
                <div class="col-sm-10">
                    <select class="form-select" name="status"
                            aria-label=".form-select-sm example">
                        <option selected value="{{ $task->status }}">{{ $task->status }}</option>
                        <hr>
                        <option value="Выполнено">Выполнено</option>
                        <option value="Не выполнено">Не выполнено</option>
                        <option value="Выполняется">Выполняется</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"><strong>Тип</strong></label>
                <div class="col-sm-10">
                    <select class="form-select" name="type"
                            aria-label=".form-select-sm example">
                        <option selected value="{{ $task->type }}">{{ $task->type }}</option>
                        <hr>
                        <option value="Разовая задача">Разовая задача</option>
                        <option value="Задача на реализацию">Задача на реализацию</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"><strong>Приоритетность</strong></label>
                <div class="col-sm-10">
                    <select class="form-select" name="priority"
                            aria-label=".form-select-sm example">
                        <option selected value="{{ $task->priority }}">{{ $task->priority }}</option>
                        <hr>
                        <option value="Высокая">Высокая</option>
                        <option value="Средняя">Средняя</option>
                        <option value="Низкая">Низкая</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"><strong>Дата выполнения</strong></label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" id="due_date" name="due_date" value="{{ $task->due_date }}"
                           required>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection


