<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramCurriculumResource\Pages;
use App\Filament\Resources\ProgramCurriculumResource\RelationManagers;
use App\Models\ProgramCurriculum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramCurriculumResource extends Resource
{
    protected static ?string $model = ProgramCurriculum::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('program_id')
                    ->relationship('program', 'program_title')
                    ->required(),
                Forms\Components\Select::make('curriculum_id')
                    ->relationship('curriculum', 'curriculum_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program.program_title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('curriculum.curriculum_name')->sortable()->searchable(),
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
            'index' => Pages\ListProgramCurricula::route('/'),
            'create' => Pages\CreateProgramCurriculum::route('/create'),
            'view' => Pages\ViewProgramCurriculum::route('/{record}'),
            'edit' => Pages\EditProgramCurriculum::route('/{record}/edit'),
        ];
    }
}