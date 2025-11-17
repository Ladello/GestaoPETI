@extends('layouts.app')

@section('title', 'Novo Princípio')

@section('content')
<h2>Novo Princípio de TI</h2>

<form action="{{ route('principles.store') }}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">título</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">descrição</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">prioridade (número maior = mais prioridade)</label>
        <input type="number" name="priority" class="form-control" value="1">
    </div>

    <button class="btn btn-success">salvar</button>
    <a href="{{ route('principles.index') }}" class="btn btn-secondary">voltar</a>
</form>
@endsection
