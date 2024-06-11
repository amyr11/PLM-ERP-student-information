<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurriculumCourseResource\Pages;
use App\Filament\Resources\CurriculumCourseResource\RelationManagers;
use App\Models\CurriculumCourse;
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

class CurriculumCourseResource extends Resource
{
    protected static ?string $model = CurriculumCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Curriculum';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('curriculum_id')
                    ->relationship('curriculum', 'name')
                    ->required(),
                Select::make('course_id')
                    ->relationship('course', 'subject_title')
                    ->required(),
                TextInput::make('semester')
                    ->required()
                    ->numeric()
                    ->extraInputAttributes([
                        'min' => 1,
                        'min' => 3,
                    ]),
                TextInput::make('year_level')
                    ->required()
                    ->numeric()
                    ->extraInputAttributes([
                        'min' => 1,
                        'min' => 6,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('curriculum.name')
                    ->label('Curriculum')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course.subject_title')
                    ->label('Course')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('year_level')
                    ->label('Year Level')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('semester')
                    ->label('Semester')
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
            'index' => Pages\ListCurriculumCourses::route('/'),
            'create' => Pages\CreateCurriculumCourse::route('/create'),
            'view' => Pages\ViewCurriculumCourse::route('/{record}'),
            'edit' => Pages\EditCurriculumCourse::route('/{record}/edit'),
        ];
    }
}