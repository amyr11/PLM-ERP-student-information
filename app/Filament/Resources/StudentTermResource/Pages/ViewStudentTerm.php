<?php

namespace App\Filament\Resources\StudentTermResource\Pages;

use App\Filament\Resources\StudentTermResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentTerm extends ViewRecord
{
    protected static string $resource = StudentTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
