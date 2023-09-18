@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div class="col-12 mt-5">
                <form enctype="multipart/form-data" method="post" @if($edit) action="{{ route('editOld.save') }}"
                      @else action="{{ route('newNews.save') }}" @endif>
                    @csrf
                    @if (!empty($userId))
                        <input type="hidden" class="form-control" name="userId" value="{{ $userId }}">
                    @endif
                    @if (!empty($news->id))
                        <input type="hidden" class="form-control" name="news_id" value="{{ $news->id }}">
                    @endif


                    <div class="mb-3">
                        <label for="name" class="form-label">Заголовок</label>
                        <input placeholder="Заголовок..." type="text" name="name" class="form-control"
                               id="name" @if($edit) value="{{$news->name}}" @endif>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Фото</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        <p>формат jpg, jpeg, png</p>
                    </div>

                    @if ($edit)
                        <img id="current_photo" class="card-img-left" width="100px"
                             src="{{ asset('storage/newsPhoto/' . $news->photo) }}"
                             alt="CurrentPhoto.jpg" style="margin-bottom: 10px">
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Краткое описание</label>
                        <input placeholder="Краткое описание..." type="text" name="short_desk" class="form-control"
                               id="short_desk" @if($edit) value="{{$news->short_desk}}" @endif>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Длинное описание</label>
                        <input placeholder="Полное описание..." type="text" name="long_desk" class="form-control"
                               id="long_desk" @if($edit) value="{{$news->long_desk}}" @endif>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
