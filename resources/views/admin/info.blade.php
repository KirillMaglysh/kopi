@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">

            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-12 mt-5">
                <form enctype="multipart/form-data" method="post" action="{{ route('info.save') }}">
                    @csrf
                    @if (!empty($userId))
                        <input type="hidden" class="form-control" name="userId" value="{{ $userId }}">
                    @endif
                    <div class="mb-3">
                        <div class="row">
                            <label for="self_photo" class="form-label">Фото профиля (jpg)</label>
                        </div>
                        @if ($user->self_photo)
                            <img id="current_photo" class="card-img-left" width="100px"
                                 src="{{ asset('storage/selfPhoto/' . $user->self_photo . '.jpg') }}"
                                 alt="CurrentPhoto.jpg">
                        @endif

                        <input placeholder="" type="file" class="form-control" name="self_photo" id="self_photo">
                    </div>

                    <div class="mb-3">
                        <label for="tg_link" class="form-label">Ник в telegram</label>
                        <input placeholder="https://t.me/..." type="url" name="tg_link" class="form-control"
                               id="tg_link" value="{{$user->tg_link}}">
                    </div>
                    <div class="mb-3">
                        <label for="vk_link" class="form-label">Ник в vk</label>
                        <input placeholder="https://vk.com/..." type="url" name="vk_link" class="form-control"
                               id="vk_link" value="{{$user->vk_link}}">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="qr_photo" class="form-label">QR-код для оплаты (jpg)</label>
                        </div>

                        @if ($user->self_photo)
                            <img id="current_photo" class="card-img-left" width="100px"
                                 src="{{ asset('storage/cardQrs/' . $user->qr_photo . '.jpg') }}"
                                 alt="CurrentPhoto.jpg">
                        @endif
                        <input placeholder="" type="file" class="form-control" name="qr_photo" id="qr_photo">
                    </div>

                    <div class="mb-3 skill-table">
                        <label for="skill-table" class="form-label">Ваши скиллы</label>
                        <table id="skill-table" class="styled-table">
                            <thead>
                            <tr>
                                <th>Скилл</th>
                                <th width="30%">Цена (рубли)</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(empty($user->skill_names))
                                <tr class="active-row">
                                    <td>
                                        <input placeholder="Название..." type="text" name="skill_0_name"
                                               class="form-control"
                                               id="skill_0_name">
                                    </td>
                                    <td>
                                        <input placeholder="Цена..." type="text" name="skill_0_price"
                                               class="form-control"
                                               id="skill_0_price">
                                    </td>
                                    <td width="15%">
                                        <button onclick="removeSkill(this)"
                                                class="btn btn-social btn-close btn-close-self"></button>
                                    </td>
                                </tr>
                            @else
                                @php($names = json_decode($user->skill_names))
                                @php($prices = json_decode($user->skill_prices))
                                @for($i = 0; $i < sizeof($names); $i++)
                                    <tr class="active-row">
                                        <td>
                                            <input type="text"
                                                   value="{{$names[$i]}}"
                                                   name={{'skill_'.$i.'_name'}}
                                                   class="form-control"
                                                   id={{'skill_'.$i.'_name'}}>
                                        </td>
                                        <td>
                                            <input type="text"
                                                   value="{{$prices[$i]}}"
                                                   name={{'skill_'.$i.'_price'}}
                                                   class="form-control"
                                                   id={{'skill_'.$i.'_price'}}>
                                        </td>
                                        <td width="15%">
                                            <button onclick="removeSkill(this)"
                                                    class="btn btn-social btn-close btn-close-self"></button>
                                        </td>
                                    </tr>
                                @endfor
                            @endif
                            </tbody>
                        </table>

                        <button class="button-add" onclick="addSkill(event)">
                            <span>Добавить скилл</span>
                        </button>

                    </div>
                    <script>
                        function addSkill(event) {
                            event.preventDefault()
                            let table = document.getElementById("skill-table");
                            let tbody = table.getElementsByTagName("tbody")[0];

                            let newRow = document.createElement("tr");
                            newRow.classList.add("active-row");

                            let nameCell = document.createElement("td");
                            let nameInput = document.createElement("input");
                            nameInput.setAttribute("type", "text");
                            nameInput.setAttribute("placeholder", "Название...");
                            nameInput.setAttribute("name", "skill_" + tbody.childElementCount + "_name");
                            nameInput.setAttribute("class", "form-control");
                            nameCell.appendChild(nameInput);

                            let priceCell = document.createElement("td");
                            let priceInput = document.createElement("input");
                            priceInput.setAttribute("type", "text");
                            priceInput.setAttribute("placeholder", "Цена...");
                            priceInput.setAttribute("name", "skill_" + tbody.childElementCount + "_price");
                            priceInput.setAttribute("class", "form-control");
                            priceCell.appendChild(priceInput);

                            let removeButtonCell = document.createElement("td");
                            let removeButton = document.createElement("button");
                            removeButton.setAttribute("onclick", "removeSkill(this)");
                            removeButton.setAttribute("class", "btn btn-social btn-close btn-close-self");
                            removeButtonCell.appendChild(removeButton);

                            newRow.appendChild(nameCell);
                            newRow.appendChild(priceCell);
                            newRow.appendChild(removeButtonCell);

                            tbody.appendChild(newRow);
                        }

                        function removeSkill(button) {
                            let row = button.parentNode.parentNode;
                            row.parentNode.removeChild(row);
                        }

                    </script>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
