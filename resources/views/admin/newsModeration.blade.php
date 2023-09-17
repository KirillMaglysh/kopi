@extends('admin.layout')

@section('content')
    <div class="row">
        <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('dist/css/magnific-popup.css')}}">

        <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
            <button>
                <a href="#popup-info" class="open-popup"
                   style="text-decoration: none;">
                    Click to Open PopUp
                </a>
            </button>
            <!-- Popup to display -->
            <div id="popup-info" class="mfp-hide" style=
                "text-align:center;
                background:white;height:600px;">

                <h1 style="color: green;">
                    GEEKSFORGEEKS
                </h1>

                <div style="font-size: 15px;
            font-weight: bold;">
                    WELCOME TO GEEKSFORGEEKS
                </div>
            </div>

            <script src=
                        "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
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
                                        src="{{ asset('storage/newsPhoto/' . $item->photo . '.jpg') }}"
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
                                <a href="{{ route("deleteNews", ['id' => $item->id]) }}"
                                   class="text-decoration-none">
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
            @endforeach
        </div>
    </div>
@endsection
