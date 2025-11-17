<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Objective;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    // formulário criar meta para um objetivo
    public function create(Objective $objective)
    {
        return view('goals.create', compact('objective'));
    }

    // armazenar meta
    public function store(Request $request, Objective $objective)
    {
        $data = $request->validate([
            'metric' => 'nullable|string|max:255',
            'target_value' => 'nullable|numeric',
            'target_label' => 'nullable|string|max:255',
            'target_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $data['objective_id'] = $objective->id;

        Goal::create($data);

        return redirect()->route('objectives.show', $objective)->with('success', 'meta criada.');
    }

    // editar meta (shallow route)
    public function edit(Goal $goal)
    {
        $objective = $goal->objective;
        return view('goals.edit', compact('goal', 'objective'));
    }

    // atualizar meta
    public function update(Request $request, Goal $goal)
    {
        $data = $request->validate([
            'metric' => 'nullable|string|max:255',
            'target_value' => 'nullable|numeric',
            'target_label' => 'nullable|string|max:255',
            'target_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $goal->update($data);

        return redirect()->route('objectives.show', $goal->objective)->with('success', 'meta atualizada.');
    }

    // remover meta
    public function destroy(Goal $goal)
    {
        $objective = $goal->objective;
        $goal->delete();

        return redirect()->route('objectives.show', $objective)->with('success', 'meta removida.');
    }
}
