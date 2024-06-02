<?php

namespace App\Filament\Resources\StudentRequestResource\Pages;

use App\Filament\Resources\StudentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentRequest extends ViewRecord
{
    protected static string $resource = StudentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
