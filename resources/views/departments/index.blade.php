@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-4">Кафедры</h1>
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
        @forelse($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>
                    <a href="{{ route('departments.view', $department->id) }}" class="text-decoration-none">
                        {{ $department->name }}
                    </a>
                </td>
                <td>{{ $department->positions_count }}</td>
                <td>{{ $department->active_employees_count }}</td>
                <td class="text-end text-nowrap">
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#edit-{{ $department->id }}">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete-{{ $department->id }}">
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
    @foreach($departments as $department)
        <div class="modal fade" tabindex="-1" id="delete-{{ $department->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('departments.delete', $department->id) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Удалить кафедру</h5>
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
        <div class="modal fade" tabindex="-1" id="edit-{{ $department->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('departments.edit', $department->id) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Редактировать кафедру</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control" autocomplete="off" required value="{{ $department->name }}">
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
            <form action="{{ route('departments.create') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Добавить кафедру</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label>Название</label>
                    <input type="text" name="name" class="form-control" autocomplete="off" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
