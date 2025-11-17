@extends('layouts.app')

@section('title', 'Editar Objetivo')

@section('content')
<h2>Editar Objetivo</h2>

<form action="{{ route('objectives.update', $objective) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ $objective->title }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo</label>
        <select name="type" class="form-control" required>
            @foreach(['estrategico','tatico','operacional'] as $t)
                <option value="{{ $t }}" {{ $objective->type == $t ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control" rows="4">{{ $objective->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">requirements (uma linha por item)</label>
        <textarea name="requirements" class="form-control" rows="3">@if(is_array($objective->requirements)){{ implode("\n", $objective->requirements) }}@else{{ $objective->requirements }}@endif</textarea>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('objectives.show', $objective) }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
