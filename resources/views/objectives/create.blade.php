@extends('layouts.app')

@section('title', 'Novo Objetivo')

@section('content')
<h2>Novo Objetivo</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('objectives.store') }}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo</label>
        <select name="type" class="form-control" required>
            <option value="estrategico">estratégico</option>
            <option value="tatico">tático</option>
            <option value="operacional">operacional</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">requirements (uma linha por item)</label>
        <textarea name="requirements" class="form-control" rows="3" placeholder="ex: requisito 1&#10;requisito 2"></textarea>
        <small class="text-muted">use linhas separadas para cada requisito.</small>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('objectives.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
