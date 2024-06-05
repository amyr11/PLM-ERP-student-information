<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentTermResource\Pages;
use App\Filament\Resources\StudentTermResource\RelationManagers;
use App\Models\Aysem;
use App\Models\RegistrationStatus;
use App\Models\StudentTerm;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
use Illuminate\Support\Facades\DB;

class StudentTermResource extends Resource
{
    protected static ?string $model = StudentTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('aysem_id')
                    ->native(false)
                    ->label('AYSEM')
                    ->searchable()
                    ->relationship('aysem', 'academic_year_sem')
                    ->default(function () {
                        return Aysem::latest('date_start')->first()->id;
                    })
                    ->required(),
                Select::make('student_no')
                    ->native(false)
                    ->label('Student No')
                    ->relationship('student', 'student_no')
                    ->searchable()
                    ->required(),
                TextInput::make('year_level')->label('Year Level')
                    ->required(),
                Select::make('program_id')
                    ->native(false)
                    ->label('Program')
                    ->searchable()
                    ->relationship('program', 'program_title')
                    ->required(),
                Select::make('block_id')
                    ->native(false)
                    ->label('Block ID')
                    ->searchable()
                    ->relationship('block', 'block_id'),
                Select::make('registration_id')
                    ->native(false)
                    ->label('Registration Status')
                    ->relationship('registrationStatus', 'registration_status')
                    ->default(function () {
                        return RegistrationStatus::where('registration_status', 'Regular')->first()->id;
                    })
                    ->required(),
                Select::make('student_type')
                    ->native(false)
                    ->label('Student type')
                    ->options([
                        'old' => 'Old',
                        'new' => 'New',
                    ])
                    ->default('new')
                    ->required(),
                Grid::make([
                    'default' => 1,
                ])->schema([
                    Toggle::make('graduating')->label('Graduating')
                        ->default(false),
                    Toggle::make('enrolled')->label('Enrolled')
                        ->default(false),
                ]),
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
                TextColumn::make('created_at')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('latest')
                    ->label('Latest Records')
                    ->query(function ($query) {
                        $subQuery = DB::table('student_terms')
                                ->select('student_no', DB::raw('MAX(created_at) as latest_created_at'))
                                ->groupBy('student_no');
                
                        $query->whereIn('created_at', function ($query) use ($subQuery) {
                            $query->select('latest_created_at')
                                ->fromSub($subQuery, 'sub');
                        });
                    }),
                Filter::make('graduating')
                    ->label('Graduating')
                    ->query(fn (Builder $query): Builder => $query->where('graduating', true)),
                Filter::make('enrolled')
                    ->label('Enrolled')
                    ->query(fn (Builder $query): Builder => $query->where('enrolled', true)),
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
