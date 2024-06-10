<?php

namespace App\Filament\Resources\CurriculumCourseResource\Pages;

use App\Filament\Resources\CurriculumCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumCourse extends EditRecord
{
    protected static string $resource = CurriculumCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
