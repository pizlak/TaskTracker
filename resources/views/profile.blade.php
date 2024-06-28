@extends('layouts.app')

@section('content')

    <body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4 class="mt-3">Все задачи пользователя {{ __($user->name) }}</h4>
                <div class="mb-3">
                    <form method="post" action="{{ route('telegram.sendMessage') }}">
                        @csrf
                        <b><input type="text" class="form-control" name="tg-message" required></b>
                    <button  class="btn btn-outline-primary mt-3" type="submit">Отправить сообщение в телеграм </button>
                    </form>
                </div>
            </div>
            <div class="col-8">

                <div><!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                        Создать новое напоминание
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Создание нового напоминания</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('task.create') }}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="title" id="floatingInput"
                                                   placeholder="Введите название напоминания">
                                            <label for="floatingInput">Введите название напоминания</label>
                                        </div>

                                        <div class="form-floating">
                                        <textarea class="form-control  mt-3" name="description"
                                                  placeholder="Введите описание напоминания"
                                                  id="floatingTextarea"></textarea>
                                            <label for="floatingTextarea">Введите описание напоминания</label>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Создать</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
                    <div class="accordion-item">
                        @foreach($tasks as $index => $task)
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $index }}">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $index }}" aria-expanded="false"
                                                aria-controls="collapse-{{ $index }}">
                                            <div class="d-flex justify-content-between w-100">
                                                <span><strong>{{ $task->title }}</strong></span>
                                                @if($task->status == 'Выполнено')
                                                   <span class="me-5" style="color: green">{{ $task->status }}</span>
                                                @elseif($task->status == 'Не выполнено')
                                                    <span class="me-5" style="color: red">{{ $task->status }}</span>
                                                @elseif($task->status == 'Выполняется')
                                                    <span class="me-5" style="color: blue">{{ $task->status }}</span>
                                                @endif
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $index }}" class="accordion-collapse collapse"
                                         aria-labelledby="heading-{{ $index }}"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $task->description }}
                                            <hr>
                                            <div class="row">
                                                <div class="col"><strong>Приоритетность:</strong><br>
                                                    {{ $task->priority }}</div>
                                                <div class="col"><strong>Дата создания задачи:</strong><br>
                                                    {{ $task->created_at }}</div>
                                                <div class="col"><strong>Сроки выполнения задачи:</strong> <br>
                                                    {{ $task->due_date }}</div>
<<<<<<< HEAD

=======
>>>>>>> a05bb86e698045a597706ddf931e42d32fde3390
                                            </div>
                                            <hr>
                                            <a href="{{ route('task.setting', $task->id) }}">Изменить напоминание</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>





        </div>

@endsection
