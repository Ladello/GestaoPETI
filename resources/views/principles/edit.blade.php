@extends('layouts.app')

@section('title', 'Editar Princípio')

@section('content')
<h2>Editar Princípio</h2>

<form action="{{ route('principles.update', $principle) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">título</label>
        <input type="text" name="title" class="form-control" value="{{ $principle->title }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">descrição</label>
        <textarea name="description" class="form-control" rows="4">{{ $principle->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">prioridade</label>
        <input type="number" name="priority" class="form-control" value="{{ $principle->priority }}">
    </div>

    <button class="btn btn-success">salvar</button>
    <a href="{{ route('principles.show', $principle) }}" class="btn btn-secondary">cancelar</a>
</form>
@endsection
