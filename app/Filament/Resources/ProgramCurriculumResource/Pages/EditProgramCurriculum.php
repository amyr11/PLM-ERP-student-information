<?php

namespace App\Filament\Resources\ProgramCurriculumResource\Pages;

use App\Filament\Resources\ProgramCurriculumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramCurriculum extends EditRecord
{
    protected static string $resource = ProgramCurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
