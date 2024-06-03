<?php

namespace App\Filament\Resources;

use App\Filament\Imports\StudentImporter;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('student_no')
                            ->required()
                            ->length(9),
                Section::make('Personal information')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'md' => 3,
                            'lg' => 5,
                        ])
                            ->schema([
                                TextInput::make('last_name')
                                    ->required(),
                                TextInput::make('first_name')
                                    ->required(),
                                TextInput::make('middle_name')
                                    ->required(),
                                TextInput::make('maiden_name'),
                                TextInput::make('suffix'),
                            ]),
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                DatePicker::make('birthdate')
                                    ->required(),
                                TextInput::make('permanent_address')
                                    ->required(),
                                TextInput::make('personal_email')
                                    ->required()
                                    ->email(),
                                TextInput::make('mobile_no')
                                    ->required()
                                    ->length(11),
                                TextInput::make('telephone_no'),
                                TextInput::make('religion'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_no'),
                TextColumn::make('yearlevel'),
                TextColumn::make('last_name'),
                TextColumn::make('first_name'),
                TextColumn::make('middle_name'),
                TextColumn::make('personal_email'),
                TextColumn::make('plm_email'),
                TextColumn::make('mobile_no'),
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
            // ->headerActions([
            //     ImportAction::make()
            //         ->importer(StudentImporter::class)
            // ]);
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
