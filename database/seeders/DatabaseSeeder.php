<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\ActivitySeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ObjectiveSeeder;
use Database\Seeders\GoalSeeder;
use Database\Seeders\PrincipleSeeder;
use Database\Seeders\CanvasSeeder;
use Database\Seeders\ArchitectureUploadSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // usuário padrão para testes
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@adm.com',
            'password' => bcrypt('senha123'),
        ]);

        // seeders de domínio (até 3 exemplos por módulo)
        $this->call([
            ProjectSeeder::class,
            ActivitySeeder::class,
            ServiceSeeder::class,
            ObjectiveSeeder::class,
            GoalSeeder::class,
            PrincipleSeeder::class,
            CanvasSeeder::class,
            ArchitectureUploadSeeder::class,
        ]);
    }
}
