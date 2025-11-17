@extends('layouts.app')

@section('title', 'Nova Meta')

@section('content')
<h2>Nova Meta para: {{ $objective->title }}</h2>

<form action="{{ route('objectives.goals.store', $objective) }}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">métrica</label>
        <input type="text" name="metric" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">valor alvo (numérico)</label>
        <input type="number" step="0.0001" name="target_value" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">rótulo do alvo (ex: 90% uptime)</label>
        <input type="text" name="target_label" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">data alvo</label>
        <input type="date" name="target_date" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">notas</label>
        <textarea name="notes" class="form-control" rows="3"></textarea>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('objectives.show', $objective) }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
