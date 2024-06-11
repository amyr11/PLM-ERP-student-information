<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
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

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Curriculum';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('aysem_id')
                    ->label('Aysem')
                    ->relationship('aysem', 'academic_year_code')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'program_title')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('subject_code')
                    ->label('Course code')
                    ->required(),
                TextInput::make('subject_title')
                    ->label('Course title')
                    ->required(),
                TextInput::make('course_number')
                    ->label('Course number')
                    ->required(),
                TextInput::make('units')
                    ->label('Units')
                    ->required()
                    ->numeric()
                    ->extraInputAttributes([
                        'min' => 1,
                    ]),
                TextInput::make('class_code')
                    ->label('Class code')
                    ->required(),
                TextInput::make('pre_co_requisite')
                    ->label('Pre(Co)-requisites')
                    ->nullable(),
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
                TextColumn::make('combined')
                    ->label('Course')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(function (Course $record) {
                        return "{$record->subject_code} - {$record->subject_title}";
                    }),
                TextColumn::make('units')
                    ->label('Units')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('class_code')
                    ->label('Class Code')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}