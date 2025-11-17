<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CanvasItem;

class CanvasSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            'parcerias' => 'Parcerias com fornecedores estratégicos de nuvem e telecom.',
            'atividades' => 'Gestão de projetos, operação de serviços, suporte ao usuário.',
            'proposta_valor' => 'Entregar soluções de TI que suportem os objetivos de negócio.',
            'relacionamento' => 'Canais formais de demanda, comitês de TI, pesquisas de satisfação.',
            'segmentos' => 'Unidades de negócio, áreas corporativas, usuários finais.',
            'recursos' => 'Equipe de TI, infraestrutura, contratos com fornecedores.',
            'canais' => 'Portal de serviços, e-mail, telefone, aplicações web e mobile.',
            'custos' => 'Infraestrutura, licenças de software, contratos de suporte.',
            'receitas' => 'Orçamento de TI, rateio de custos entre áreas.',
        ];

        $order = 1;
        foreach ($sections as $key => $content) {
            CanvasItem::create([
                'section' => $key,
                'content' => $content,
                'order' => $order++,
            ]);
        }
    }
}
