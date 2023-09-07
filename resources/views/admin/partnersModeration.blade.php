@extends('admin.layout')


@section('content')
    <div class="row">
        <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">
        <div class="col-auto mr-auto btn-margined">
            <button type="submit" class="btn btn-dark" onclick="window.location='{{ url("newPartner") }}'">Добавить
            </button>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
            @foreach($partners as $item)
                <div class="col">
                    <div class="row">
                        <div class="partner-card shadow-sm" style="max-width: 150rem">
                            <div class="row">
                                <img style="margin-left: auto; margin-right: auto"
                                     src="{{ asset('storage/partnerPhoto/' . $item['photo'] . '.jpg') }}"
                                     alt="Card image cap">
                            </div>
                            <div class="row" style="align-content: center">
                                <p>{{ $item['name'] }}</p>
                            </div>
                            <div class="row">
                                <a href="{{ route("deletePartner", ['id' => $item['id']]) }}"
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
            @endforeach
        </div>
    </div>
@endsection
