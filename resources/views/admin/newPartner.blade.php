@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div class="col-12 mt-5">
                <form enctype="multipart/form-data" method="post" action="{{ route('partner.save') }}">
                    @csrf
                    @if (!empty($userId))
                        <input type="hidden" class="form-control" name="userId" value="{{ $userId }}">
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Название организации</label>
                        <input placeholder="Партнер..." type="text" name="name" class="form-control"
                               id="name">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Фото</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        <p>формат jpg</p>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
