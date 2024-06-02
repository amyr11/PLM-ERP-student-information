<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingEmailStudentPortalResource\Pages;
use App\Filament\Resources\PendingEmailStudentPortalResource\RelationManagers;
use App\Models\PendingEmailStudentPortal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingEmailStudentPortalResource extends Resource
{
    protected static ?string $model = PendingEmailStudentPortal::class;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?string $modelLabel = 'Student Portal Credentials';

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
                //
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
            'index' => Pages\ListPendingEmailStudentPortals::route('/'),
            'create' => Pages\CreatePendingEmailStudentPortal::route('/create'),
            'view' => Pages\ViewPendingEmailStudentPortal::route('/{record}'),
            'edit' => Pages\EditPendingEmailStudentPortal::route('/{record}/edit'),
        ];
    }
}
