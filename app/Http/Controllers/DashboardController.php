<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Activity;
use App\Models\Service;
use App\Models\Objective;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // exibe a dashboard principal
    public function index()
    {
        // totais
        $totalProjects = Project::count();
        $totalActivities = Activity::count();
        $totalServices = Service::count();
        $totalObjectives = Objective::count();
        $totalGoals = Goal::count();

        // atividades atrasadas (tem due_date e não concluída)
        $overdueActivities = Activity::whereNotNull('due_date')
            ->where('status', '<>', 'concluido')
            ->whereDate('due_date', '<', now())
            ->count();

        // projetos por status (associativo status => count)
        $projectsByStatus = Project::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total','status')
            ->toArray();

        // preparar dados para gráfico (labels e valores)
        $chartLabels = array_keys($projectsByStatus);
        $chartValues = array_values($projectsByStatus);

        // últimos registros para listas
        $recentProjects = Project::orderBy('created_at','desc')->limit(6)->get();
        $recentActivities = Activity::with('project')->orderBy('created_at','desc')->limit(8)->get();

        return view('dashboard.index', compact(
            'totalProjects','totalActivities','totalServices','totalObjectives','totalGoals',
            'overdueActivities','projectsByStatus','chartLabels','chartValues',
            'recentProjects','recentActivities'
        ));
    }
}
