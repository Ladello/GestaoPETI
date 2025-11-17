<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArchitectureUpload;
use App\Models\User;

class ArchitectureUploadSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        ArchitectureUpload::create([
            'filename' => 'exemplo-diagrama.pdf',
            'mime' => 'application/pdf',
            'description' => 'Diagrama exemplo de arquitetura de aplicações.',
            'uploaded_by' => $user?->id,
        ]);

        ArchitectureUpload::create([
            'filename' => 'landscape-ti.png',
            'mime' => 'image/png',
            'description' => 'Visão geral do landscape de TI.',
            'uploaded_by' => $user?->id,
        ]);

        ArchitectureUpload::create([
            'filename' => 'topologia-rede.svg',
            'mime' => 'image/svg+xml',
            'description' => 'Topologia simplificada da rede corporativa.',
            'uploaded_by' => $user?->id,
        ]);
    }
}
