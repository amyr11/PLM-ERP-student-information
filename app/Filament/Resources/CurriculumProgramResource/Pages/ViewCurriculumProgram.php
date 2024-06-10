<?php

namespace App\Filament\Resources\CurriculumProgramResource\Pages;

use App\Filament\Resources\CurriculumProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCurriculumProgram extends ViewRecord
{
    protected static string $resource = CurriculumProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}