@extends('layouts.app')

@section('title', 'Novo Serviço')

@section('content')
<h2>Novo Serviço</h2>

{{-- exibe erros de validação / outros --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('services.store') }}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" rows="4" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">SLA / nível de serviço</label>
        <input type="text" name="sla" class="form-control" placeholder="ex: 99% uptime">
    </div>

    <div class="mb-3">
        <label class="form-label">Resultados esperados (uma linha por item ou JSON)</label>
        <textarea name="results_expected" rows="4" class="form-control" placeholder="ex: 1) reduzir tempo de atendimento\n2) relatório diário"></textarea>
    </div>

    <button class="btn btn-success">Salvar</button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
