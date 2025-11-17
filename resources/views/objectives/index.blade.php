@extends('layouts.app')

@section('title', 'Objetivos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Objetivos Estratégicos</h2>
    <a href="{{ route('objectives.create') }}" class="btn btn-primary">Novo Objetivo</a>
</div>

@if($objectives->isEmpty())
    <div class="alert alert-info">nenhum objetivo cadastrado.</div>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Tipo</th>
            <th>Criação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($objectives as $o)
        <tr>
            <td>{{ $o->title }}</td>
            <td>{{ $o->type }}</td>
            <td>{{ $o->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('objectives.show', $o) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('objectives.edit', $o) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('objectives.destroy', $o) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('remover objetivo?')" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $objectives->links() }}
@endif
@endsection
