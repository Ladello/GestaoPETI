@extends('layouts.app')

@section('title', $principle->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ $principle->title }}</h2>
    <div>
        <a href="{{ route('principles.edit', $principle) }}" class="btn btn-sm btn-primary">editar</a>
        <a href="{{ route('principles.index') }}" class="btn btn-sm btn-secondary">voltar</a>
    </div>
</div>

@if($principle->description)
    <p>{{ $principle->description }}</p>
@endif

<p><strong>prioridade:</strong> {{ $principle->priority ?? '—' }}</p>
@endsection
