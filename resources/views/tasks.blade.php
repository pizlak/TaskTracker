<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-3"><h4 class="mt-3">Все задачи пользователя {{ $user->name }}</h4></div>
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
                                        <textarea class="form-control  mt-3" name="description" placeholder="Введите описание напоминания"
                                                  id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Введите описание напоминания</label>
                                    </div>

                                    <select class="form-select form-select-sm mt-3" name="priority"
                                            aria-label=".form-select-sm example">
                                        <option selected>Выберите степень приоритетности</option>
                                        <option value="1">Высокая</option>
                                        <option value="2">Средняя</option>
                                        <option value="3">Низкая</option>
                                    </select>
                                    <div class="mt-3">
                                        <label for="exampleFormControlInput1" class="form-label">Выберите срок выполнения:</label>
                                        <input class="form-control" type="date" id="due_date" name="due_date" required>
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $index }}" aria-expanded="false"
                                            aria-controls="collapse-{{ $index }}">
                                        <div class="d-flex justify-content-between w-100">
                                            <span><strong>{{ $task->title }}</strong></span>
                                            @if($task->status == 1)
                                                <span class="me-5" style="color: green">Выполнено</span>
                                            @elseif($task->status == 2)
                                                <span class="me-5" style="color: red">Не выполнено</span>
                                            @elseif($task->status == 3)
                                                <span class="me-5" style="color: blue">Выполняется</span>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
