<?php

namespace App\Filament\Resources\StudentRequestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class RequestedDocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'requestedDocuments';

    protected static ?string $recordTitleAttribute = 'documentType.document_name';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('document_type_id')
                    ->relationship('documentType', 'document_name')
                    ->required()
                    ->label('Document Type')
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('no_of_copies')
                    ->required()
                    ->numeric()
                    ->label('Number of Copies')
                    ->disabled(fn ($record) => $record !== null),
                Select::make('requested_document_status_id')
                    ->relationship('requestedDocumentStatus', 'status')
                    ->required()
                    ->label('Status'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('documentType.document_name')->label('Document Name'),
                TextColumn::make('no_of_copies')->label('Number of Copies'),
                TextColumn::make('requestedDocumentStatus.status')->label('Status'),
                TextColumn::make('created_at')->label('Requested At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}