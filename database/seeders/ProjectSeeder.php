<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::first();

        Project::create([
            'title' => 'App mobile',
            'description' => 'Aplicativo móvel para atendimento aos clientes.',
            'status' => 'em_andamento',
            'priority' => 'alta',
            'start_date' => now()->subWeeks(2),
            'end_date' => now()->addMonth(),
            'owner_id' => $owner?->id,
            'meta' => [
                'kpi' => 'Adesão de 60% dos usuários em 6 meses',
            ],
        ]);

        Project::create([
            'title' => 'Portal corporativo',
            'description' => 'Novo portal interno para colaboradores.',
            'status' => 'planejado',
            'priority' => 'media',
            'start_date' => now()->addWeek(),
            'end_date' => null,
            'owner_id' => $owner?->id,
            'meta' => [
                'kpi' => 'Redução de 30% nas chamadas ao service desk',
            ],
        ]);

        Project::create([
            'title' => 'Migração para nuvem',
            'description' => 'Migração gradual dos sistemas legados para nuvem.',
            'status' => 'proposta',
            'priority' => 'alta',
            'start_date' => null,
            'end_date' => null,
            'owner_id' => $owner?->id,
            'meta' => [
                'kpi' => 'Redução de custos de infraestrutura em 20%',
            ],
        ]);
    }
}
