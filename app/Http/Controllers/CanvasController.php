<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;;
use App\Models\CanvasItem;
use Illuminate\Http\Request;

class CanvasController extends Controller
{
    // mostrar os blocos do canvas em um grid
    public function index()
    {
        // traz todos ordenados por order
        $items = CanvasItem::orderBy('order')->get()->keyBy('section');

        // garante que existam os 9 blocos principais (cria vazio se não existir)
        $sections = [
            'parcerias','atividades','proposta_valor','relacionamento',
            'segmentos','recursos','canais','custos','receitas'
        ];

        foreach ($sections as $i => $section) {
            if (! isset($items[$section])) {
                $item = CanvasItem::create([
                    'section' => $section,
                    'content' => '',
                    'order' => $i,
                ]);
                $items[$section] = $item;
            }
        }

        return view('canvas.index', ['items' => $items]);
    }

    // formulário para criar bloco extra (opcional)
    public function create()
    {
        return view('canvas.create');
    }

    // armazenar novo bloco (opcional)
    public function store(Request $request)
    {
        $data = $request->validate([
            'section' => 'required|string|max:50',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        CanvasItem::create($data);

        return redirect()->route('canvas.index')->with('success', 'bloco criado.');
    }

    // formulário de edição para um bloco
    public function edit(CanvasItem $canvas)
    {
        return view('canvas.edit', ['canvas' => $canvas]);
    }

    // atualizar conteúdo do bloco
    public function update(Request $request, CanvasItem $canvas)
    {
        $data = $request->validate([
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $canvas->update($data);

        return redirect()->route('canvas.index')->with('success', 'bloco atualizado.');
    }

    public function exportPdf()
{
    // pega os blocos e garante a ordem
    $items = CanvasItem::orderBy('order')->get()->keyBy('section');

    $sections = [
        'parcerias','atividades','proposta_valor','relacionamento',
        'segmentos','recursos','canais','custos','receitas'
    ];

    foreach ($sections as $i => $section) {
        if (! isset($items[$section])) {
            $items[$section] = new CanvasItem([
                'section' => $section,
                'content' => '',
                'order' => $i,
            ]);
        }
    }

    // carregar view blade preparada para impressão / pdf
    $pdf = PDF::loadView('canvas.pdf', ['items' => $items])
              ->setPaper('a4', 'landscape'); // landscape fica mais adequado para 3x3

    // download imediato
    return $pdf->download('canvas-peti.pdf');

    // ou para abrir no browser:
    // return $pdf->stream('canvas-peti.pdf');
}
}
