<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Отдел кадров</title>

    <!-- Fonts -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Отдел кадров</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(\Illuminate\Support\Facades\Route::currentRouteName(), 'departments') ? 'active' : '' }}" aria-current="page" href="{{ route('departments') }}">Кафедры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(\Illuminate\Support\Facades\Route::currentRouteName(), 'positions') ? 'active' : '' }}" aria-current="page" href="{{ route('positions') }}">Справочник должностей</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(\Illuminate\Support\Facades\Route::currentRouteName(), 'employees') ? 'active' : '' }}" aria-current="page" href="{{ route('employees') }}">Все сотрудники</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(\Illuminate\Support\Facades\Route::currentRouteName(), 'reports') ? 'active' : '' }}" aria-current="page" href="{{ route('reports') }}">Отчеты</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@if(session()->get('success'))
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@if(session()->get('error'))
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
<div class="container py-4">
    @yield('content')
</div>
</body>
</html>
