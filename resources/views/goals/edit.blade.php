@extends('layouts.app')

@section('title', 'Editar Meta')

@section('content')
<h2>Editar Meta</h2>

<form action="{{ route('goals.update', $goal) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">métrica</label>
        <input type="text" name="metric" class="form-control" value="{{ $goal->metric }}">
    </div>

    <div class="mb-3">
        <label class="form-label">valor alvo (numérico)</label>
        <input type="number" step="0.0001" name="target_value" class="form-control" value="{{ $goal->target_value }}">
    </div>

    <div class="mb-3">
        <label class="form-label">rótulo do alvo (ex: 90% uptime)</label>
        <input type="text" name="target_label" class="form-control" value="{{ $goal->target_label }}">
    </div>

    <div class="mb-3">
        <label class="form-label">data alvo</label>
        <input type="date" name="target_date" class="form-control" value="{{ optional($goal->target_date)->format('Y-m-d') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">notas</label>
        <textarea name="notes" class="form-control" rows="3">{{ $goal->notes }}</textarea>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('objectives.show', $objective) }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
