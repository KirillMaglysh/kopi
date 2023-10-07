@extends('admin.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">

    <div class="row">
        <div class="col-auto mr-auto btn-margined">
            <button type="submit" class="btn btn-dark" onclick="window.location='{{ url("card") }}'">Создать</button>
        </div>

        <script>
            function processSumAdding(id) {
                let dif = prompt("Новые накопления:", "0");
                if (dif != null) {
                    document.getElementById("change_val_for_" + id).value = dif;
                    document.getElementById("change_val_id_" + id).value = id;
                    document.getElementById("changeCollected_" + id).click();
                }
            }
        </script>

        @if ($count == 0)
            <div class="alert alert-primary">
                <ul>
                    <li>{{ 'Тут пока пусто, скорее создавай свою первую карточку!' }}</li>
                </ul>
            </div>
        @endif
        @if (!empty($info))
            <div class="alert alert-warning">
                <ul>
                    <li>{{ $info }}</li>
                </ul>
            </div>
        @endif
        <div class="container mt-2 pt-2">
            <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
                @foreach($cards as $card)
                    @php($names = json_decode($card->skill_names))
                    @php($prices = json_decode($card->skill_prices))

                    <div class="p-2 bd-highlight card shadow-sm {{ !$card->moderation ? 'bg-danger' : 'bg-success'  }}"
                         style="@if($agent->isDesktop()) width: 70%; @else width: 90%; @endif height: 500px">
                        <div class="card-body" style="padding-right: 1px">
                            <div class="row" style="height: 100%; width: 100%">
                                @if($agent->isDesktop())
                                    <div class="col"
                                         style="height: 100%; width: 35%; display: flex; justify-content: center; align-items: center">
                                        <img class="card-img-left" style="max-width: 100%; max-height: 80%"
                                             src="{{ asset('storage/cardPhotos/' . $card->photo_card) }}"
                                             alt="Card image cap">
                                    </div>
                                @endif
                                <div class="col-5"
                                     style="@if($agent->isDesktop()) width: 65%; @else width: 100%; @endif height:100%; padding-right: 1px">
                                    <div class="row" style="height: 10%">
                                        <b style="font-size: 18px; display: flex; justify-content: center">{{ $card->dream_name }}</b>
                                    </div>

                                    <div class="row" style="height: 15%; width: 100%">
                                        <div class="d-flex justify-content-center bd-highlight mb-1"
                                             style="height: 100%; width: 100%">
                                            <div class="p-2 bd-highlight" style="width: 12%; min-width: 70px">
                                                <img class="card-self-photo" style="height: auto;"
                                                     src="{{ asset('storage/selfPhoto/' . $card->self_photo)}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="p-2 bd-highlight" style="display:flex; vertical-align: middle;">
                                                <p style="font-size: 16px; margin-bottom: auto; margin-top: auto">{{ $card->name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="height: 45%; width: 100%; margin-bottom: 12px">
                                        <div class="d-flex justify-content-center bd-highlight mb-1"
                                             style="height: 85%; width: 100%">
                                            <table id="skill-table" class="pb-2 bd-highlight styled-table-mini">
                                                <tbody>
                                                @for($i = 0; $i < min(3, sizeof($names)); $i++)
                                                    <tr>
                                                        <td>
                                                            {{$names[$i]}}
                                                        </td>
                                                        <td>
                                                            {{$prices[$i].' руб'}}
                                                        </td>
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                        @if(sizeof($names) > 3)
                                            <div class="row"
                                                 style="height: 15%; display: flex; justify-content: end">
                                                <i style="width: auto; font-size: 14px; margin-right: 30px">{{'Ещё '.(sizeof($names) - 3).'...'}}</i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row" style="height: 15%; margin-bottom: 10px">
                                        <div class="row">
                                            <b style="width: auto; margin-left: auto; margin-right: 0">Накоплено:</b>
                                        </div>
                                        <div class="row">
                                            <p style="width: auto; margin-left: auto; margin-right: 0">{{$card->collected. ' из '.$card->summa}}</p>
                                        </div>
                                    </div>
                                    <div class="row" style="height: 12%">
                                        <div class="d-flex justify-content-end bd-highlight mb-1">
                                            <a class="pb-2 bd-highlight text-decoration-none">
                                                <button data-bs-toggle="modal" data-bs-target="#addSumModal"
                                                        type="button"
                                                        class="btn btn-dark" aria-label="Close"
                                                        style="margin-bottom: 10px; margin-right: 6px">
                                                    Добавить накопления
                                                </button>

                                                <form enctype="multipart/form-data"
                                                      method="post" action="{{ route('changeSum') }}">
                                                    <div class="modal fade" id="addSumModal" tabindex="-1"
                                                         aria-labelledby="addSumModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title" id="addSumModalLabel">
                                                                        Накоплено</h3>
                                                                    <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                @csrf
                                                                <input id="change_val_id_{{$card->id}}" type="hidden"
                                                                       class="form-control" name="cardId"
                                                                       value="{{ $card->id }}">
                                                                <input id="change_val_for_{{$card->id}}" type="number"
                                                                       class="form-control" name="dif" value="0"
                                                                       style="width: 70%; align-self: center">

                                                                <button id="changeCollected_{{$card->id}}" type="submit"
                                                                        style="display: none"></button>

                                                                <div class="modal-footer">
                                                                    <button id="changeCollected_{{$card->id}}"
                                                                            type="submit"
                                                                            data-bs-dismiss="modal"
                                                                            class="btn btn-secondary">
                                                                        Сохранить
                                                                    </button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Отмена
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </a>

                                            <a href="{{route('myCardMore', ['id' => $card->id])}}"
                                               class="pb-2 bd-highlight text-decoration-none">
                                                <button type="button" class="btn btn-dark" aria-label="Close"
                                                        style="margin-bottom: 10px;">
                                                    Подробнее
                                                </button>
                                            </a>

                                            <form enctype="multipart/form-data"
                                                  method="post" action="{{ route('changeSum') }}">
                                                @csrf
                                                <input id="change_val_id_{{$card->id}}" type="hidden"
                                                       class="form-control" name="cardId" value="{{ $card->id }}">
                                                <input id="change_val_for_{{$card->id}}" type="hidden"
                                                       class="form-control" name="dif" value="0">

                                                <button id="changeCollected_{{$card->id}}" type="submit"
                                                        style="display: none"></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
