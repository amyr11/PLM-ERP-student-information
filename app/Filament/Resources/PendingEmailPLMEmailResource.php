<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingEmailPLMEmailResource\Pages;
use App\Filament\Resources\PendingEmailPLMEmailResource\RelationManagers;
use App\Mail\SendPLMEmailCredentials;
use App\Models\PendingEmailPLMEmail;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            ->recordUrl(null)
            ->columns([
                TextColumn::make('student.student_no')
                    ->sortable()
                    ->searchable()
                    ->label('Student No.'),
                TextColumn::make('student.plm_email')
                    ->sortable()
                    ->searchable()
                    ->label('PLM Email'),
                TextColumn::make('temp_password')
                    ->sortable()
                    ->searchable()
                    ->label('Temporary Password'),
                TextColumn::make('student.personal_email')
                    ->sortable()
                    ->searchable()
                    ->label('Personal Email'),
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
            ])
            ->headerActions([
                Action::make('send_emails')
                    ->label('Email All')
                    ->action(function () {
                        // Set max execution time to 300 seconds
                        ini_set('max_execution_time', 300);
                        
                        $students = PendingEmailPLMEmail::all();

                        foreach ($students as $student) {
                            if ($student && $student->student) {
                                try {
                                    // Send email
                                    Mail::to($student->student->personal_email)->send(new SendPLMEmailCredentials($student));
                                    Log::info('Email sent to: ' . $student->student->personal_email);

                                    // Delete the student from PendingEmailPLMEmail
                                    $student->delete();
                                    Log::info('Deleted student: ' . $student->student->student_no . ' from PendingEmailPLMEmail');
                                } catch (\Exception $e) {
                                    Log::error('Failed to send email to: ' . $student->student->personal_email . '. Error: ' . $e->getMessage());
                                }
                            }
                        }

                        return 'Emails are being sent!';
                    }),
                Action::make('edit_email_template')
                    ->label('Edit Email Template')
                    ->action(function (array $data) {
                        DB::table('email_templates')->updateOrInsert(
                            ['type' => 'plm_email_credentials'],
                            ['subject' => $data['subject'], 'body' => $data['body']]
                        );
                    })
                    ->mountUsing(function ($form) {
                        $template = DB::table('email_templates')->where('type', 'plm_email_credentials')->first();
                        $form->fill([
                            'subject' => $template->subject ?? 'Your PLM Email Credentials',
                            'body' => $template->body ?? 
'<p>Dear Student,</p>
<p>Your PLM email credentials are as follows:</p>
<p>Email: {{ $plm_email }}</p>
<p>Password: {{ $temp_password }}</p>
<p>Please log in and change your password immediately.</p>
<p>Best regards,</p>
<p>PLM Office of the University Registrar</p>',
                        ]);
                    })
                    ->form([
                        TextInput::make('subject')->label('Email Subject')->required(),
                        Textarea::make('body')
                            ->label('Email Body')
                            ->required()
                            ->rows(7),
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