<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // listar atividades de um projeto
    public function index(Project $project)
    {
        $activities = $project->activities()->with('assignee')->orderBy('due_date')->get();

        return view('activities.index', compact('project', 'activities'));
    }

    // formulário de criação de atividade
    public function create(Project $project)
    {
        $users = User::orderBy('name')->get();

        return view('activities.create', compact('project', 'users'));
    }

    // salvar atividade vinculada
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:planejado,em_andamento,cancelado,concluido',
            'acceptance_criteria' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $data['project_id'] = $project->id;

        $activity = Activity::create($data);

        return redirect()->route('projects.show', $project)->with('success', 'atividade criada.');
    }

    // editar atividade
    public function edit(Activity $activity)
    {
        $project = $activity->project;
        $users = User::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'project', 'users'));
    }

    // atualizar atividade
    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:planejado,em_andamento,cancelado,concluido',
            'acceptance_criteria' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $activity->update($data);

        return redirect()->route('projects.show', $activity->project)->with('success', 'atividade atualizada.');
    }

    // remover atividade
    public function destroy(Activity $activity)
    {
        $project = $activity->project;
        $activity->delete();

        return redirect()->route('projects.show', $project)->with('success', 'atividade removida.');
    }

    // mudar status rápido
    public function changeStatus(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'status' => 'required|in:planejado,em_andamento,cancelado,concluido',
        ]);

        $activity->update(['status' => $data['status']]);

        return redirect()->back()->with('success', 'status da atividade alterado.');
    }
}
