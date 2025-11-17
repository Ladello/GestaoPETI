@extends('layouts.app')

@section('title', $objective->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ $objective->title }}</h2>
    <div>
        <a href="{{ route('objectives.edit', $objective) }}" class="btn btn-sm btn-warning">Editar</a>
        <a href="{{ route('objectives.index') }}" class="btn btn-sm btn-secondary">Voltar</a>
    </div>
</div>

@if($objective->description)
    <p>{{ $objective->description }}</p>
@endif

<p><strong>tipo:</strong> {{ $objective->type }}</p>

@if(!empty($objective->requirements))
    <h5>requisitos</h5>
    <ul>
    @foreach($objective->requirements as $req)
        <li>{{ $req }}</li>
    @endforeach
    </ul>
@endif

<hr>

<h4>metas</h4>
<a href="{{ route('objectives.goals.create', $objective) }}" class="btn btn-primary btn-sm mb-3">Nova Meta</a>

@if($objective->goals->isEmpty())
    <div class="alert alert-info">nenhuma meta cadastrada.</div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>métrica</th>
            <th>valor alvo</th>
            <th>data alvo</th>
            <th>ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($objective->goals as $g)
        <tr>
            <td>{{ $g->metric }}</td>
            <td>{{ $g->target_label ?? $g->target_value }}</td>
            <td>{{ $g->target_date ? $g->target_date->format('d/m/Y') : '—' }}</td>
            <td>
                <a href="{{ route('goals.edit', $g) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('goals.destroy', $g) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('remover meta?')" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif
@endsection
