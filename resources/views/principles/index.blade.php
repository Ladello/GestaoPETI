@extends('layouts.app')

@section('title', 'Princípios de TI')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Princípios de TI</h2>
    <a href="{{ route('principles.create') }}" class="btn btn-primary">Novo Princípio</a>
</div>

@if($principles->isEmpty())
    <div class="alert alert-info">nenhum princípio cadastrado.</div>
@else
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>título</th>
            <th>prioridade</th>
            <th>ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($principles as $p)
        <tr>
            <td>{{ $p->title }}</td>
            <td>{{ $p->priority ?? '—' }}</td>
            <td>
                <a href="{{ route('principles.show', $p) }}" class="btn btn-sm btn-info">ver</a>
                <a href="{{ route('principles.edit', $p) }}" class="btn btn-sm btn-warning">editar</a>

                <form action="{{ route('principles.destroy', $p) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('remover princípio?')" class="btn btn-sm btn-danger">excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $principles->links() }}
@endif
@endsection
