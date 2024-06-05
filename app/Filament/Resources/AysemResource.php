<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AysemResource\Pages;
use App\Filament\Resources\AysemResource\RelationManagers;
use App\Models\Aysem;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AysemResource extends Resource
{
    protected static ?string $model = Aysem::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Academic Year & Semester';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 2,
                ])->schema([
                    TextInput::make('academic_year')
                    ->required(),
                    TextInput::make('semester')
                    ->required()
                ]),
                Grid::make([
                    'default' => 2,
                ])->schema([
                    DatePicker::make('date_start')
                        ->native(false)
                        ->required(),
                    DatePicker::make('date_end')
                        ->native(false)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('academic_year_sem', 'desc')
            ->columns([
                TextColumn::make('academic_year_sem')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_start')
                    ->searchable()
                    ->sortable()
                    ->date(),
                TextColumn::make('date_end')
                    ->searchable()
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAysems::route('/'),
            'create' => Pages\CreateAysem::route('/create'),
            'view' => Pages\ViewAysem::route('/{record}'),
            'edit' => Pages\EditAysem::route('/{record}/edit'),
        ];
    }
}
