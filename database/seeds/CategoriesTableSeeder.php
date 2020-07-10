<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([








            [
                'name' => 'Conselho',
                'email' => 'conselho@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrono',
                'email' => 'patrono@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrono Prata',
                'email' => 'patrono@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrono Ouro',
                'email' => 'patrono@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrono Diamante',
                'email' => 'patrono@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrono Benemérito',
                'email' => 'patrono@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Diretoria',
                'email' => 'diretoria@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Jovem Patrono',
                'email' => 'jovenspatronos@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Jovens Patronos Prata',
                'email' => 'jovenspatronos@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Jovens Patronos Ouro',
                'email' => 'jovenspatronos@masp.org.br',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'International Council',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'International Council Silver',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'International Council Gold',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'International Council Diamond',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Associados',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Conselho Fiscal',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Presidente de Honra',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Conselheiro Nato',
                'email' => '',
                'applicable_to' => 'patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Estratégicos',
                'email' => '',
                'applicable_to' => 'sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrocinadores Master',
                'email' => '',
                'applicable_to' => 'sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Patrocinadores',
                'email' => '',
                'applicable_to' => 'sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Empresa Amiga',
                'email' => '',
                'applicable_to' => 'sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Apoiador Cultural',
                'email' => '',
                'applicable_to' => 'sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Doação da Festa (mesa/convite)',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Doação de IR',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Pagamento de Viagem',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Cavalete',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Pagamento para o Prédio Anexo',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Pagamento para Endowment',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Doação Genérica',
                'email' => '',
                'applicable_to' => 'payment-patron',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Lei de Incentivo à Cultura (Rouanet)',
                'email' => '',
                'applicable_to' => 'payment-sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Proac',
                'email' => '',
                'applicable_to' => 'payment-sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Promac',
                'email' => '',
                'applicable_to' => 'payment-sponsor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
