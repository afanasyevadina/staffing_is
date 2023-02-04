@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Карточка сотрудника</h1>
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <p>
                        <b>ФИО:</b> {{ $employee->fullName }}
                    </p>
                    <p>
                        <b>ИИН:</b> {{ $employee->iin }}
                    </p>
                    <p>
                        <b>Дата рождения:</b> {{ $employee->birthday ? \Carbon\Carbon::create($employee->birthday)->format('d.m.Y') : '' }}
                    </p>
                    <p>
                        <b>Пол:</b> {{ $employee->gender ? 'Женский' : 'Мужской' }}
                    </p>
                    <p>
                        <b>Количество детей:</b> {{ $employee->children_count }}
                    </p>
                    <p>
                        <b>Дата трудоустройства:</b> {{ $employee->employed_date ? \Carbon\Carbon::create($employee->employed_date)->format('d.m.Y') : '' }}
                    </p>
                    <p>
                        <b>Дата увольнения:</b> {{ $employee->fired_date ? \Carbon\Carbon::create($employee->fired_date)->format('d.m.Y') : '-' }}
                    </p>
                    <p>
                        <b>Стаж:</b> {{ $employee->experience?->format('o лет n месяцев j дней') }}
                    </p>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-light mb-4" data-bs-toggle="modal" data-bs-target="#edit">
                        <i class="fas fa-pen"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="edit">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form action="{{ route('employees.edit', $employee->id) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Редактировать данные сотрудника</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label>Фамилия</label>
                            <input type="text" class="form-control" name="last_name" required autocomplete="off" value="{{ $employee->last_name }}">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Имя</label>
                            <input type="text" class="form-control" name="first_name" required autocomplete="off" value="{{ $employee->first_name }}">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Отчество</label>
                            <input type="text" class="form-control" name="middle_name" autocomplete="off" value="{{ $employee->middle_name }}">
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <label>ИИН</label>
                            <input type="text" class="form-control" name="iin" required maxlength="12" autocomplete="off" value="{{ $employee->iin }}">
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <label>Дата рождения</label>
                            <input type="date" class="form-control" name="birthday" required value="{{ $employee->birthday }}">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Количество детей</label>
                            <input type="number" class="form-control" name="children_count" value="{{ $employee->children_count }}">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Пол</label>
                            <select name="gender" class="form-control">
                                <option value="0" {{ $employee->gender ? '' : 'selected' }}>Мужской</option>
                                <option value="1" {{ $employee->gender ? 'selected' : '' }}>Женский</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    <h3 class="mb-4">Должности</h3>
    <table class="table mb-5">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Позиция</th>
            <th>Кафедра</th>
            <th>Количество ставок</th>
            <th>Дата трудоустройства</th>
            <th>Дата увольнения</th>
        </tr>
        </thead>
        <tbody>
        @forelse($employee->positions as $position)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $position->name }}</td>
                <td>{{ $position->pivot->department->name }}</td>
                <td>{{ $position->pivot->positions_count }}</td>
                <td>{{ $position->pivot->employed_date ? \Carbon\Carbon::create($position->pivot->employed_date)->format('d.m.Y') : '' }}</td>
                <td>{{ $position->pivot->fired_date ? \Carbon\Carbon::create($position->pivot->fired_date)->format('d.m.Y') : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-4">Декретные отпуска</h3>
        <a href="#" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#add">Добавить</a>
    </div>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($employee->maternityLeaves as $maternityLeave)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $maternityLeave->start_date ? \Carbon\Carbon::create($maternityLeave->start_date)->format('d.m.Y') : '' }}</td>
                <td>{{ $maternityLeave->end_date ? \Carbon\Carbon::create($maternityLeave->end_date)->format('d.m.Y') : '' }}</td>
                <td class="text-end text-nowrap">
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#edit-{{ $maternityLeave->id }}">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete-{{ $maternityLeave->id }}">
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
    @foreach($employee->maternityLeaves as $maternityLeave)
        <div class="modal fade" tabindex="-1" id="delete-{{ $maternityLeave->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('maternity-leaves.delete', [$employee->id, $maternityLeave->id]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Удалить запись</h5>
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
        <div class="modal fade" tabindex="-1" id="edit-{{ $maternityLeave->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('maternity-leaves.edit', [$employee->id, $maternityLeave->id]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Редактировать запись</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label>Дата начала</label>
                            <input type="date" name="start_date" class="form-control" autocomplete="off" value="{{ $maternityLeave->start_date }}">
                        </div>
                        <div class="mb-4">
                            <label>Дата окончания</label>
                            <input type="date" name="end_date" class="form-control" autocomplete="off" value="{{ $maternityLeave->end_date }}">
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
            <form action="{{ route('maternity-leaves.create', $employee->id) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Добавить запись</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label>Дата начала</label>
                            <input type="date" name="start_date" class="form-control" autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label>Дата окончания</label>
                            <input type="date" name="end_date" class="form-control" autocomplete="off">
                        </div>
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
