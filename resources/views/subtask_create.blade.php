@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Добавление подзадачи к задаче: {{ $task->title }}</h2>

        <form action="{{ route('subtask.create') }}" method="post">
            @csrf
                <div class="form-floating mb-3">
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <input type="text" class="form-control" name="title" id="floatingInput"
                           placeholder="Введите название подзадачи">
                    <label for="floatingInput">Введите название подзадачи</label>
                </div>

                <div class="form-floating">
                                        <textarea class="form-control  mt-3" name="description"
                                                  placeholder="Введите описание подзадачи"
                                                  id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Введите описание подзадачи</label>
                </div>

                <select class="form-select form-select-sm mt-3" name="priority"
                        aria-label=".form-select-sm example">
                    <option selected>Выберите степень приоритетности</option>
                    <option value="Высокая">Высокая</option>
                    <option value="Средняя">Средняя</option>
                    <option value="Низкая">Низкая</option>
                </select>
                <div class="mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Выберите срок
                        выполнения:</label>
                    <input class="form-control" type="date" id="due_date" name="due_date"
                           required>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </div>
@endsection
