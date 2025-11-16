@extends('layouts.app')

@section('title', 'Projetos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Projetos</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Novo Projeto</a>
</div>

@if($projects->isEmpty())
    <div class="alert alert-info">Nenhum projeto cadastrado.</div>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Status</th>
            <th>Prioridade</th>
            <th>Responsável</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->status }}</td>
            <td>{{ $project->priority }}</td>
            <td>{{ $project->owner->name ?? '—' }}</td>
            <td>
                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Remover projeto?')" class="btn btn-sm btn-danger">
                        Excluir
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $projects->links() }}

@endif

@endsection
