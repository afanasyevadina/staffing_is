@extends('layouts.app')
@section('content')
    <h1 class="mb-4">
        <a href="{{ route('departments') }}" class="text-decoration-none">Кафедры</a> / {{ $department->name }}
    </h1>
    <div class="d-flex justify-content-end">
        <a href="#" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#add">Добавить</a>
    </div>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Кол-во позиций</th>
            <th>Кол-во сотрудников</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($department->positions as $departmentPosition)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('departments.positions.view', [$department->id, $departmentPosition->id]) }}" class="text-decoration-none">
                        {{ $departmentPosition->name }}
                    </a>
                </td>
                <td>{{ $departmentPosition->pivot->positions_count }}</td>
                <td>{{ $department->activeEmployees()->where('position_id', $departmentPosition->id)->count() }}</td>
                <td class="text-end text-nowrap">
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#edit-{{ $departmentPosition->id }}">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete-{{ $departmentPosition->id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @foreach($department->positions as $departmentPosition)
        <div class="modal fade" tabindex="-1" id="delete-{{ $departmentPosition->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('departments.positions.delete', [$department->id, $departmentPosition->id]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Удалить позицию</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Вы уверены?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="edit-{{ $departmentPosition->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('departments.positions.edit', [$department->id, $departmentPosition->id]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Редактировать позицию</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Количество ставок</label>
                        <input type="number" name="positions_count" class="form-control" autocomplete="off" value="{{ $departmentPosition->pivot->positions_count }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('departments.positions.create', $department->id) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Добавить позицию</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label>Должность</label>
                        <select name="position_id" class="form-control">
                            <option value="">-</option>
                            @foreach($positions->whereNotIn('id', $department->positions->pluck('id')) as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Количество ставок</label>
                        <input type="number" name="positions_count" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
