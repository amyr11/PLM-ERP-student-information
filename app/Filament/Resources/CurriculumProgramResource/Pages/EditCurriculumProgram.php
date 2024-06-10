<?php

namespace App\Filament\Resources\CurriculumProgramResource\Pages;

use App\Filament\Resources\CurriculumProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumProgram extends EditRecord
{
    protected static string $resource = CurriculumProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
