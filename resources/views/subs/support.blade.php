@extends('public.layout')

@section('content')
    @include('public.menu')
    <div class="mt-5 pt-5">
        <h1 class="mt-5 pt-5 text-center">Наши мечтатели</h1>
    </div>

    <div class="mt-4 pt-4" style="margin-bottom: 15px">
        <form class="search-form" method="get" action="{{route('search.skills')}}">
            @if($is_filter)
                <input class="form-control search-input" type="text" placeholder="Скилл для тебя..." id="search_skill"
                       name="search_skill" value="{{$pattern}}">
            @else
                <input class="form-control search-input" type="text" placeholder="Скилл для тебя..." id="search_skill"
                       name="search_skill">
            @endif
            <svg class="svg-inline--fa fa-magnifying-glass search-button" type="submit" aria-hidden="true"
                 focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img"
                 xmlns="http://www.w3.org/2000/svg" data-fa-i2svg="" viewBox="-128 -128 768 768">
                <path fill="currentColor"
                      d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
            </svg>
        </form>
    </div>

    <div class="container mt-2 pt-2">
        <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
            @foreach($cards as $card)
                @php($names = json_decode($card->skill_names))
                @php($prices = json_decode($card->skill_prices))

                <div class="p-2 bd-highlight card shadow-sm"
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
                                            <button type="button" class="btn btn-dark" aria-label="Close"
                                                    style="margin-bottom: 10px; margin-right: 6px">
                                                Отслеживать
                                            </button>
                                        </a>

                                        <a href="{{route('cardMore', ['id' => $card->id])}}"
                                           class="pb-2 bd-highlight text-decoration-none">
                                            <button type="button" class="btn btn-dark" aria-label="Close"
                                                    style="margin-bottom: 10px;">
                                                Подробнее
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
