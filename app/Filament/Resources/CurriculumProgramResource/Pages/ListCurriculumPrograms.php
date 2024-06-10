<?php

namespace App\Filament\Resources\CurriculumProgramResource\Pages;

use App\Filament\Resources\CurriculumProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumPrograms extends ListRecords
{
    protected static string $resource = CurriculumProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
