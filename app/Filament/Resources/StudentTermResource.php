<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentTermResource\Pages;
use App\Filament\Resources\StudentTermResource\RelationManagers;
use App\Models\StudentTerm;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentTermResource extends Resource
{
    protected static ?string $model = StudentTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

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
                TextColumn::make('aysem.academic_year_sem')
                    ->label('AYSEM')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('student_no')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('year_level')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('program.program_code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('block.block_id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('registrationStatus.registration_status')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('graduating')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('enrolled')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('aysem_id')
                    ->label('AYSEM')
                    ->searchable()
                    ->relationship('aysem', 'academic_year_sem'),
                SelectFilter::make('program_id')
                    ->label('Program')
                    ->searchable()
                    ->relationship('program', 'program_code'),
                SelectFilter::make('registration_id')
                    ->label('Registration Status')
                    ->relationship('registrationStatus', 'registration_status'),
                SelectFilter::make('block_id')
                    ->label('Block')
                    ->searchable()
                    ->relationship('block', 'block_id'),
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
            'index' => Pages\ListStudentTerms::route('/'),
            'create' => Pages\CreateStudentTerm::route('/create'),
            'view' => Pages\ViewStudentTerm::route('/{record}'),
            'edit' => Pages\EditStudentTerm::route('/{record}/edit'),
        ];
    }
}
