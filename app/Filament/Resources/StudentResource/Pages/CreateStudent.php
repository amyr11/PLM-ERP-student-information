<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\StudentTerm;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Insert the student
        $tempData = $data;
        unset($tempData['student_term']['registration_status_id']);
        unset($tempData['student_term']['program_id']);
        unset($tempData['student_term']['year_level']);
        unset($tempData['student_term']['student_type']);
        $record = static::getModel()::create($tempData);

        // Insert the student term
        $record->addTerm(
            $data['aysem_id'],
            $data['student_term']['program_id'],
            null,
            $data['student_term']['registration_status_id'],
            $data['student_term']['student_type'],
            false,
            false,
            $data['student_term']['year_level']
        );

        return $record;
    }
}
