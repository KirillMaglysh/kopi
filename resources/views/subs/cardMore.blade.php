@extends('public.layout')

@section('content')
    @include('public.menu')

    <script>
        let canShowConnect = false;

        function confirmConnectWithUser() {
            let contactList = document.getElementById('hidden_contacts');
            if (!canShowConnect) {
                canShowConnect = confirm('Нажимая "Связаться", вы подтверждаете, что не будете использовать контакты пользователя в деструктивных или рекламных целях, таких как спам-рассылки');
            }
            if (canShowConnect) {
                contactList.style.display = 'block';
            }
        }
    </script>

    <div class="mt-5 pt-5" style="height: 20%"></div>
    <div class="mt-4 pt-4" style="display: flex; justify-content: center">
        <img style="width: 25%; max-height: 350px" src="{{ asset('storage/cardPhotos/' . $card->photo_card) }}"
             alt="Card image cap">
    </div>

    <div class="mt-3 pt-3">
        <h1 class="text-center">{{$card->dream_name}}</h1>
    </div>

    <div class="mt-3 pt-3" style="width: 100%; text-align: center; display: flex; justify-content: center">
        <i class="text-center" style="max-width: 60%; display: flex; flex-wrap: wrap">{{$card->description}}</i>
    </div>

    <div class="mt-3 pt-3" style="width: 100%; text-align: center; display: flex; justify-content: center">
        <div class="d-flex justify-content-center bd-highlight mb-1"
             style="height: 100%; width: 100%">
            <div class="p-2 bd-highlight" style="width: 7%; min-width: 70px">
                <img class="card-self-photo" style="height: auto;"
                     src="{{ asset('storage/selfPhoto/' . $user->self_photo)}}"
                     alt="Card image cap">
            </div>
        </div>
    </div>

    <div class="mt-0 pt-0" style="width: 100%; text-align: center; display: flex; justify-content: center">
        <p class="text-center" style="font-size: 20px; display: flex; flex-wrap: wrap">{{$user->name}}</p>
    </div>

    <div class="mt-0 pt-0" style="width: 100%; text-align: center; display: flex; justify-content: center">
        <div class="mb-3 skill-table">
            <table id="skill-table" class="styled-table-card-more">
                <thead>
                <tr>
                    <th>Скилл</th>
                    <th width="30%">Цена (рубли)</th>
                    <th width="15%">Часы</th>
                </tr>
                </thead>
                <tbody>
                @php($names = json_decode($user->skill_names))
                @php($prices = json_decode($user->skill_prices))
                @php($hours = json_decode($user->skill_hour))
                @for($i = 0; $i < sizeof($names); $i++)
                    <tr>
                        <td>{{$names[$i]}}</td>
                        <td>{{$prices[$i]}}</td>
                        <td>{{$hours[$i]}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

    <div id="hidden_contacts" style="display:none">
        <div class="mt-1 pt-1">
            <div class="text-center">
                <b>Телеграм:</b>
            </div>
            <div class="col" style="display: flex; justify-content: center">
                <a href="{{$user->tg_link}}" class="text-center">{{$user->tg_link}}</a>
            </div>
        </div>

        <div class="mt-1 pt-1">
            <div class="text-center">
                <b>Вконтакте:</b>
            </div>
            <div class="col" style="display: flex; justify-content: center">
                <a href="{{$user->vk_link}}" class="text-center">{{$user->vk_link}}</a>
            </div>
        </div>
    </div>

    <div class="mt-2 pt-2"
         style="width: 100%; text-align: center; display: flex; justify-content: center; margin-bottom: 32px">
        <button onclick="confirmConnectWithUser()" class="btn btn-primary"
                style="font-size: 20px; display: flex; flex-wrap: wrap">Связаться
        </button>
    </div>
@endsection
