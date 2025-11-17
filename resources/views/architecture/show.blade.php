@extends('layouts.app')

@section('title', 'Arquivo de Arquitetura')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ basename($upload->filename) }}</h2>
    <div>
        <a href="{{ route('architecture.download', $upload) }}" class="btn btn-success btn-sm">Download</a>
        <a href="{{ route('architecture.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
    </div>
</div>

<p><strong>mime:</strong> {{ $upload->mime }}</p>
@if($upload->description)
    <p><strong>descrição:</strong><br>{{ $upload->description }}</p>
@endif
<p><strong>enviado por:</strong> {{ $upload->uploader->name ?? '—' }} <small class="text-muted">em {{ $upload->created_at->format('d/m/Y H:i') }}</small></p>

<hr>

<div>
    @php
        $ext = strtolower(pathinfo($upload->filename, PATHINFO_EXTENSION));
        $url = Storage::disk('public')->url($upload->filename);
    @endphp

    @if(in_array($ext, ['png','jpg','jpeg','svg']))
        <div class="card p-3">
            <img src="{{ $url }}" class="img-fluid" alt="diagrama">
        </div>
    @elseif($ext === 'pdf')
        <div class="alert alert-secondary">
            arquivo PDF — use "download" para abrir no seu computador ou visualize no navegador:
            <div class="mt-2">
                <iframe src="{{ $url }}" style="width:100%; height:600px; border:0;"></iframe>
            </div>
        </div>
    @else
        <div class="alert alert-info">visualização não disponível — faça download para abrir.</div>
    @endif
</div>
@endsection
