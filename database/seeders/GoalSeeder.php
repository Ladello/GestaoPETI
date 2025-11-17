<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Goal;
use App\Models\Objective;

class GoalSeeder extends Seeder
{
    public function run(): void
    {
        $objective = Objective::first();

        if (! $objective) {
            return;
        }

        Goal::create([
            'objective_id' => $objective->id,
            'metric' => 'Certificar equipe em ITIL',
            'target_value' => 80,
            'target_label' => '80% da equipe certificada',
            'target_date' => now()->addMonths(6),
            'notes' => 'Priorizar equipe de suporte e atendimento.',
        ]);

        Goal::create([
            'objective_id' => $objective->id,
            'metric' => 'Publicar catálogo de serviços',
            'target_value' => 1,
            'target_label' => 'Catálogo publicado',
            'target_date' => now()->addMonths(3),
            'notes' => 'Catálogo deve conter SLAs e responsáveis.',
        ]);

        Goal::create([
            'objective_id' => $objective->id,
            'metric' => 'Atingir NPS de 80+',
            'target_value' => 80,
            'target_label' => 'NPS >= 80',
            'target_date' => now()->addYear(),
            'notes' => 'Aplicar pesquisa de satisfação semestral.',
        ]);
    }
}
