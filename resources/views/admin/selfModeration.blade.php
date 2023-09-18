@extends('admin.layout')

@section('content')
    @foreach($users as $user)
        @if ($user['fileSelf'])
            <div>
                <div class="alert {{ !$user['moderation'] ? 'alert-danger' : 'alert-success'  }} mt-3">
                    <div class="card-body">
                        <h5 class="card-title">ID пользователя: {{ $user->id }}</h5><br>
                        <h6 class="card-title">Имя пользователя: {{ $user->name }}</h6><br>
                        <h6 class="card-title">Email пользователя: {{ $user->email }}</h6>
                        <p class="card-text">Внимательно проверьте справку и если уверены нажимите на зеленую кнопку</p>
                        <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Справка о самозанятости
                        </button>
                        <a type="submit" href="{{ route('selfSuccess', ['id' => $user->id]) }}" class="text-decoration-none btn btn-success btn-sm mt-2">
                            {{ !$user['moderation'] ? 'Подтвердить' : 'Уже подтверждено' }}
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Справка</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" align="center">
                                <img class="card-img-left mt-3" width="300px" src="{{ asset('storage/selfPhoto/' . $user['fileSelf']) }}" alt="Card image cap">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
