@extends('layouts.app')

@section('title', 'Arquitetura de TI')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Arquitetura de TI</h2>
    <a href="{{ route('architecture.create') }}" class="btn btn-primary">Enviar Arquivo</a>
</div>

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($uploads->isEmpty())
    <div class="alert alert-info">nenhum diagrama ou arquivo enviado.</div>
@else
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>arquivo</th>
            <th>mime</th>
            <th>descrição</th>
            <th>enviado por</th>
            <th>data</th>
            <th>ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($uploads as $u)
        <tr>
            <td>{{ basename($u->filename) }}</td>
            <td>{{ $u->mime }}</td>
            <td style="max-width:300px;">{{ Str::limit($u->description, 120) }}</td>
            <td>{{ $u->uploader->name ?? '—' }}</td>
            <td>{{ $u->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <a href="{{ route('architecture.show', $u) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('architecture.download', $u) }}" class="btn btn-sm btn-success">Download</a>

                <form action="{{ route('architecture.destroy', $u) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('remover arquivo?')" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $uploads->links() }}
@endif
@endsection
