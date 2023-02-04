@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Отчеты</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <p>
                        <a href="{{ route('reports.vacancies') }}" class="text-decoration-none">Вакансии</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.multi-position') }}" class="text-decoration-none">Больше одной ставки</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.veterans') }}" class="text-decoration-none">Ветераны</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.archive') }}" class="text-decoration-none">Архив сотрудников</a>
                    </p>
                </div>
                <div class="col-sm-6">
                    <p>
                        <a href="{{ route('reports.child-free') }}" class="text-decoration-none">Бездетные сотрудники</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.many-children') }}" class="text-decoration-none">Многодетные сотрудники</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.pensionary') }}" class="text-decoration-none">Пенсионеры</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.pre-pensionary') }}" class="text-decoration-none">Предпенсионный возраст (2 года до пенсии)</a>
                    </p>
                    <p>
                        <a href="{{ route('reports.anniversary') }}" class="text-decoration-none">Юбиляры</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
