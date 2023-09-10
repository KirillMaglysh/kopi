@extends('admin.layout')

@section('content')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @vite(['resources/js/app.js'])

    <div class="row">
        <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">

        <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-dark" style="font-size: 18px"
                        onclick="window.location='{{ url("newNews") }}'">
                    Добавить
                </button>
            </div>
        </div>

        <div class="slider">
            <div class="slider-item">
                F
            </div>
            <div class="slider-item">
                F
            </div>
            <div class="slider-item">
                F
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                alert("Hello")
                const slider = tns({
                    container: ".slider",
                    items: 1,
                    slideBy: "page",
                    autoplay: true,
                    controlsContainer: "#slider-controls",
                });
                if (slider.isOn) {
                    alert("Slider is ON");
                } else {
                    alert("Slider is OFF");
                }
            });
        </script>
        {{--<div class="scroll-container">
            <div class="scroll-content d-flex justify-content-start bd-highlight mb-3">
                @foreach($newsAll as $item)
                    <div class="p-2 bd-highlight">
                        <div class="row">
                            <div class="news-card shadow-sm">
                                <div class="d-flex justify-content-start bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <img
                                                src="{{ asset('storage/newsPhoto/' . $item->photo . '.jpg') }}"
                                                alt="Card image cap">
                                    </div>

                                    <div class="p-2 bd-highlight">
                                        <div class="row" style="text-align: center; align-content: center">
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

        <div class="scroll-buttons">
            <button class="scroll-button left" onclick="scrollLeft()">&lt;</button>
            <button class="scroll-button right" onclick="scrollRight()">&gt;</button>
        </div>

        <script>
            function scrollLeft() {
                const container = document.querySelector('.scroll-container');
                container.scrollRight -= 380;
            }

            function scrollRight() {
                const container = document.querySelector('.scroll-container');
                container.scrollLeft += 380;
            }
        </script>
--}}
        {{--<div class="d-flex justify-content-start bd-highlight mb-3">
            @foreach($newsAll as $item)
                <div class="p-2 bd-highlight">
                    <div class="row">
                        <div class="news-card shadow-sm">
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
        </div>--}}
    </div>
@endsection
