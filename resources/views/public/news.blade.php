<section class="page-section" id="partners">
    <h1 style="display:flex; justify-content: center; margin-bottom: 30px">Что нового</h1>

    <style>
        .hidden {
            display: none;
        }

        .my-slider {
            width: 50%;
            margin: 10vh auto 0 auto;
        }

        /*.my-slider > div {
            display: inline-block;
        }
*/
        #slideshow {
            margin-left: auto;
            margin-right: auto;
            position: relative;
            width: 100%;
            height: 350px;
        }

        #slideshow > div {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .slider-button {
            width: 47%;
            font-size: 56px;
            color: #9FA8DA;
            text-decoration: none;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
            background-color: #e7e7e7;
        }
    </style>

    <script>
        const main = function () {
            let paused = false;
            let prevChange = 0;

            $('.arrowR').click(function () {
                paused = true;
                if ((new Date()).getTime() - prevChange < 1000) {
                    return;
                }

                let d = 500;
                for (let i = 100; i >= 50; i--) {
                    d += 10;
                    (function (i, d) {
                        setTimeout(function () {
                            document.getElementById("news-card-id").style.background = "rgba(231, 231, 231, " + i / 100 + ")";
                        }, d);
                    })(i, d);
                }

                d = 500;
                for (let i = 75; i <= 150; i++) {
                    d += 10;
                    (function (i, d) {
                        setTimeout(function () {
                            document.getElementById("news-card-id").style.background = "rgba(231, 231, 231, " + i / 150 + ")";
                        }, d);
                    })(i, d);
                }


                $('#slideshow > div:first')
                    .fadeOut(1000)
                    .next()
                    .fadeIn(1000)
                    .end()
                    .appendTo('#slideshow');
                prevChange = (new Date()).getTime();
            });

            $('.arrowL').click(function () {
                paused = true;
                if ((new Date()).getTime() - prevChange < 1000) {
                    return;
                }

                $('#slideshow > div:last')
                    .fadeIn(1000)
                    .prependTo('#slideshow')
                    .next()
                    .fadeOut(1000)
                    .end();
                prevChange = (new Date()).getTime();
            });

            setInterval(function () {
                if ((new Date()).getTime() - prevChange < 1000) {
                    return;
                }

                if (paused === false) {
                    $('#slideshow > div:first')
                        .fadeOut(1000)
                        .next()
                        .fadeIn(1000)
                        .end()
                        .appendTo('#slideshow');
                }
                prevChange = (new Date()).getTime();
            }, 5000);
        };

        $(document).ready(main);
    </script>

    <script>
        function changeSliderSizeIfNeeded() {
            if (window.outerHeight < window.outerWidth) {
                document.getElementById("my_slider").setAttribute("style", "width:50%");
                document.getElementById("slideshow").setAttribute("style", "height:350px");
            } else {
                document.getElementById("my_slider").setAttribute("style", "width:80%");
                if (window.outerHeight > window.outerWidth * 1.5) {
                    document.getElementById("slideshow").setAttribute("style", "height:500px");
                }
            }
        }

        addEventListener("DOMContentLoaded", changeSliderSizeIfNeeded);
        addEventListener("resize", changeSliderSizeIfNeeded);
    </script>

    @if($newsAll && sizeof($newsAll) > 0)
        <div class="my-slider" id="my_slider">
            <div class="row">
                <div class="row" id="slideshow">
                    @php($cnt = 0)
                    @foreach($newsAll as $item)
                        <div class="@if($cnt > 0)hidden @endif row">
                            @php($cnt++)
                            <div class="news-card shadow-sm" id="news-card-id">
                                @if($agent->isDesktop())
                                    <div class="d-flex justify-content-start bd-highlight mb-3"
                                         style="width: 100%; height: 100%">
                                        <div class="p-2 bd-highlight" style="width: 40%">
                                            <img style="width: 100%"
                                                 src="{{ asset('storage/newsPhoto/' . $item->photo . '.jpg') }}"
                                                 alt="Card image cap">
                                        </div>

                                        <div class="p-2 bd-highlight" style="width: 60%; height: 100%">
                                            <div class="row"
                                                 style="text-align: center; align-content: center; height: 20%">
                                                <b style="font-size: 24px; margin-bottom: 8px">{{ $item->name }}</b>
                                            </div>

                                            <div class="row" style="text-align: justify; height: 70%">
                                                <p style="text-indent: 10px; color: #2C3E50; font-size: 16px">{{ $item->short_desk }}</p>
                                            </div>

                                            <div class="row" style="height: 20%">
                                                <a href="{{ route("moreNews", ['id' => $item->id]) }}"
                                                   class="text-decoration-none">
                                                    <button type="button" class="btn btn-dark" aria-label="Close"
                                                            style="float: right; margin-bottom: 10px">
                                                        Подробнее
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-start bd-highlight mb-3"
                                         style="width: 100%; height: 100%">
                                        <div class="p-2 bd-highlight">
                                            <div class="row"
                                                 style="text-align: center; align-content: center; height: 40%">
                                                <img style="height: 100%"
                                                     src="{{ asset('storage/newsPhoto/' . $item->photo . '.jpg') }}"
                                                     alt="Card image cap">
                                            </div>

                                            <div class="row"
                                                 style="text-align: center; align-content: center; height: 20%">
                                                <b style="font-size: 24px; margin-bottom: 8px">{{ $item->name }}</b>
                                            </div>

                                            <div class="row" style="text-align: justify; height: 30%">
                                                <p style="text-indent: 10px; color: #2C3E50; font-size: 16px">{{ $item->short_desk }}</p>
                                            </div>

                                            <div class="row" style="height: 10%">
                                                <a href="{{ route("moreNews", ['id' => $item->id]) }}"
                                                   class="text-decoration-none">
                                                    <button type="button" class="btn btn-dark" aria-label="Close"
                                                            style="float: right; margin-bottom: 10px">
                                                        Подробнее
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <a class="slider-button arrowL" style="float: left">&lt;</a>
                <a class="slider-button arrowR" style="float: right">&gt;</a>
            </div>
        </div>
        </div>
    @endif
</section>
