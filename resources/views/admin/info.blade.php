@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div>
                <h2>Внимательно введите все необходимые данные!</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-12 mt-5">
                <form enctype="multipart/form-data" method="post" action="{{ route('card.save') }}">
                    @csrf
                    @if (!empty($userId))
                        <input type="hidden" class="form-control" name="userId" value="{{ $userId }}">
                    @endif

                    <div class="mb-3">
                        <label for="dream_name" class="form-label">Твоя мечта</label>
                        <input placeholder="На что нужны деньги?" type="text" name="dream_name" class="form-control" id="dream_name">
                        <p>Пример: «MacBook Pro»</p>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Кратко опиши свою мечту</label>
                        <textarea class="form-control" placeholder="Кратко опиши свою идею" name="description" id="description" cols="30" rows="10"></textarea>
                        <p>Пример: «Я давно увлекаюсь дазайном и обработкой фотографий, а для этих целей MacBook - просто идеальный комьютер»</p>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Обложка твоей заявки</label>
                        <input placeholder="" type="file" class="form-control" name="photo" id="photo">
                        <p>формат jpg</p>
                    </div>

                    <div class="mb-3">
                        <label for="summa" class="form-label">Введите необходимую сумму</label>
                        <input placeholder="" type="text" class="form-control" id="summa" name="summa">
                        <p>Число без знаков, например: 100000</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
