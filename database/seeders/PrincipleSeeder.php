<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Principle;

class PrincipleSeeder extends Seeder
{
    public function run(): void
    {
        Principle::create([
            'title' => 'Padrão antes de exceção',
            'description' => 'Soluções devem seguir padrões corporativos antes de adotar exceções.',
        ]);

        Principle::create([
            'title' => 'Segurança por padrão',
            'description' => 'A segurança deve ser considerada desde o desenho da solução.',
        ]);

        Principle::create([
            'title' => 'Reuso de componentes',
            'description' => 'Promover reuso de componentes e serviços existentes.',
        ]);
    }
}
