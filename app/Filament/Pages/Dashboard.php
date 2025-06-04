<?php

namespace App\Filament\Pages;

use App\Models\Item;
use App\Models\Sale;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard

{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    use HasFiltersForm;

    public function getFilterFormDefaults(): array
    {
        return [
            'item_id' => 1,
        ];
    }

    public function filtersForm(Form $form): Form
    {
        $years = Sale::select('year')->distinct()->orderBy('year')->pluck('year', 'year');
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Filter')
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 12,
                    ])
                    ->schema([
                        \Filament\Forms\Components\Select::make('item_id')
                            ->label('Item Name')
                            ->options(Item::all()->pluck('name', 'id'))
                            ->native(false)
                            ->preload()
                            ->default(1)
                            ->columnSpan([
                                'sm' => 3,
                                'xl' => 3,
                                '2xl' => 6,
                            ]),
                        \Filament\Forms\Components\Select::make('year')
                            ->label('Year')
                            ->options($years)
                            ->default(2023)
                            ->placeholder('All years')
                            ->columnSpan([
                                'sm' => 3,
                                'xl' => 3,
                                '2xl' => 6,
                            ]),
                    ])
            ]);
    }
}
