<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Service desk',
            'description' => 'Atendimento de usuários de TI.',
            'sla' => 'Atendimento em até 4h úteis',
            'results_expected' => [
                'Reduzir incidentes recorrentes',
                'Aumentar satisfação dos usuários',
            ],
        ]);

        Service::create([
            'name' => 'E-mail corporativo',
            'description' => 'Serviço de correio eletrônico institucional.',
            'sla' => 'Disponibilidade 99,5%',
            'results_expected' => [
                'Comunicação interna padronizada',
            ],
        ]);

        Service::create([
            'name' => 'VPN',
            'description' => 'Acesso remoto seguro aos sistemas internos.',
            'sla' => 'Disponível 24x7',
            'results_expected' => [
                'Permitir trabalho remoto seguro',
            ],
        ]);
    }
}
