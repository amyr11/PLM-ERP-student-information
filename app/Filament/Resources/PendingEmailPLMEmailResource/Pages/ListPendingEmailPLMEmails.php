<?php

namespace App\Filament\Resources\PendingEmailPLMEmailResource\Pages;

use App\Filament\Resources\PendingEmailPLMEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingEmailPLMEmails extends ListRecords
{
    protected static string $resource = PendingEmailPLMEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
