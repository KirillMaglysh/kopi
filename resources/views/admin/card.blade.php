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
                        <label for="skills" class="form-label">Skills</label>
                        <input placeholder="Какими навыками за благодарность ты поделишься с skilleром?" type="text" class="form-control" name="skills" aria-describedby="emailHelp">
                        <p>Пример skill: Видеомонтаж</p>
                    </div>
                    <div class="mb-3">
                        <label for="gratitude" class="form-label">Опиши предоставляемые skills подробнее?</label>
                        <input placeholder="Подробнее пункт выше" type="text" class="form-control" id="gratitude" name="gratitude">
                        <p>Пример: бесплатный онлайн урок по основам видеомонтажа</p>
                    </div>
                    <div class="mb-3">
                        <label for="for_what" class="form-label">На что копим?</label>
                        <input placeholder="На что тебе нужны деньги?" type="text" name="for_what" class="form-control" id="for_what">
                        <p>Пример: «iphone 13 promax»</p>
                    </div>
                    <div class="mb-3">
                        <label for="aim" class="form-label">Цель</label>
                        <input placeholder="Какая твоя цель при получении желаемого?" name="aim" type="text" class="form-control" id="aim">
                        <p>Пример: «для обучения видеомонтажу»</p>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Кратко опиши свою мечту</label>
                        <textarea class="form-control" placeholder="Кратко опиши свою идею" name="description" id="description" cols="30" rows="10"></textarea>
                        <p>Пример: бесплатный онлайн урок по основам видеомонтажа</p>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Обложка твоей заявки</label>
                        <input placeholder="" type="file" class="form-control" name="photo" id="photo">
                        <p>формат jpg</p>
                    </div>
                    <h3>Удобный формат для связи c skillером</h3>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">По номеру телефона</label>
                        <input placeholder="" type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="link_tg" class="form-label">Ссылка на твой телеграмм</label>
                        <input placeholder="" type="text" class="form-control" id="link_tg" name="link_tg">
                    </div>
                    <div class="mb-3">
                        <label for="link_vk" class="form-label">Ссылка на твой вконтакте</label>
                        <input placeholder="" type="text" class="form-control" id="link_vk" name="link_vk">
                    </div>
                    <h2>Платежные данные</h2>
                    <div class="mb-3">
                        <label for="qr" class="form-label">QR код для оплаты в формате JPG</label>
                        <input placeholder="" type="file" class="form-control" id="qr" name="qr">
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
