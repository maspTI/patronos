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
                'name' => 'International Council',
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
        ]);
    }
}
