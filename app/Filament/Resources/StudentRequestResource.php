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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentRequestResource extends Resource
{
    protected static ?string $model = StudentRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        $schema = [
            Section::make('Student information')
                ->schema([
                    Grid::make([
                        'sm' => 2,
                        'lg' => 3,
                    ])
                        ->schema([
                            Select::make('student_no')
                                ->relationship('student', 'student_no')
                                ->preload()
                                ->searchable()
                                ->required()
                                ->label('Student No.'),
                            Select::make('student_request_mode_id')
                                ->relationship('studentRequestMode', 'mode')
                                ->required()
                                ->label('Mode of Payment'),
                            Select::make('student_request_status_id')
                                ->relationship('studentRequestStatus', 'status')
                                ->required()
                                ->label('Status'),
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
                                ->required()
                                ->label('Receipt No.'),
                            TextInput::make('purpose')
                                ->required()
                                ->label('Purpose'),
                            // TextInput::make('total')
                            //     ->required()
                            //     ->numeric()
                            //     ->label('Total'),
                            TextInput::make('registrar_name')
                                ->label('Registrar Name'),
                            DatePicker::make('date_requested')
                                ->maxDate(now())
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $set('date_of_payment', $state);
                                    $set('expected_release', $state);
                                    $set('date_received', $state);
                                })
                                ->label('Date Requested')
                                ->default(now()),
                            DatePicker::make('date_of_payment')
                                ->minDate(fn (callable $get) => $get('date_requested'))
                                ->required()
                                ->label('Date of Payment'),
                            DatePicker::make('expected_release')
                                ->minDate(fn (callable $get) => $get('date_requested'))
                                ->required()
                                ->label('Expected Release'),
                            DatePicker::make('date_received')
                                ->minDate(fn (callable $get) => $get('date_requested'))
                                ->label('Date Received'),
                        ]),
                ]),
            Grid::make([
                'default' => 1,
            ])
                ->hiddenOn(['edit', 'view'])
                ->schema([
                    Forms\Components\Repeater::make('requested_documents')
                        ->relationship('requestedDocuments')
                        ->schema([
                            Select::make('document_type_id')
                                ->relationship('documentType', 'document_name')
                                ->required()
                                ->label('Document Type'),
                            TextInput::make('no_of_copies')
                                ->required()
                                ->numeric()
                                ->label('Number of Copies'),
                            Select::make('requested_document_status_id')
                                ->relationship('requestedDocumentStatus', 'status')
                                ->required()
                                ->label('Status'),
                        ])
                        ->minItems(1)
                        ->label('Requested Documents')
                        ->required(),
                ]),
        ];

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('student.student_no')
                    ->sortable()
                    ->searchable()
                    ->label('Student No.'),
                TextColumn::make('purpose')
                    ->sortable()
                    ->searchable()
                    ->label('Purpose'),
                TextColumn::make('studentRequestMode.mode')
                    ->sortable()
                    ->searchable()
                    ->label('Mode of Payment'),
                TextColumn::make('receipt_no')
                    ->sortable()
                    ->searchable()
                    ->label('Receipt No.'),
                TextColumn::make('total')
                    ->sortable()
                    ->searchable()
                    ->label('Price Total (₱)'),
                TextColumn::make('registrar_name')
                    ->sortable()
                    ->searchable()
                    ->label('Registrar Name')
                    ->default('N/A'),
                TextColumn::make('date_requested')
                    ->sortable()
                    ->searchable()
                    ->label('Date Requested'),
                TextColumn::make('expected_release')
                    ->sortable()
                    ->searchable()
                    ->label('Expected Release'),
                TextColumn::make('date_received')
                    ->sortable()
                    ->searchable()
                    ->label('Date Received')
                    ->default('N/A'),
                TextColumn::make('studentRequestStatus.status')
                    ->sortable()
                    ->searchable()
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('student_request_mode_id')
                    ->label('Mode of Payment')
                    ->relationship('studentRequestMode', 'mode'),
                SelectFilter::make('student_request_status_id')
                    ->label('Status')
                    ->relationship('studentRequestStatus', 'status'),
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
            RelationManagers\RequestedDocumentsRelationManager::class,
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