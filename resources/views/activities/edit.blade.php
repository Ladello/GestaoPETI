@extends('layouts.app')

@section('title', 'Editar Atividade')

@section('content')

<h2>Editar Atividade</h2>

<form action="{{ route('activities.update', $activity) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="title" class="form-control" value="{{ $activity->title }}" required>
    </div>

    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="description" class="form-control">{{ $activity->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            @foreach(['planejado','em_andamento','cancelado','concluido'] as $s)
                <option value="{{ $s }}" {{ $activity->status == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Responsável</label>
        <select name="assignee_id" class="form-control">
            <option value="">Nenhum</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" {{ $activity->assignee_id == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Cancelar</a>
</form>

@endsection
