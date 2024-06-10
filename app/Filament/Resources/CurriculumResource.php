<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurriculumResource\Pages;
use App\Filament\Resources\CurriculumResource\RelationManagers;
use App\Models\Curriculum;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurriculumResource extends Resource
{
    protected static ?string $model = Curriculum::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('subject_code')
                    ->required(),
                TextInput::make('subject_title')
                    ->required(),
                TextInput::make('course_number')
                    ->required(),
                TextInput::make('units')
                    ->required(),
                TextInput::make('pre_co_requisite')
                    ->nullable(),
                Select::make('program_id')
                    ->relationship('program', 'program_title')
                    ->required(),
                Select::make('aysem_id')
                    ->relationship('aysem', 'academic_year_code')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject_code')
                    ->label('Course Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('subject_title')
                    ->label('Course Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('units')
                    ->label('Units')
                    ->sortable(),
                TextColumn::make('pre_co_requisite')
                    ->label('Pre(Co)-requisites')
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
            'index' => Pages\ListCurricula::route('/'),
            'create' => Pages\CreateCurriculum::route('/create'),
            'view' => Pages\ViewCurriculum::route('/{record}'),
            'edit' => Pages\EditCurriculum::route('/{record}/edit'),
        ];
    }
}