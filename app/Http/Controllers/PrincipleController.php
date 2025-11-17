<?php

namespace App\Http\Controllers;

use App\Models\Principle;
use Illuminate\Http\Request;

class PrincipleController extends Controller
{
    // listar princípios
    public function index()
    {
        $principles = Principle::orderBy('priority','desc')->paginate(12);
        return view('principles.index', compact('principles'));
    }

    // formulário de criação
    public function create()
    {
        return view('principles.create');
    }

    // salvar novo princípio
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|integer',
        ]);

        Principle::create($data);

        return redirect()->route('principles.index')->with('success', 'princípio criado.');
    }

    // mostrar detalhe
    public function show(Principle $principle)
    {
        return view('principles.show', compact('principle'));
    }

    // formulário de edição
    public function edit(Principle $principle)
    {
        return view('principles.edit', compact('principle'));
    }

    // atualizar princípio
    public function update(Request $request, Principle $principle)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|integer',
        ]);

        $principle->update($data);

        return redirect()->route('principles.show', $principle)->with('success', 'princípio atualizado.');
    }

    // remover princípio
    public function destroy(Principle $principle)
    {
        $principle->delete();
        return redirect()->route('principles.index')->with('success', 'princípio removido.');
    }
}
