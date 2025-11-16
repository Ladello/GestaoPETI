@extends('layouts.app')

@section('title', 'Editar bloco do Canvas')

@section('content')
<h2>Editar bloco</h2>

<form action="{{ route('canvas.update', $canvas) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">seção</label>
        <input type="text" class="form-control" value="{{ $canvas->section }}" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">conteúdo</label>
        <textarea name="content" rows="8" class="form-control">{{ old('content', $canvas->content) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">ordem (número)</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $canvas->order) }}">
    </div>

    <button class="btn btn-success">salvar</button>
    <a href="{{ route('canvas.index') }}" class="btn btn-secondary">cancelar</a>
</form>
@endsection
