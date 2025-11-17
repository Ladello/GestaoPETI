@extends('layouts.app')

@section('title', 'Canvas de TI')

@section('content')
<h2>Canvas de TI</h2>
<p class="mb-3 text-muted">Edite os blocos do Canvas conforme o Modelo PETI.</p>

<div class="mb-3 d-flex gap-2">
    <!-- botão exportar PDF -->
    <a href="{{ route('canvas.pdf') }}" class="btn btn-sm btn-outline-success" target="_blank">
        <i class="bi bi-download"></i> Exportar PDF
    </a>
</div>


<div class="row g-3 mt-3">
    @php
        // define a ordem visual 3x3 (linha por linha)
        $layout = [
            ['parcerias','atividades','proposta_valor'],
            ['relacionamento','segmentos','recursos'],
            ['canais','custos','receitas']
        ];
        $labels = [
            'parcerias' => 'parcerias-chave',
            'atividades' => 'atividades-chave',
            'proposta_valor' => 'proposta de valor',
            'relacionamento' => 'relacionamento com clientes',
            'segmentos' => 'segmentos de clientes',
            'recursos' => 'recursos',
            'canais' => 'canais',
            'custos' => 'estrutura de custos',
            'receitas' => 'fontes de receita',
        ];
    @endphp

    @foreach($layout as $row)
        <div class="row w-100">
            @foreach($row as $section)
                @php $item = $items[$section] ?? null; @endphp
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="text-capitalize">{{ $labels[$section] ?? $section }}</strong>
                            <div>
                                <a href="{{ route('canvas.edit', $item) }}" class="btn btn-sm btn-outline-secondary">editar</a>
                                <form action="{{ route('canvas.destroy', $item) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('remover bloco?')" class="btn btn-sm btn-outline-danger">remover</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($item && strlen(trim($item->content)))
                                {!! nl2br(e($item->content)) !!}
                            @else
                                <p class="text-muted mb-0"><em>conteúdo vazio — clique em editar</em></p>
                            @endif
                        </div>
                        <div class="card-footer text-muted small">
                            ordem: {{ $item->order ?? '—' }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
