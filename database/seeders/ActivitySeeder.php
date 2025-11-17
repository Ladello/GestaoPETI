<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Project;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();

        if (! $project) {
            return;
        }

        Activity::create([
            'project_id' => $project->id,
            'title' => 'Levantar requisitos',
            'description' => 'Reuniões com usuários para entender necessidades.',
            'status' => 'em_andamento',
            'due_date' => now()->addDays(7),
        ]);

        Activity::create([
            'project_id' => $project->id,
            'title' => 'Definir arquitetura',
            'description' => 'Desenho da solução e tecnologias.',
            'status' => 'planejado',
            'due_date' => now()->addDays(15),
        ]);

        Activity::create([
            'project_id' => $project->id,
            'title' => 'Apresentar protótipo',
            'description' => 'Validação inicial com stakeholders.',
            'status' => 'planejado',
            'due_date' => now()->addDays(30),
        ]);
    }
}
