@extends('layouts.app')

@section('title', $service->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ $service->name }}</h2>
    <div>
        <a href="{{ route('services.edit', $service) }}" class="btn btn-primary btn-sm">Editar</a>
        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
    </div>
</div>

@if($service->description)
    <p>{{ $service->description }}</p>
@endif

<p><strong>SLA:</strong> {{ $service->sla ?? '—' }}</p>

<h5>Resultados esperados</h5>
@if(!empty($service->results_expected) && is_array($service->results_expected))
    <ul>
        @foreach($service->results_expected as $r)
            <li>{{ $r }}</li>
        @endforeach
    </ul>
@elseif(!empty($service->results_expected))
    <p>{{ $service->results_expected }}</p>
@else
    <p class="text-muted">nenhum resultado esperado cadastrado.</p>
@endif
@endsection
