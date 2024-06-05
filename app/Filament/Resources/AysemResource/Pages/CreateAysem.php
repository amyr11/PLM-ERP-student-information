<?php

namespace App\Filament\Resources\AysemResource\Pages;

use App\Filament\Resources\AysemResource;
use App\Models\Student;
use App\Models\StudentTerm;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAysem extends CreateRecord
{
    protected static string $resource = AysemResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = parent::handleRecordCreation($data);

        // Loop through all students
        foreach (Student::all() as $student) {
            // Get the latest record of this student on the StudentTerm
            $latestStudentTerm = StudentTerm::where('student_no', $student->student_no)->latest()->first();

            if ($latestStudentTerm->graduated || !$latestStudentTerm->enrolled) {
                continue;
            }

            $aysemId = $record->id;
            $programId = $latestStudentTerm->program_id;
            $registrationStatusId = $latestStudentTerm->registration_status_id;
            $studentType = 'old';
            $graduating = false;
            $enrolled = false;
            $yearLevel = $latestStudentTerm->year_level + 1;

            $student->addTerm(
                $aysemId,
                $programId,
                null,
                $registrationStatusId,
                $studentType,
                $graduating,
                $enrolled,
                $yearLevel
            );
        }

        return $record;
    }
}
