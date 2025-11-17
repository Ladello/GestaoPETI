@extends('layouts.app')

@section('title', 'Editar Serviço')

@section('content')
<h2>Editar Serviço</h2>

<form action="{{ route('services.update', $service) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" rows="4" class="form-control">{{ $service->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">SLA</label>
        <input type="text" name="sla" class="form-control" value="{{ $service->sla }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Resultados esperados (uma linha por item ou JSON)</label>
        <textarea name="results_expected" rows="4" class="form-control">@if(is_array($service->results_expected)){{ implode("\n", $service->results_expected) }}@else{{ $service->results_expected }}@endif</textarea>
        <small class="text-muted">o campo aceita linhas ou um JSON array.</small>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('services.show', $service) }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
