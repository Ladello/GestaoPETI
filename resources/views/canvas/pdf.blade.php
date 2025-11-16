<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Canvas PETI</title>
  <style>
    /* estilos simples compatíveis com dompdf */
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 18px; color: #111; }
    .grid { display: table; width: 100%; table-layout: fixed; border-collapse: collapse; }
    .row { display: table-row; }
    .cell {
      display: table-cell;
      vertical-align: top;
      border: 1px solid #ccc;
      padding: 10px;
      height: 200px; /* ajusta conforme necessidade */
    }
    .header { font-weight: 700; margin-bottom: 6px; }
    .small { font-size: 11px; color: #555; }
    .footer-note { margin-top: 10px; font-size: 10px; color: #666; }
    /* quebra de linha dentro do conteúdo */
    .content { white-space: pre-wrap; }
  </style>
</head>
<body>
  <h2 style="text-align:center; margin-bottom: 6px;">Canvas de TI - PETI</h2>
  <p class="small" style="text-align:center; margin-top:0; margin-bottom:12px;">Gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

  <div class="grid">
    @php
      $layout = [
        ['parcerias','atividades','proposta_valor'],
        ['relacionamento','segmentos','recursos'],
        ['canais','custos','receitas']
      ];
      $labels = [
          'parcerias' => 'Parcerias-chave',
          'atividades' => 'Atividades-chave',
          'proposta_valor' => 'Proposta de valor',
          'relacionamento' => 'Relacionamento com clientes',
          'segmentos' => 'Segmentos de clientes',
          'recursos' => 'Recursos',
          'canais' => 'Canais',
          'custos' => 'Estrutura de custos',
          'receitas' => 'Fontes de receita',
      ];
    @endphp

    @foreach($layout as $row)
      <div class="row">
        @foreach($row as $section)
          @php $item = $items[$section] ?? null; @endphp
          <div class="cell">
            <div class="header">{{ $labels[$section] ?? $section }}</div>
            <div class="content">{!! nl2br(e($item->content ?? '')) !!}</div>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>

  <div class="footer-note">
    Documento gerado automaticamente pelo sistema PETI. Conteúdos originários do Canvas.
  </div>
</body>
</html>
