<?php

namespace App\Filament\Resources;

use App\Filament\Imports\StudentImporter;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Aysem;
use App\Models\Citizenship;
use App\Models\Program;
use App\Models\RegistrationStatus;
use App\Models\Student;
use App\Models\StudentTerm;
use App\Services\PLMEmail;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('student_no'),
                Section::make('Personal information')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'md' => 3,
                            'lg' => 5,
                        ])
                            ->schema([
                                TextInput::make('last_name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, callable $get) {
                                            $aysem = Aysem::find($get('aysem_id'));
                                            $lastName = $get('last_name');
                                            $firstName = $get('first_name');
                                            $middleName = $get('middle_name');

                                            if ($aysem && $lastName && $firstName && $middleName) {
                                                $set('plm_email', PLMEmail::generate( $firstName, $middleName, $lastName, $aysem->academic_year));
                                            }
                                            else {
                                                $set('plm_email', '');
                                            }
                                        }
                                    ),
                                TextInput::make('first_name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, callable $get) {
                                            $aysem = Aysem::find($get('aysem_id'));
                                            $lastName = $get('last_name');
                                            $firstName = $get('first_name');
                                            $middleName = $get('middle_name');

                                            if ($aysem && $lastName && $firstName && $middleName) {
                                                $set('plm_email', PLMEmail::generate( $firstName, $middleName, $lastName, $aysem->academic_year));
                                            }
                                            else {
                                                $set('plm_email', '');
                                            }
                                        }
                                    ),
                                TextInput::make('middle_name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, callable $get) {
                                            $aysem = Aysem::find($get('aysem_id'));
                                            $lastName = $get('last_name');
                                            $firstName = $get('first_name');
                                            $middleName = $get('middle_name');

                                            if ($aysem && $lastName && $firstName && $middleName) {
                                                $set('plm_email', PLMEmail::generate( $firstName, $middleName, $lastName, $aysem->academic_year));
                                            }
                                            else {
                                                $set('plm_email', '');
                                            }
                                        }
                                    ),
                                TextInput::make('maiden_name')
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, callable $get) {
                                            $aysem = Aysem::find($get('aysem_id'));
                                            $lastName = $get('last_name');
                                            $firstName = $get('first_name');
                                            $middleName = $get('middle_name');

                                            if ($aysem && $lastName && $firstName && $middleName) {
                                                $set('plm_email', PLMEmail::generate( $firstName, $middleName, $lastName, $aysem->academic_year));
                                            }
                                            else {
                                                $set('plm_email', '');
                                            }
                                        }
                                    ),
                                TextInput::make('suffix'),
                            ]),
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                DatePicker::make('birthdate')
                                    ->native(false)
                                    ->required(),
                                Select::make('biological_sex_id')
                                    ->native(false)
                                    ->relationship('biologicalSex', 'sex')
                                    ->required(),
                                Select::make('civil_status_id')
                                    ->native(false)
                                    ->relationship('civilStatus', 'civil_status')
                                    ->required(),
                                Select::make('citizenship_id')
                                    ->native(false)
                                    ->relationship('citizenship', 'citizenship')
                                    ->default(function () {
                                        return Citizenship::where('citizenship', 'Filipino')->first()->id;
                                    })
                                    ->required(),
                                Select::make('city_id')
                                    ->native(false)
                                    ->relationship('city', 'city_name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, callable $get) {
                                            $aysem = Aysem::find($get('aysem_id'));
                                            $cityId = $get('city_id');

                                            if ($aysem && $cityId) {
                                                $set('student_no', Student::generateStudentNumber($aysem->academic_year, $cityId));
                                            }
                                            else {
                                                $set('student_no', '');
                                            }
                                        }
                                    ),
                                Select::make('birthplace_city_id')
                                    ->native(false)
                                    ->relationship('birthplaceCity', 'city_name')
                                    ->required(),
                                TextInput::make('religion')
                                    ->required(),
                                TextInput::make('pedigree'),
                                TextInput::make('permanent_address')
                                    ->required(),
                                TextInput::make('personal_email')
                                    ->required()
                                    ->email(),
                                TextInput::make('mobile_no')
                                    ->required()
                                    ->length(11),
                                TextInput::make('telephone_no'),
                            ]),
                    ]),
                Section::make('Academic information')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                DatePicker::make('entry_date')
                                    ->native(false)
                                    ->required()
                                    ->default(now()),
                                Select::make('aysem_id')
                                    ->native(false)
                                    ->label('Academic year and semester')
                                    ->relationship('aysem', 'academic_year_sem')
                                    ->searchable()
                                    ->required()
                                    ->default(function () {
                                        return Aysem::latest('date_start')->first()->id;
                                    })
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, callable $get) {
                                            $aysem = Aysem::find($get('aysem_id'));
                                            $cityId = $get('city_id');

                                            $lastName = $get('last_name');
                                            $firstName = $get('first_name');
                                            $middleName = $get('middle_name');

                                            if ($aysem && $lastName && $firstName && $middleName) {
                                                $set('plm_email', PLMEmail::generate( $firstName, $middleName, $lastName, $aysem->academic_year));
                                            }
                                            else {
                                                $set('plm_email', '');
                                            }

                                            if ($aysem && $cityId) {
                                                $set('student_no', Student::generateStudentNumber($aysem->academic_year, $cityId));
                                            }
                                            else {
                                                $set('student_no', '');
                                            }
                                        }
                                    ),
                                TextInput::make('plm_email')
                                    ->label('PLM email')
                                    ->email()
                                    ->required(),
                                Select::make('paying')
                                    ->native(false)
                                    ->options([
                                        0 => 'No',
                                        1 => 'Yes',
                                    ])
                                    ->default(0)
                                    ->required(),
                                Select::make('student_term.registration_status_id')
                                    ->native(false)
                                    ->label('Registration Status')
                                    ->options(RegistrationStatus::pluck('registration_status', 'id'))
                                    ->default(function () {
                                        return RegistrationStatus::where('registration_status', 'Regular')->first()->id;
                                    })
                                    ->hiddenOn(['edit', 'view'])
                                    ->required(),
                                Select::make('student_term.student_type')
                                    ->native(false)
                                    ->label('Student type')
                                    ->options([
                                        'old' => 'Old',
                                        'new' => 'New',
                                    ])
                                    ->default('new')
                                    ->hiddenOn(['edit', 'view'])
                                    ->required(),
                                Select::make('student_term.program_id')
                                    ->native(false)
                                    ->label('Program Title')
                                    ->options(Program::pluck('program_title', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->hiddenOn(['edit', 'view'])
                                    ->required(),
                                TextInput::make('student_term.year_level')
                                    ->numeric()
                                    ->default(1)
                                    ->hiddenOn(['edit', 'view'])
                                    ->required(),
                            ]),
                    ]),
                Section::make('Medical information')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                TextInput::make('height')
                                    ->numeric(),
                                TextInput::make('weight')
                                    ->numeric(),
                                TextInput::make('complexion'),
                                TextInput::make('blood_type'),
                                Select::make('dominant_hand')
                                    ->native(false)
                                    ->options([
                                        'left' => 'Left',
                                        'right' => 'Right',
                                        'ambidextrous' => 'Ambidextrous',
                                    ]),
                                TextInput::make('medical_history'),
                            ]),
                    ]),
                Section::make('Student education')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                TextInput::make('lrn')
                                    ->label('Learner Reference Number (LRN)')
                                    ->numeric(),
                                TextInput::make('school_name'),
                                TextInput::make('school_address'),
                                TextInput::make('school_type'),
                                TextInput::make('strand'),
                                TextInput::make('year_entered')
                                    ->numeric(),
                                TextInput::make('year_graduated')
                                    ->numeric(),
                                TextInput::make('honors_awards'),
                                TextInput::make('general_average')
                                    ->numeric(),
                                TextInput::make('remarks'),
                                TextInput::make('org_name'),
                                TextInput::make('org_position'),
                                TextInput::make('previous_tertiary'),
                                TextInput::make('previous_sem'),
                            ]),
                    ]),
                Section::make('Student family')
                    ->schema([
                        Grid::make([
                            'sm' => 2,
                            'lg' => 3,
                        ])
                            ->schema([
                                TextInput::make('father_last_name'),
                                TextInput::make('father_first_name'),
                                TextInput::make('father_middle_name'),
                                TextInput::make('father_address'),
                                TextInput::make('father_contact_no'),
                                TextInput::make('father_office_employer'),
                                TextInput::make('father_office_address'),
                                TextInput::make('father_office_num'),
                                TextInput::make('mother_lastname'),
                                TextInput::make('mother_first_name'),
                                TextInput::make('mother_middle_name'),
                                TextInput::make('mother_address'),
                                TextInput::make('mother_contact_no'),
                                TextInput::make('mother_office_employer'),
                                TextInput::make('mother_office_address'),
                                TextInput::make('mother_office_num'),
                                TextInput::make('guardian_lastname'),
                                TextInput::make('guardian_first_name'),
                                TextInput::make('guardian_middle_name'),
                                TextInput::make('guardian_address'),
                                TextInput::make('guardian_contact_no'),
                                TextInput::make('guardian_office_employer'),
                                TextInput::make('guardian_office_address'),
                                TextInput::make('guardian_office_num'),
                                TextInput::make('annual_family_income')
                                    ->numeric(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_no')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('full_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('personal_email')
                    ->searchable(),
                TextColumn::make('plm_email')
                    ->searchable(),
                TextColumn::make('mobile_no')
                    ->searchable(),
                TextColumn::make('entry_date')
                    ->date()
                    ->searchable()
                    ->sortable(),
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
            ])
            ->headerActions([
                // ImportAction::make()
                //     ->importer(StudentImporter::class)
                
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}