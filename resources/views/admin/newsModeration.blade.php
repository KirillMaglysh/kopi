@extends('admin.layout')

@section('content')
    <div class="row">
        <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('dist/css/magnific-popup.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        </script>
        <script type="text/javascript" src="{{asset('dist/js/jquery.magnific-popup.min.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function ($) {
                $('.open-popup').magnificPopup({
                    type: 'inline',

                    // Fixed position will be used
                    fixContentPos: true,

                    // Since disabled, Magnific Popup
                    // will not put close button
                    // inside content of popup
                    closeBtnInside: false,
                    preloader: false,

                    // Delay in milliseconds before
                    // popup is removed
                    removalDelay: 160,

                    // Class that is added to
                    // popup wrapper and background
                    mainClass: 'mfp-fade'
                });
            });
        </script>

        <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-dark" style="font-size: 18px"
                        onclick="window.location='{{ url("newNews") }}'">
                    Добавить
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-start bd-highlight mb-3" style="flex-wrap: wrap">
            @foreach($newsAll as $item)
                <div class="p-2 bd-highlight">
                    <div class="row">
                        <div class="news-moderation-item shadow-sm">
                            <div class="d-flex justify-content-start bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    <img
                                        src="{{ asset('storage/newsPhoto/' . $item->photo) }}"
                                        alt="Card image cap">
                                </div>

                                <div class="p-2 bd-highlight">
                                    <div class="row" style="text-align: center; align-content: center; ">
                                        <b style="font-size: 18px; margin-bottom: 4px">{{ $item->name }}</b>
                                    </div>

                                    <div class="row" style="text-align: justify;">
                                        <p style="text-indent: 10px; color: #2C3E50; font-size: 14px">{{ $item->short_desk }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a href="#more_{{$item->id}}" class="text-decoration-none open-popup">
                                    <button type="button" class="btn btn-dark" aria-label="Close"
                                            style="float: right; margin-bottom: 10px">
                                        Подробнее
                                    </button>
                                </a>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route("editNews", ['id' => $item->id]) }}"
                                       class="text-decoration-none">
                                        <button type="button" class="btn btn-dark" aria-label="Close"
                                                style="float: left; margin-bottom: 10px">
                                            Редактировать
                                        </button>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ route("deleteNews", ['id' => $item->id]) }}"
                                       class="text-decoration-none">
                                        <button type="button" class="btn btn-dark" aria-label="Close"
                                                style="float: right; margin-bottom: 10px">
                                            Удалить
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="more_{{$item->id}}" class="mfp-hide news-more-canvas">
                    <h1 style="color: black; text-align: center; margin-bottom: 10px">
                        {{$item->name}}
                    </h1>

                    <div style="overflow-y: auto; height: 90%">
                        <p style="height: 85%; text-align :justify; margin-right: 15px">
                            <img
                                src="{{ asset('storage/newsPhoto/' . $item->photo) }}"
                                class="news-more-img" alt="Card image cap">
                            {{$item->long_desk}}
                        </p>
                        @php($dateFormatted = date('d.m.Y', $item->created_at))
                        <p style="float: right">{{$dateFormatted}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
