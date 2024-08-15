<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Como melhoria, foi substituído o método DB::table() pelo método Category::insert() para simplificar a inserção de dados através do modelo Category
        Category::insert([
            ['name' => 'Remessa Parcial'],
            ['name' => 'Remessa'],
        ]);
    }
}
