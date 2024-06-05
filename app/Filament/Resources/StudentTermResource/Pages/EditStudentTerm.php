<?php

namespace App\Filament\Resources\StudentTermResource\Pages;

use App\Filament\Resources\StudentTermResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentTerm extends EditRecord
{
    protected static string $resource = StudentTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
