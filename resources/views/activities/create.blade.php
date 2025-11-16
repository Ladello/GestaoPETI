@extends('layouts.app')

@section('title', 'Nova Atividade')

@section('content')

<h2>Nova Atividade para "{{ $project->title }}"</h2>

<form action="{{ route('projects.activities.store', $project) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="planejado">Planejado</option>
            <option value="em_andamento">Em Andamento</option>
            <option value="cancelado">Cancelado</option>
            <option value="concluido">Concluído</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Responsável</label>
        <select name="assignee_id" class="form-control">
            <option value="">Nenhum</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Voltar</a>
</form>

@endsection
