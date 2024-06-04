<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentRequestResource\Pages;
use App\Filament\Resources\StudentRequestResource\RelationManagers;
use App\Models\StudentRequest;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentRequestResource extends Resource
{
    protected static ?string $model = StudentRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Student information')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                Select::make('student_id')
                                    ->relationship('student', 'student_no')
                                    ->required(),
                                Select::make('student_request_mode_id')
                                    ->relationship('studentRequestMode', 'mode')
                                    ->required(),
                                Select::make('student_request_status_id')
                                    ->relationship('studentRequestStatus', 'status')
                                    ->required(),
                            ]),
                    ]),
                Section::make('Request information')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                TextInput::make('receipt_no')
                                    ->required(),
                                TextInput::make('purpose')
                                    ->required(),
                                TextInput::make('total')
                                    ->required(),
                                TextInput::make('registrar_name'),
                                DatePicker::make('date_requested')
                                    ->maxDate(now())
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('date_of_payment', $state);
                                        $set('expected_release', $state);
                                        $set('date_received', $state);
                                    }),
                                DatePicker::make('date_of_payment')
                                    ->minDate(fn (callable $get) => $get('date_requested'))
                                    ->required(),
                                DatePicker::make('expected_release')
                                    ->minDate(fn (callable $get) => $get('date_requested'))
                                    ->required(),
                                DatePicker::make('date_received')
                                    ->minDate(fn (callable $get) => $get('date_requested')),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.student_no'),
                TextColumn::make('purpose'),
                TextColumn::make('mode'),
                TextColumn::make('receipt_no'),
                TextColumn::make('total'),
                TextColumn::make('registrar_name'),
                TextColumn::make('date_requested'),
                TextColumn::make('expected_release'),
                TextColumn::make('date_received'),
                TextColumn::make('status'),
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
            'index' => Pages\ListStudentRequests::route('/'),
            'create' => Pages\CreateStudentRequest::route('/create'),
            'view' => Pages\ViewStudentRequest::route('/{record}'),
            'edit' => Pages\EditStudentRequest::route('/{record}/edit'),
        ];
    }
}