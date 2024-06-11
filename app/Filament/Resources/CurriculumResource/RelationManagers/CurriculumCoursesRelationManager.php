<?php

namespace App\Filament\Resources\CurriculumResource\RelationManagers;

use App\Models\CurriculumCourse;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class CurriculumCoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

    protected static ?string $recordTitleAttribute = 'course.subject_title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                    ->label('Course')
                    ->relationship('course', 'subject_title')
                    ->required()
                    ->searchable(),
                TextInput::make('semester')
                    ->label('Semester')
                    ->required()
                    ->numeric()
                    ->min(1)
                    ->max(3),
                TextInput::make('year_level')
                    ->label('Year Level')
                    ->required()
                    ->numeric()
                    ->min(1)
                    ->max(6),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Course Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course.subject_title')
                    ->label('Course Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('year_level')
                    ->label('Year Level')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}