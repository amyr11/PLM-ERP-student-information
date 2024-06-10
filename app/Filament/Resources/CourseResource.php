<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
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
                TextInput::make('subject_code')
                    ->required(),
                TextInput::make('subject_title')
                    ->required(),
                TextInput::make('course_number')
                    ->required(),
                TextInput::make('units')
                    ->required()
                    ->numeric(),
                TextInput::make('class_code')
                    ->required(),
                TextInput::make('pre_co_requisite')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject_code')
                    ->label('Subject Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('subject_title')
                    ->label('Subject Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course_number')
                    ->label('Course Code')
                    ->sortable()
                    ->searchable(),
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