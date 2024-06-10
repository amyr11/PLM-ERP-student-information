<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurriculumProgramResource\Pages;
use App\Filament\Resources\CurriculumProgramResource\RelationManagers;
use App\Models\CurriculumProgram;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurriculumProgramResource extends Resource
{
    protected static ?string $model = CurriculumProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Curriculum';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('curriculum_id')
                    ->relationship('curriculum', 'name')
                    ->required(),
                Select::make('program_id')
                    ->relationship('program', 'program_title')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program.program_code')
                    ->label('Program Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program.program_title')
                    ->label('Program')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('curriculum.name')
                    ->label('Current Curriculum')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCurriculumPrograms::route('/'),
            'create' => Pages\CreateCurriculumProgram::route('/create'),
            'view' => Pages\ViewCurriculumProgram::route('/{record}'),
            'edit' => Pages\EditCurriculumProgram::route('/{record}/edit'),
        ];
    }
}