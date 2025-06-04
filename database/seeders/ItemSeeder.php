<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['id' => 1, 'name' => 'Ayam Ungkep', 'unit' => 'Ekor'],
            ['id' => 2, 'name' => 'Sate Hati', 'unit' => 'Pack'],
            ['id' => 3, 'name' => 'Sate Kulit', 'unit' => 'Pack'],
            ['id' => 4, 'name' => 'Bumbu Sambal', 'unit' => 'Pack'],
        ];

        foreach ($items as $item) {
            \App\Models\Item::create($item);
        }
    }
}
