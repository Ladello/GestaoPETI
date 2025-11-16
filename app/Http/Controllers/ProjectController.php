<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // listar projetos
    public function index(Request $request)
    {
        $query = Project::query()->with('owner');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($qbuilder) use ($q) {
                $qbuilder->where('title', 'like', "%{$q}%")
                         ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('projects.index', compact('projects'));
    }

    // formulário de criação
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('projects.create', compact('users'));
    }

    // salvar novo projeto
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:proposta,planejado,em_andamento,cancelado,concluido,liberado,em_operacao,aposentado',
            'priority' => 'required|in:baixa,media,alta',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'owner_id' => 'nullable|exists:users,id',
            'meta' => 'nullable|array',
        ]);

        if ($request->filled('meta') && is_string($request->meta)) {
            $decoded = json_decode($request->meta, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['meta'] = $decoded;
            }
        }

        $project = Project::create($data);

        return redirect()->route('projects.show', $project)->with('success', 'projeto criado.');
    }

    // mostrar detalhe do projeto
    public function show(Project $project)
    {
        $project->load(['activities.assignee', 'owner']);

        return view('projects.show', compact('project'));
    }

    // formulário de edição
    public function edit(Project $project)
    {
        $users = User::orderBy('name')->get();

        return view('projects.edit', compact('project', 'users'));
    }

    // atualizar projeto
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:proposta,planejado,em_andamento,cancelado,concluido,liberado,em_operacao,aposentado',
            'priority' => 'required|in:baixa,media,alta',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'owner_id' => 'nullable|exists:users,id',
            'meta' => 'nullable|array',
        ]);

        if ($request->filled('meta') && is_string($request->meta)) {
            $decoded = json_decode($request->meta, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['meta'] = $decoded;
            }
        }

        $project->update($data);

        return redirect()->route('projects.show', $project)->with('success', 'projeto atualizado.');
    }

    // remover projeto
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'projeto removido.');
    }

    // mudar status rapidamente
    public function changeStatus(Request $request, Project $project)
    {
        $data = $request->validate([
            'status' => 'required|in:proposta,planejado,em_andamento,cancelado,concluido,liberado,em_operacao,aposentado',
        ]);

        $project->update(['status' => $data['status']]);

        return redirect()->back()->with('success', 'status do projeto alterado.');
    }
}
