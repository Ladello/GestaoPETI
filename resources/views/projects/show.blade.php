@extends('layouts.app')

@section('title', $project->title)

@section('content')

<h2>{{ $project->title }}</h2>

<p><strong>Status:</strong> {{ $project->status }}</p>
<p><strong>Prioridade:</strong> {{ $project->priority }}</p>
<p><strong>Descrição:</strong><br>{{ $project->description }}</p>

<a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Editar Projeto</a>

<hr>

<h4>Atividades</h4>

<a href="{{ route('projects.activities.create', $project) }}" class="btn btn-primary mb-3">Nova Atividade</a>

@if($project->activities->isEmpty())
    <div class="alert alert-info">Nenhuma atividade cadastrada.</div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Título</th>
            <th>Status</th>
            <th>Responsável</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($project->activities as $a)
        <tr>
            <td>{{ $a->title }}</td>
            <td>{{ $a->status }}</td>
            <td>{{ $a->assignee->name ?? '—' }}</td>
            <td>
                <a href="{{ route('activities.edit', $a) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('activities.destroy', $a) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Excluir atividade?')" class="btn btn-sm btn-danger">
                        Excluir
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif

@endsection
