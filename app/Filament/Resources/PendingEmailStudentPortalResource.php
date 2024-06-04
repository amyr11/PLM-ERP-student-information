<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingEmailStudentPortalResource\Pages;
use App\Filament\Resources\PendingEmailStudentPortalResource\RelationManagers;
use App\Models\PendingEmailStudentPortal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
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
                    // Only show students who are not yet in the pending_email_student_portals table
                    ->relationship('student', 'student_no', function ($query) {
                        $query->whereNotIn('student_no', function ($query) {
                            $query->select('student_no')
                                  ->from('pending_email_student_portals');
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
                TextColumn::make('created_at')->label('Created At')->dateTime(),
                TextColumn::make('updated_at')->label('Updated At')->dateTime(),
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