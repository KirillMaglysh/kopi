@extends('admin.layout')

@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="{{ asset('dist/css/magnific-popup.css') }}">
    <script src="{{ asset('dist/js/jquery.magnific-popup.js') }}"></script>

    <script>
        $(document).ready(function () {
                $('.show-popup').magnificPopup({
                    type: 'inline',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = this.st.el.attr('data-effect');
                        }
                    },
                    midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                })
            }
        );
    </script>

    <div class="row">
        <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">

        <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
            <div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
                <h2>Zoom popup</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti itaque ipsam illum eaque, odio
                    cumque quam asperiores dolores labore ab.</p>
            </div>

            <ul>
                <li><a href="#test-popup" class="show-popup" data-effect="mfp-zoom-in">Зум</a></li>
            </ul>

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
