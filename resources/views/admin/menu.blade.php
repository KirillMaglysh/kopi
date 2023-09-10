<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            @if(auth()->user()->id !== _ADMIN_)
                <a href="{{ route('myCard') }}"
                   class="nav-link {{ url()->current() === route('myCard') ? 'active' : ''}}">
                    <i class="nav-icon fa-solid fas fa-database"></i>
                    <p>
                        Мои карточки
                    </p>
                </a>
                <a href="{{ route('myDreamers') }}"
                   class="nav-link {{ url()->current() === route('myDreamers') ? 'active' : ''}}">
                    <i class="nav-icon fa-solid fas fa-heart"></i>
                    <p>
                        Мои мечтатели
                    </p>
                </a>
                <a href="{{ route('info') }}" class="nav-link {{ url()->current() === route('info') ? 'active' : ''}}">
                    <i class="nav-icon fa-solid fas fa-pen"></i>
                    <p>
                        О себе
                    </p>
                </a>
            @endif
            <a href="{{ route('self') }}" class="nav-link {{ url()->current() === route('self') ? 'active' : ''}}">
                <i class="nav-icon fa-solid fas fa-question"></i>
                <p>
                    Самозанятость
                </p>
            </a>
            @if (auth()->user()->id === _ADMIN_)
                <a href="{{ route('moderation') }}"
                   class="nav-link {{ url()->current() === route('moderation') ? 'active' : ''}}">
                    <i class="nav-icon fa-solid fas fa-check"></i>
                    <p>
                        Модерация карточек
                    </p>
                </a>
                <a href="{{ route('selfModeration') }}"
                   class="nav-link {{ url()->current() === route('selfModeration') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Модерация справок
                    </p>
                </a>
                <a href="{{ route('partnersModeration') }}"
                   class="nav-link {{ url()->current() === route('partnersModeration') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                        Наши партнеры
                    </p>
                </a>
                <a href="{{ route('newsModeration') }}"
                   class="nav-link {{ url()->current() === route('newsModeration') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Новости
                    </p>
                </a>
            @endif
        </li>
    </ul>
</nav>

