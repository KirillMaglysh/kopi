@extends('admin.layout')

@section('content')
    <div class="col-12 mt-2">
        @if (!empty($error))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            </div>
        @endif
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Почему я должен быть самозанятым?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Дорогой мечтатель!
                        Мы уверены, что ты обладаешь набором skiils которые
                        помогут осуществить одну, а может и множество твоих мечт.
                        Совсем скоро skillеры начнут охоту за твоими навыками, и мы
                        очень хотим, что бы ваши отношения были «прозрачными».
                        Поэтому все платежные операции возможны только для самозанятых граждан.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Что такое самозанятость?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Физические лица, перешедшие на специальный налоговый режим (самозанятые),
                        могут платить с доходов от самостоятельной деятельности налог по льготной
                        ставке 4%. Это позволяет легально вести бизнес и получать доход от подработок
                        без рисков получения штрафа за незаконную предпринимательскую деятельность.
                        Подробнее <a href="https://npd.nalog.ru/" target="_blank">на сайте</a>.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        С какого возраста можно оформить самозанятость?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Стать самозанятым может любой человек старше 16 лет.
                        Данный статус закрепляется за лицом после направления в
                        налоговую инспекцию уведомления, что занимается работой,
                        относящейся к самозанятости.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Что нужно для того, чтобы оформить самозанятость?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Регистрация без визита в инспекцию: в мобильном приложении,
                        на сайте ФНС России, через банк или портал Госуслуг.
                        Подробнее <a href="https://npd.nalog.ru/" target="_blank">на сайте</a>.
                    </div>
                </div>
            </div>
            <form enctype="multipart/form-data" action="{{ route('selfSave') }}" method="post">
                @csrf
                <div>
                    <label class="mt-3" for="fileSafe">Загрузите справку чтобы пройти модерацию</label>
                    <input class="form-control" type="file" name="fileSafe" id="fileSafe">
                </div>
                <button type="submit" class="btn btn-success mt-3">Загрузить</button>
            </form>
            @if ($moderation !== 3)
                @if (!$moderation)
                    <div class="alert alert-warning mt-3">
                        <ul>
                            <li>{{ 'Ваша справка на модерации' }}</li>
                        </ul>
                    </div>
                @else
                    <div class="alert alert-success mt-3">
                        <ul>
                            <li>{{ 'Ваша справка проверена! Можете загружать карточку!' }}</li>
                        </ul>
                    </div>
                @endif
            @endif
            @if (!empty($data))
                <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Ваша справка о самозанятости
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Справка</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" align="center">
                                <img class="card-img-left mt-3" width="300px" src="{{ asset('storage/docPhoto/' . $data['fileSelf']) }}" alt="Card image cap">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
