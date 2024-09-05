<?php

namespace Database\Seeders;

use App\Infrastructure\Database\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Remessa Parcial'
        ];
        Category::firstOrCreate(
            [
                'name' => 'Remessa Parcial'
            ],
            [
                'name' => 'Remessa Parcial'
            ],
        );

        $data = [
            'name' => 'Remessa'
        ];
        Category::firstOrCreate(
            [
                'name' => 'Remessa',
            ],
            [
                'name' => 'Remessa'
            ],
        );
    }
}
