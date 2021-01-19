<ul class="navbar-nav d-md-inline-block">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <span class="fas fa-globe-asia fa-fw"></span>@if(Request::is('/')) @lang('template.languages') @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <button class="dropdown-item event-lng {{ session()->get('locale')=='uk' ? 'active' : null }}"
                    data-url="/language/uk"
                    data-toggle="modal"
                    data-target="#add_language"
                    data-info="">
                <img src="{{asset('img/lng/ua.png')}}" alt="uk">
            </button>
            <button class="dropdown-item event-lng {{ session()->get('locale')=='ru' ? 'active' : null }}"
                    data-url="/language/ru"
                    data-toggle="modal"
                    data-target="#add_language"
                    data-info="">
                <img src="{{asset('img/lng/ru.png')}}" alt="ru">
            </button>
            <button class="dropdown-item event-lng {{ session()->get('locale')=='en' ? 'active' : null }}"
                    data-url="/language/en"
                    data-toggle="modal"
                    data-target="#add_language"
                    data-info="">
                <img src="{{asset('img/lng/en.png')}}" alt="en">
            </button>
        </div>
    </li>
</ul>
