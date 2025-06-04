<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\Sale;
use Dcvn\Math\Statistics\MovingAverage;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ForecastChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Chart';

    public function getHeading(): ?string
    {
        return $this->getData()['title'] ?? parent::getHeading();
    }

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    protected static ?string $maxHeight = '300px';
    protected function getData(): array
    {
        // parameters
        $itemId =   $this->filters['item_id'] ?? null;
        $filterYear = $this->filters['year'] ?? null;

        // Jika item_id kosong, langsung return data kosong supaya tidak tampil
        if (!$itemId) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $itemName = Item::find($itemId)?->name ?? 'Unknown Item';
        $allData = Sale::when($itemId, fn($query) => $query->where('item_id', $itemId))
            ->select('item_id', 'year', 'month', 'total_sales')
            ->orderBy('year')->orderBy('month')
            ->get();

        // Hitung forecast berdasarkan semua data actual
        $intervals = [3, 4, 5];
        $datasets = [];

        // Dataset actual akan di-filter berdasarkan tahun
        $filteredData = $allData;

        // Siapkan label dan actual berdasarkan filter tahun
        $actual = [];
        foreach ($filteredData as $value) {
            $date = \Carbon\Carbon::createFromDate($value->year, $value->month, 1);
            $actual[] = ['result' => $value->total_sales, 'year' => (int)$value->year, 'month' => $date->translatedFormat('F - Y')];
        }

        // data yang dipakai!!
        if ($filterYear) {
            $filtered = array_values(array_filter($actual, function ($item) use ($filterYear) {
                return $item['year'] == $filterYear;
            }));
        } else {
            $filtered = $actual;
        }

        // Buat ulang label dari data yang sudah difilter
        $labels = array_map(fn($item) => $item['month'], $filtered);
        // Tambahkan label bulan setelah terakhir (optional)
        if (count($filtered) > 0) {
            $lastFiltered = end($filtered); // ambil data terakhir
            // Convert kembali ke tanggal
            $lastDate = \Carbon\Carbon::createFromFormat('F - Y', $lastFiltered['month'])->addMonth();
            $labels[] = $lastDate->translatedFormat('F - Y');
        }

        // Tambahkan dataset actual yang sudah difilter
        $datasets[] = [
            'label' => 'Actual',
            'data' => array_column($filtered, 'result'),
            'backgroundColor' => '#36A2EB',
            'borderColor' => '#9BD0F5',
        ];

        // Hitung forecast berdasarkan semua data actual (unfiltered)
        foreach ($intervals as $interval) {
            $movingAverage = new MovingAverage();
            $movingAverage->setPeriod($interval);
            $result = $movingAverage->getCalculatedFromArray($allData->pluck('total_sales')->toArray());
            $result = array_map('round', $result);
            // Awal 0 sesuai interval
            $adjustedResult = array_fill(0, $interval, 0);
            $startYear = 2023;
            $startMonth = 1;
            $adjustedResult = [];

            for ($m = 0; $m < $interval; $m++) {
                // Hitung tahun dan bulan maju
                $month = $startMonth + $m;
                $year = $startYear + intdiv($month - 1, 12);
                $month = ($month - 1) % 12 + 1;

                $adjustedResult[] = [
                    'result' => 0,
                    'year' => $year,
                    'month' => $month,
                ];
            }

            // Sisipkan hasil moving average
            for ($i = $interval - 1; $i < count($result); $i++) {
                $date = \Carbon\Carbon::createFromDate($allData[$i]->year, $allData[$i]->month, 1)->addMonth();
                $adjustedResult[] = [
                    'result' => $result[$i],
                    'year' => $date->year,
                    'month' => $date->month,
                ];
            }
            if ($filterYear) {
                $resultForecast = array_values(array_filter($adjustedResult, function ($item) use ($filterYear) {
                    return $item['year'] == $filterYear;
                }));

                foreach ($adjustedResult as $item) {
                    if ($item['year'] == $filterYear + 1 && $item['month'] == 1) {
                        $resultForecast[] = $item;
                        break;
                    }
                }
            } else {
                $resultForecast =  $adjustedResult;
            }

            $datasets[] = [
                'label' => "Forecast {$interval} interval",
                'data' => array_column($resultForecast, 'result'),
                'backgroundColor' => match ($interval) {
                    3 => '#FF6384',
                    4 => '#FF9F40',
                    5 => '#4BC0C0',
                    default => '#CCCCCC',
                },
                'borderColor' => match ($interval) {
                    3 => '#FF8BA3',
                    4 => '#FFB56E',
                    5 => '#70D5D9',
                    default => '#E0E0E0',
                },
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
            'title' => "Forecast Chart for: {$itemName}",
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    // protected function myData()
    // {
    //     $itemId = $this->filters['item_id'] ?? null;
    //     $filterYear = $this->filters['year'] ?? null;

    //     $allData = Sale::when($itemId, fn($query) => $query->where('item_id', $itemId))
    //         ->select('item_id', 'year', 'month', 'total_sales')
    //         ->orderBy('year')->orderBy('month')
    //         ->get();

    //     $intervals = [3, 4, 5];
    //     $datasets = [];

    //     foreach ($intervals as $interval) {
    //         $movingAverage = new MovingAverage();
    //         $movingAverage->setPeriod($interval);
    //         $result = $movingAverage->getCalculatedFromArray($allData->pluck('total_sales')->toArray());
    //         $result = array_map('round', $result);

    //         $adjustedResult = [];
    //         for ($i = $interval - 1; $i < count($result); $i++) {
    //             $date = \Carbon\Carbon::createFromDate($allData[$i]->year, $allData[$i]->month, 1)->addMonth();
    //             $adjustedResult[] = [
    //                 'result' => $result[$i],
    //                 'year' => $date->year,
    //                 'month' => $date->month,
    //             ];
    //         }

    //         $datasets[] = [
    //             'label' => "Forecast {$interval} interval",
    //             'data' => array_column($adjustedResult, 'result'),
    //         ];
    //     }
    // }
}
