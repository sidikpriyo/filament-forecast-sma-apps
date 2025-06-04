<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = [
            //item id=1 Tahun 2023
            ['item_id' => 1, 'year' => 2023, 'month' => 1, 'total_sales' => 29988],
            ['item_id' => 1, 'year' => 2023, 'month' => 2, 'total_sales' => 31293],
            ['item_id' => 1, 'year' => 2023, 'month' => 3, 'total_sales' => 34421],
            ['item_id' => 1, 'year' => 2023, 'month' => 4, 'total_sales' => 36588],
            ['item_id' => 1, 'year' => 2023, 'month' => 5, 'total_sales' => 38912],
            ['item_id' => 1, 'year' => 2023, 'month' => 6, 'total_sales' => 37265],
            ['item_id' => 1, 'year' => 2023, 'month' => 7, 'total_sales' => 36223],
            ['item_id' => 1, 'year' => 2023, 'month' => 8, 'total_sales' => 33156],
            ['item_id' => 1, 'year' => 2023, 'month' => 9, 'total_sales' => 35252],
            ['item_id' => 1, 'year' => 2023, 'month' => 10, 'total_sales' => 32156],
            ['item_id' => 1, 'year' => 2023, 'month' => 11, 'total_sales' => 28145],
            ['item_id' => 1, 'year' => 2023, 'month' => 12, 'total_sales' => 27624],

            // item id=1 Tahun 2024
            ['item_id' => 1, 'year' => 2024, 'month' => 1, 'total_sales' => 29784],
            ['item_id' => 1, 'year' => 2024, 'month' => 2, 'total_sales' => 26463],
            ['item_id' => 1, 'year' => 2024, 'month' => 3, 'total_sales' => 28405],
            ['item_id' => 1, 'year' => 2024, 'month' => 4, 'total_sales' => 28144],
            ['item_id' => 1, 'year' => 2024, 'month' => 5, 'total_sales' => 27502],
            ['item_id' => 1, 'year' => 2024, 'month' => 6, 'total_sales' => 30168],

            // Tahun 2023 - item_id = 2
            ['item_id' => 2, 'year' => 2023, 'month' => 1, 'total_sales' => 2950],
            ['item_id' => 2, 'year' => 2023, 'month' => 2, 'total_sales' => 3255],
            ['item_id' => 2, 'year' => 2023, 'month' => 3, 'total_sales' => 3368],
            ['item_id' => 2, 'year' => 2023, 'month' => 4, 'total_sales' => 3218],
            ['item_id' => 2, 'year' => 2023, 'month' => 5, 'total_sales' => 3356],
            ['item_id' => 2, 'year' => 2023, 'month' => 6, 'total_sales' => 3455],
            ['item_id' => 2, 'year' => 2023, 'month' => 7, 'total_sales' => 3575],
            ['item_id' => 2, 'year' => 2023, 'month' => 8, 'total_sales' => 3603],
            ['item_id' => 2, 'year' => 2023, 'month' => 9, 'total_sales' => 3852],
            ['item_id' => 2, 'year' => 2023, 'month' => 10, 'total_sales' => 3733],
            ['item_id' => 2, 'year' => 2023, 'month' => 11, 'total_sales' => 3102],
            ['item_id' => 2, 'year' => 2023, 'month' => 12, 'total_sales' => 2914],

            // Tahun 2024 - item_id = 2
            ['item_id' => 2, 'year' => 2024, 'month' => 1, 'total_sales' => 3371],
            ['item_id' => 2, 'year' => 2024, 'month' => 2, 'total_sales' => 3780],
            ['item_id' => 2, 'year' => 2024, 'month' => 3, 'total_sales' => 3425],
            ['item_id' => 2, 'year' => 2024, 'month' => 4, 'total_sales' => 3017],
            ['item_id' => 2, 'year' => 2024, 'month' => 5, 'total_sales' => 2764],
            ['item_id' => 2, 'year' => 2024, 'month' => 6, 'total_sales' => 2634],

            // Tahun 2023 - item_id = 3
            ['item_id' => 3, 'year' => 2023, 'month' => 1, 'total_sales' => 18853],
            ['item_id' => 3, 'year' => 2023, 'month' => 2, 'total_sales' => 20530],
            ['item_id' => 3, 'year' => 2023, 'month' => 3, 'total_sales' => 20685],
            ['item_id' => 3, 'year' => 2023, 'month' => 4, 'total_sales' => 19756],
            ['item_id' => 3, 'year' => 2023, 'month' => 5, 'total_sales' => 21055],
            ['item_id' => 3, 'year' => 2023, 'month' => 6, 'total_sales' => 22325],
            ['item_id' => 3, 'year' => 2023, 'month' => 7, 'total_sales' => 23145],
            ['item_id' => 3, 'year' => 2023, 'month' => 8, 'total_sales' => 23985],
            ['item_id' => 3, 'year' => 2023, 'month' => 9, 'total_sales' => 24698],
            ['item_id' => 3, 'year' => 2023, 'month' => 10, 'total_sales' => 22897],
            ['item_id' => 3, 'year' => 2023, 'month' => 11, 'total_sales' => 17644],
            ['item_id' => 3, 'year' => 2023, 'month' => 12, 'total_sales' => 22036],

            // Tahun 2024 - item_id = 3
            ['item_id' => 3, 'year' => 2024, 'month' => 1, 'total_sales' => 19541],
            ['item_id' => 3, 'year' => 2024, 'month' => 2, 'total_sales' => 23044],
            ['item_id' => 3, 'year' => 2024, 'month' => 3, 'total_sales' => 20884],
            ['item_id' => 3, 'year' => 2024, 'month' => 4, 'total_sales' => 17359],
            ['item_id' => 3, 'year' => 2024, 'month' => 5, 'total_sales' => 19789],
            ['item_id' => 3, 'year' => 2024, 'month' => 6, 'total_sales' => 21974],


            // Tahun 2023 - item_id = 4
            ['item_id' => 4, 'year' => 2023, 'month' => 1, 'total_sales' => 18560],
            ['item_id' => 4, 'year' => 2023, 'month' => 2, 'total_sales' => 18660],
            ['item_id' => 4, 'year' => 2023, 'month' => 3, 'total_sales' => 18250],
            ['item_id' => 4, 'year' => 2023, 'month' => 4, 'total_sales' => 18990],
            ['item_id' => 4, 'year' => 2023, 'month' => 5, 'total_sales' => 18300],
            ['item_id' => 4, 'year' => 2023, 'month' => 6, 'total_sales' => 19600],
            ['item_id' => 4, 'year' => 2023, 'month' => 7, 'total_sales' => 23035],
            ['item_id' => 4, 'year' => 2023, 'month' => 8, 'total_sales' => 25214],
            ['item_id' => 4, 'year' => 2023, 'month' => 9, 'total_sales' => 27165],
            ['item_id' => 4, 'year' => 2023, 'month' => 10, 'total_sales' => 24266],
            ['item_id' => 4, 'year' => 2023, 'month' => 11, 'total_sales' => 22623],
            ['item_id' => 4, 'year' => 2023, 'month' => 12, 'total_sales' => 20347],

            // Tahun 2024 - item_id = 4
            ['item_id' => 4, 'year' => 2024, 'month' => 1, 'total_sales' => 18746],
            ['item_id' => 4, 'year' => 2024, 'month' => 2, 'total_sales' => 17912],
            ['item_id' => 4, 'year' => 2024, 'month' => 3, 'total_sales' => 19633],
            ['item_id' => 4, 'year' => 2024, 'month' => 4, 'total_sales' => 22104],
            ['item_id' => 4, 'year' => 2024, 'month' => 5, 'total_sales' => 18688],
            ['item_id' => 4, 'year' => 2024, 'month' => 6, 'total_sales' => 19358],
        ];

        foreach ($sales as $sale) {
            \App\Models\Sale::create($sale);
        }
    }
}
