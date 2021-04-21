<!DOCTYPE html>
<html lang="@lang('template.lng')">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="@lang('template.description')"/>
    <meta name="author" content="Webpagestudio"/>
    <title>@lang('template.title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            crossorigin="anonymous"></script>
    @livewireStyles
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="/dashboard">@lang('template.navbar')</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <div class=" d-md-inline-block form-inline ml-auto mr-0 ml-auto">
        <ul class="navbar-nav d-md-inline-block">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/user/profile">@lang('template.profile')</a>
                    <a class="dropdown-item" href="/user/api-tokens">@lang('template.api')</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            @lang('template.logout')
                        </a>
                    </form>
                </div>
            </li>
        </ul>
        @include('layouts.lng')
    </div>
    <div class="loader"></div>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">@lang('template.core')</div>

                    <a class="nav-link" href="/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                        @lang('template.calendar')
                    </a>
                    <a class="nav-link" href="/analytics">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        @lang('template.analytics')
                    </a>
                    <a class="nav-link" href="/export-import">
                        <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                        @lang('template.export-import') <span class="badge bg-danger mx-2">dev.</span>
                    </a>
                    <div class="sb-sidenav-menu-heading">@lang('template.customization')</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                        @lang('template.incomes')
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ Request::is('income*') ? "show" : null }}" id="collapseLayouts"
                         aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav" id="incomeNav">
                            <a class="nav-link {{ Request::is('income/*') ? "active" : null }}"
                               href="/income">@lang('template.list-incomes')</a>
                            <a class="nav-link {{ Request::is('income-type*') ? "active" : null }}"
                               href="/income-type">@lang('template.type-incomes')</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCosts"
                       aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                        @lang('template.costs')
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ Request::is('costs*') ? "show" : null }}" id="collapseCosts"
                         aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav" id="incomeNav">
                            <a class="nav-link {{ Request::is('costs/*') ? "active" : null }}"
                               href="/costs">@lang('template.list-costs')</a>
                            <a class="nav-link {{ Request::is('costs-type*') ? "active" : null }}"
                               href="/costs-type">@lang('template.type-costs')</a>
                        </nav>
                    </div>
                    <a class="nav-link {{ Request::is('settings/*') ? "active" : null }}" href="/settings">
                        <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                        @lang('template.settings')
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">@lang('template.logged-id'): {{ Auth::user()->name }}</div>
                <div class="small">@lang('template.ver'): {{env('APP_VERSION')}}</div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                @section('sidebar')
                @show
                <div class="container">
                    {{ (isset($slot)) ? $slot : null}}
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; webpagestudio 2020 - @php echo date('Y');@endphp</div>
                    <div>
                        <ul class="navbar-nav d-md-inline-block">
                            <li class="nav-item dropdown">
                                <a href="/help" class="dropdown-item">@lang('template.help')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@include('layouts.modal', ['day' => 'language'])
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.js"
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
<script src="/js/scripts.js"></script>
@livewireScripts
</body>
</html>
