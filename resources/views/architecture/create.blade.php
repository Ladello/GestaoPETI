@extends('layouts.app')

@section('title', 'Enviar Arquivo de Arquitetura')

@section('content')
<h2>Enviar arquivo de arquitetura</h2>

<form action="{{ route('architecture.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">arquivo (pdf, png, jpg, svg) - max 10MB</label>
        <input type="file" name="file" class="form-control" required>
        @error('file') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">descrição (opcional)</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>

    <button class="btn btn-success">enviar</button>
    <a href="{{ route('architecture.index') }}" class="btn btn-secondary">voltar</a>
</form>
@endsection
