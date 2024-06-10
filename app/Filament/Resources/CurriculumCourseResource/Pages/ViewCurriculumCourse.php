<?php

namespace App\Filament\Resources\CurriculumCourseResource\Pages;

use App\Filament\Resources\CurriculumCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCurriculumCourse extends ViewRecord
{
    protected static string $resource = CurriculumCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}