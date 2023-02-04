@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-4">Справочник должностей</h1>
        <a href="#" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#add">Добавить</a>
    </div>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Оклад</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($positions as $position)
            <tr>
                <td>{{ $position->id }}</td>
                <td>{{ $position->name }}</td>
                <td>{{ $position->salary }}</td>
                <td class="text-end text-nowrap">
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#edit-{{ $position->id }}">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete-{{ $position->id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @foreach($positions as $position)
        <div class="modal fade" tabindex="-1" id="delete-{{ $position->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('positions.delete', $position->id) }}" method="POST" class="modal-content">
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
        <div class="modal fade" tabindex="-1" id="edit-{{ $position->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('positions.edit', $position->id) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Редактировать позицию</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label>Название</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" required value="{{ $position->name }}">
                        </div>
                        <div class="mb-4">
                            <label>Тип персонала</label>
                            <select name="staff_category_id" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($staffCategories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $position->staff_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label>Оклад</label>
                            <input type="number" name="salary" class="form-control" autocomplete="off" value="{{ $position->salary }}">
                        </div>
                        <div class="mb-4">
                            <label>Краткое описание, обязанности</label>
                            <textarea name="description" class="form-control" rows="3">{{ $position->description }}</textarea>
                        </div>
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
            <form action="{{ route('positions.create') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Добавить позицию</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-4">
                        <label>Тип персонала</label>
                        <select name="staff_category_id" class="form-control">
                            <option value="">Не выбрано</option>
                            @foreach($staffCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Оклад</label>
                        <input type="number" name="salary" class="form-control" autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label>Краткое описание, обязанности</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
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
