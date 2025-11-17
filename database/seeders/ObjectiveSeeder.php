<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Objective;

class ObjectiveSeeder extends Seeder
{
    public function run(): void
    {
        Objective::create([
            'title' => 'Aumentar maturidade de TI',
            'description' => 'Alinhar processos de TI às melhores práticas de mercado.',
            'type' => 'estrategico',
            'requirements' => [
                'Implementar gestão de serviços de TI',
                'Definir catálogo de serviços',
            ],
        ]);

        Objective::create([
            'title' => 'Melhorar disponibilidade dos sistemas',
            'description' => 'Reduzir indisponibilidades não planejadas.',
            'type' => 'tatico',
            'requirements' => [
                'Monitoramento proativo',
                'Plano de contingência documentado',
            ],
        ]);

        Objective::create([
            'title' => 'Reduzir tempo de atendimento',
            'description' => 'Melhorar o tempo de resposta às demandas do negócio.',
            'type' => 'operacional',
            'requirements' => [
                'Implantar fila única de atendimento',
            ],
        ]);
    }
}
