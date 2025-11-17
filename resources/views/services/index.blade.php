@extends('layouts.app')

@section('title', 'Serviços')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Portfólio de Serviços</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Novo Serviço</a>
</div>

@if($services->isEmpty())
    <div class="alert alert-info">Nenhum serviço cadastrado.</div>
@else
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>SLA</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($services as $s)
        <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->sla ?? '—' }}</td>
            <td>
                <a href="{{ route('services.show', $s) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('services.edit', $s) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('services.destroy', $s) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Remover serviço?')" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $services->links() }}
@endif
@endsection
