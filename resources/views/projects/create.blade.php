@extends('layouts.app')

@section('title', 'Novo Projeto')

@section('content')

<h2>Novo Projeto</h2>

<form action="{{ route('projects.store') }}" method="POST" class="mt-3">
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
        <select name="status" class="form-control" required>
            <option value="proposta">Proposta</option>
            <option value="planejado">Planejado</option>
            <option value="em_andamento">Em Andamento</option>
            <option value="cancelado">Cancelado</option>
            <option value="concluido">Concluído</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Prioridade</label>
        <select name="priority" class="form-control" required>
            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Responsável</label>
        <select name="owner_id" class="form-control">
            <option value="">— nenhum —</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('owner_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Voltar</a>
</form>

@endsection
