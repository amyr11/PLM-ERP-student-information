<?php

namespace App\Filament\Resources\PendingEmailStudentPortalResource\Pages;

use App\Filament\Resources\PendingEmailStudentPortalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingEmailStudentPortals extends ListRecords
{
    protected static string $resource = PendingEmailStudentPortalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
