<?php

namespace App\Filament\Resources\ProgramCurriculumResource\Pages;

use App\Filament\Resources\ProgramCurriculumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramCurricula extends ListRecords
{
    protected static string $resource = ProgramCurriculumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}