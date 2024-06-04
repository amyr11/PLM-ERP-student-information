<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingEmailPLMEmailResource\Pages;
use App\Filament\Resources\PendingEmailPLMEmailResource\RelationManagers;
use App\Models\PendingEmailPLMEmail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingEmailPLMEmailResource extends Resource
{
    protected static ?string $model = PendingEmailPLMEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?string $modelLabel = 'PLM Emails';

    protected static ?string $navigationGroup = 'Pending Credential Emails';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_no'),
                TextColumn::make('full_name')
                    ->getStateUsing(function ($record) {
                        return $record->student->full_name;
                    }),
                TextColumn::make('plm_email')
                    ->label('PLM Email')
                    ->getStateUsing(function ($record) {
                        return $record->student->plm_email ?? 'No Email';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
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
            'index' => Pages\ListPendingEmailPLMEmails::route('/'),
            'create' => Pages\CreatePendingEmailPLMEmail::route('/create'),
            'view' => Pages\ViewPendingEmailPLMEmail::route('/{record}'),
            'edit' => Pages\EditPendingEmailPLMEmail::route('/{record}/edit'),
        ];
    }
}
