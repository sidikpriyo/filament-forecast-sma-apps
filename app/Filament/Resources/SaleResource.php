<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Fieldset::make(ucfirst($form->getOperation()) . ' Item')
                    ->schema([
                        \Filament\Forms\Components\Section::make()
                            ->columns([
                                'sm' => 3,
                                'xl' => 6,
                                '2xl' => 12,
                            ])
                            ->schema([
                                \Filament\Forms\Components\Select::make('item_id')
                                    ->relationship(name: 'item', titleAttribute: 'name')
                                    ->label('Item')
                                    ->placeholder('Select an item')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->rules([
                                        function (Forms\Get $get) use ($form) {
                                            return function (string $attribute, $value, \Closure $fail) use ($get, $form) {
                                                $exists = \App\Models\Sale::where('item_id', $value)
                                                    ->where('month', $get('month'))
                                                    ->where('year', $get('year'));
                                                if ($form->getRecord()) {
                                                    $exists->where('id', '!=', $form->getRecord()->id);
                                                }
                                                if ($exists->exists()) {
                                                    $fail('This item has already been recorded for the selected month and year.');
                                                }
                                            };
                                        },
                                    ])
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                                \Filament\Forms\Components\TextInput::make('year')
                                    ->label('Year')
                                    ->placeholder('Enter the year')
                                    ->required()
                                    ->numeric()
                                    ->integer()
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                                \Filament\Forms\Components\Select::make('month')
                                    ->options([
                                        1 => 'January',
                                        2 => 'February',
                                        3 => 'March',
                                        4 => 'April',
                                        5 => 'May',
                                        6 => 'June',
                                        7 => 'July',
                                        8 => 'August',
                                        9 => 'September',
                                        10 => 'October',
                                        11 => 'November',
                                        12 => 'December',
                                    ])
                                    ->label('Month')
                                    ->placeholder('Enter the month')
                                    ->required()
                                    ->native(false)
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                                \Filament\Forms\Components\TextInput::make('total_sales')
                                    ->label('Total Sales')
                                    ->placeholder('Enter the total sales')
                                    ->required()
                                    ->numeric()
                                    ->integer()
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ])
                            ])

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                \Filament\Tables\Grouping\Group::make('year')
                    ->label('Year')
                    ->collapsible()
                    ->orderQueryUsing(function (Builder $query, string $direction) {
                        return $query
                            ->join('items', 'items.id', '=', 'sales.item_id')
                            ->orderBy('year', $direction)
                            ->orderBy('items.name', $direction)
                            ->orderBy('month', $direction)
                            ->select('sales.*');
                    }),
            ])
            ->groupingSettingsInDropdownOnDesktop()
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                \Filament\Tables\Columns\TextColumn::make('item.name')
                    ->label('Item Name')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('item.unit')
                    ->label('Unit Name'),
                \Filament\Tables\Columns\TextColumn::make('year')
                    ->label('Year')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('month')
                    ->label('Month'),
                \Filament\Tables\Columns\TextColumn::make('total_sales')
                    ->label('Total Sales'),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('item')
                    ->relationship('item', 'name')
                    ->searchable()
                    ->preload()
                    ->default(1)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
