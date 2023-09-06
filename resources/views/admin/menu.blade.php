<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('myCard') }}" class="nav-link {{ url()->current() === route('myCard') ? 'active' : ''}}">
                <i class="nav-icon fa-solid fas fa-database"></i>
                <p>
                    Мои карточки
                </p>
            </a>
            <a href="{{ route('myDreamers') }}" class="nav-link {{ url()->current() === route('myDreamers') ? 'active' : ''}}">
                <i class="nav-icon fa-solid fas fa-heart"></i>
                <p>
                    Мои мечтатели
                </p>
            </a>
            <a href="{{ route('self') }}" class="nav-link {{ url()->current() === route('self') ? 'active' : ''}}">
                <i class="nav-icon fa-solid fas fa-question"></i>
                <p>
                    Самозанятость
                </p>
            </a>
            <a href="{{ route('info') }}" class="nav-link {{ url()->current() === route('info') ? 'active' : ''}}">
                <i class="nav-icon fa-solid fas fa-pen"></i>
                <p>
                    Личная информация
                </p>
            </a>
            @if (auth()->user()->id === 1)
                <a href="{{ route('moderation') }}" class="nav-link {{ url()->current() === route('moderation') ? 'active' : ''}}">
                    <i class="nav-icon fa-solid fas fa-check"></i>
                    <p>
                        Модерация карточек
                    </p>
                </a>
                <a href="{{ route('selfModeration') }}" class="nav-link {{ url()->current() === 1 ? 'active' : ''}}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Модерация справок
                    </p>
                </a>
            @endif
        </li>
    </ul>
</nav>

