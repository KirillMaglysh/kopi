<section class="page-section" id="partners">
    <h1 style="display:flex; justify-content: center; margin-bottom: 30px">Что нового</h1>

    <style>
        .hidden {
            display: none;
        }

        .my-slider {
            margin: 0;
            max-width: 750px;
            margin: 10vh auto 0 auto;
        }

        .my-slider > div {
            display: inline-block;
        }

        #slideshow {
            margin: 0;
            position: relative;
            width: 620px;
            height: 250px;
        }

        #slideshow > div {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        #slideshow img {
            width: 100%;
            margin: 0;
            border: solid 1px #283593;
        }

        .slider-button {
            width: 40px;
            font-size: 64px;
            display: inline-block;
            color: #9FA8DA;
            text-decoration: none;
            text-align: center;
            vertical-align: middle;
            line-height: 400px;
            font-weight: bold;
            padding: 0 10px;
            cursor: pointer;
        }
    </style>

    <script>
        const main = function () {
            let paused = false;

            $('.arrowR').click(function () {
                paused = true;
                $('#slideshow > div:first')
                    .fadeOut(1000)
                    .next()
                    .fadeIn(1000)
                    .end()
                    .appendTo('#slideshow');
            });

            $('.arrowL').click(function () {
                paused = true;
                $('#slideshow > div:last')
                    .fadeIn(1000)
                    .prependTo('#slideshow')
                    .next()
                    .fadeOut(1000)
                    .end();
            });

            setInterval(function () {
                if (paused === false) {
                    $('#slideshow > div:first')
                        .fadeOut(1000)
                        .next()
                        .fadeIn(1000)
                        .end()
                        .appendTo('#slideshow');
                }
            }, 5000);
        };

        $(document).ready(main);
    </script>

    @if($newsAll && sizeof($newsAll) > 0)
        <div class="my-slider">
            <a class="slider-button arrowL">&lt;</a>
            <div id="slideshow">
                @php($cnt = 0)
                @foreach($newsAll as $item)
                    <div class="@if($cnt > 0)hidden @endif row">
                        @php($cnt++)
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
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="slider-button arrowR">&gt;</a>
        </div>
    @endif
</section>
