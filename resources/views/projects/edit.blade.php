@extends('layouts.app')

@section('title', 'Editar Projeto')

@section('content')

<h2>Editar Projeto</h2>

<form action="{{ route('projects.update', $project) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
    </div>

    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="description" class="form-control">{{ $project->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            @foreach(['proposta','planejado','em_andamento','cancelado','concluido'] as $status)
                <option {{ $project->status == $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Prioridade</label>
        <select name="priority" class="form-control">
            @foreach(['baixa','media','alta'] as $p)
                <option {{ $project->priority == $p ? 'selected' : '' }}>{{ $p }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Cancelar</a>
</form>

@endsection
