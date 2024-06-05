<?php

namespace App\Filament\Resources\StudentTermResource\Pages;

use App\Filament\Resources\StudentTermResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentTerms extends ListRecords
{
    protected static string $resource = StudentTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
