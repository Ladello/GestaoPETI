<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    // listar objetivos
    public function index()
    {
        $objectives = Objective::orderBy('created_at', 'desc')->paginate(12);
        return view('objectives.index', compact('objectives'));
    }

    // formulário de criação
    public function create()
    {
        return view('objectives.create');
    }

    // salvar novo objetivo
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:estrategico,operacional,tatico',
            'requirements' => 'nullable',
        ]);

        // se requirements foi enviado como texto, transformar em array por linhas
        if ($request->filled('requirements') && is_string($request->requirements)) {
            $lines = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $request->requirements)));
            if (! empty($lines)) {
                $data['requirements'] = array_values($lines);
            }
        }

        Objective::create($data);

        return redirect()->route('objectives.index')->with('success', 'objetivo criado.');
    }

    // mostrar detalhe do objetivo (com metas)
    public function show(Objective $objective)
    {
        $objective->load('goals');
        return view('objectives.show', compact('objective'));
    }

    // formulário de edição
    public function edit(Objective $objective)
    {
        return view('objectives.edit', compact('objective'));
    }

    // atualizar objetivo
    public function update(Request $request, Objective $objective)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:estrategico,operacional,tatico',
            'requirements' => 'nullable',
        ]);

        if ($request->filled('requirements') && is_string($request->requirements)) {
            $lines = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $request->requirements)));
            if (! empty($lines)) {
                $data['requirements'] = array_values($lines);
            }
        }

        $objective->update($data);

        return redirect()->route('objectives.show', $objective)->with('success', 'objetivo atualizado.');
    }

    // remover objetivo (e suas metas em cascade se migration configurada)
    public function destroy(Objective $objective)
    {
        $objective->delete();
        return redirect()->route('objectives.index')->with('success', 'objetivo removido.');
    }
}
