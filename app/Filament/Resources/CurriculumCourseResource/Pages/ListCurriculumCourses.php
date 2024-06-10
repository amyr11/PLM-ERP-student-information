<?php

namespace App\Filament\Resources\CurriculumCourseResource\Pages;

use App\Filament\Resources\CurriculumCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumCourses extends ListRecords
{
    protected static string $resource = CurriculumCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
