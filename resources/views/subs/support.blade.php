@extends('public.layout')

@section('content')
    @include('public.menu')
    <!-- /.navbar -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

    <div class="mt-5 pt-5">
        <h1 class="mt-5 pt-5 text-center">Наши мечтатели</h1>
    </div>

    <div class="mt-4 pt-4">
        <form class="search-form">
            <input class="search-input" type="text" placeholder="Скиллы для тебя...">
            <svg class="svg-inline--fa fa-magnifying-glass search-button" type="submit" aria-hidden="true"
                 focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img"
                 xmlns="http://www.w3.org/2000/svg" data-fa-i2svg="" viewBox="-128 -128 768 768">
                <path fill="currentColor"
                      d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
            </svg>
        </form>
    </div>

    <div class="container mt-2 pt-2">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($data as $card)
                {{--                    {{ dd($card) }}--}}
                @if ($card['moderation'])
                    <div class="col pt-5">
                        <div class="card shadow-sm" style="max-width: 120rem;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <img class="card-img-left" width="150px"
                                             src="{{ asset('storage/cardPhotos/' . $card['photo_card'] . '.jpg') }}"
                                             alt="Card image cap">
                                    </div>
                                    <div class="col">
                                        <p class="card-text">{{ $card['skills'] }}</p>
                                        <p class="card-text">{{ $card['gratitude'] }}</p>
                                        <p class="card-text">{{ $card['aim'] }}</p>
                                        <p class="card-text">{{ $card['description'] }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button href="{{ route('cardItem', ['id' => 1]) }}" type="button"
                                                        class="btn btn-sm btn-secondary">Подробнее
                                                </button>
                                            </div>
                                            <a href="{{ $card['link_tg'] }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                            QR
                                        </button>
                                        <p class="mt-1">Необходимая сумма: {{ $card['summa'] }}</p>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">QR код для
                                                            оплаты</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" align="center">
                                                        <img class="card-img-left mt-3" width="300px"
                                                             src="{{ asset('storage/cardQrs/' . $card['photo_qr'] . '.jpg') }}"
                                                             alt="Card image cap">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
