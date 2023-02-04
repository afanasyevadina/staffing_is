@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Новый сотрудник</h1>
    <form action="{{ route('employees.create') }}" method="POST">
        @csrf
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label>Фамилия</label>
                        <input type="text" class="form-control" name="last_name" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label>Имя</label>
                        <input type="text" class="form-control" name="first_name" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label>Отчество</label>
                        <input type="text" class="form-control" name="middle_name" autocomplete="off">
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <label>ИИН</label>
                        <input type="text" class="form-control" name="iin" required maxlength="12" autocomplete="off">
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <label>Дата рождения</label>
                        <input type="date" class="form-control" name="birthday" required>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label>Пол</label>
                        <select name="gender" class="form-control">
                            <option value="0">Мужской</option>
                            <option value="1">Женский</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label>Количество детей</label>
                        <input type="number" class="form-control" name="children_count">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection
