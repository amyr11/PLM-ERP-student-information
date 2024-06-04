<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingEmailPLMEmailResource\Pages;
use App\Filament\Resources\PendingEmailPLMEmailResource\RelationManagers;
use App\Models\PendingEmailPLMEmail;
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

class PendingEmailPLMEmailResource extends Resource
{
    protected static ?string $model = PendingEmailPLMEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?string $modelLabel = 'PLM Emails';

    protected static ?string $navigationGroup = 'Pending Credential Emails';

    public static function canCreate(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('temp_password')
                    ->label('Temporary Password')
                    ->required()
                    ->unique(),
                Select::make('student_no')
                    // Only show students who are not yet in the pending_email_p_l_m_emails table
                    ->relationship('student', 'student_no', function ($query) {
                        $query->whereNotIn('student_no', function ($query) {
                            $query->select('student_no')
                                  ->from('pending_email_p_l_m_emails');
                        });
                    })
                    ->label('Student')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),
                TextColumn::make('student.student_no')->label('Student Number'),
                TextColumn::make('temp_password')->label('Temporary Password'),
                TextColumn::make('student.personal_email')->label('Personal Email'),
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
            'index' => Pages\ListPendingEmailPLMEmails::route('/'),
            'create' => Pages\CreatePendingEmailPLMEmail::route('/create'),
            'view' => Pages\ViewPendingEmailPLMEmail::route('/{record}'),
            'edit' => Pages\EditPendingEmailPLMEmail::route('/{record}/edit'),
        ];
    }
}