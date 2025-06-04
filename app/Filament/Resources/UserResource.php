<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Fieldset::make(ucfirst($form->getOperation()) . ' User')
                    ->schema([
                        \Filament\Forms\Components\Section::make()
                            ->columns([
                                'sm' => 3,
                                'xl' => 6,
                                '2xl' => 12,
                            ])
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Full Name')
                                    ->placeholder('Enter your full name')
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                                \Filament\Forms\Components\TextInput::make('email')
                                    ->required()
                                    ->label('Email Address')
                                    ->placeholder('Enter your email address')
                                    ->email()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                                \Filament\Forms\Components\TextInput::make('password')
                                    ->required()
                                    ->label('Password')
                                    ->placeholder('Enter your password')
                                    ->password()
                                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                                    ->dehydrated(fn(?string $state): bool => filled($state))
                                    ->required(fn(string $operation): bool => $operation === 'create')
                                    ->revealable()
                                    ->minLength(8)
                                    ->maxLength(12)
                                    ->confirmed()
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                                Forms\Components\TextInput::make('password_confirmation')
                                    ->label('Password Confirmation')
                                    ->placeholder('Enter your password confirmation')
                                    ->password()
                                    ->dehydrated(false)
                                    ->revealable()
                                    ->minLength(8)
                                    ->maxLength(12)
                                    ->columnSpan([
                                        'sm' => 3,
                                        'xl' => 3,
                                        '2xl' => 6,
                                    ]),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
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
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
