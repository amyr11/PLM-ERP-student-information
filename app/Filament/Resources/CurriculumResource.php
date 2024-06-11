<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurriculumResource\Pages;
use App\Filament\Resources\CurriculumResource\RelationManagers;
use App\Filament\Resources\CurriculumResource\RelationManagers\CurriculumCoursesRelationManager;
use App\Models\Curriculum;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
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

    protected static ?string $navigationGroup = 'Curriculum';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Curriculum')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('program_id')
                            ->relationship('program', 'program_title')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ]),
                Repeater::make('courses')
                    ->relationship('courses')
                    ->schema([
                        Select::make('course_id')
                            ->label('Course')
                            ->relationship('course', 'subject_title')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('semester')
                            ->label('Semester')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(3),
                        TextInput::make('year_level')
                            ->label('Year Level')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(6),
                    ])
                    ->columns(3)
                    ->createItemButtonLabel('Add Course')
                    ->label('Courses')
                    ->collapsible()
                    ->defaultItems(1)
                    ->required()
                    ->columnSpan('full')
                    ->hiddenOn(['view', 'edit'])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Curriculum Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program.program_title')
                    ->label('Program')
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
            CurriculumCoursesRelationManager::class,
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