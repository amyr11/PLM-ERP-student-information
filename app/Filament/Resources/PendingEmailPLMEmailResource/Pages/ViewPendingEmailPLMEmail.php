<?php

namespace App\Filament\Resources\PendingEmailPLMEmailResource\Pages;

use App\Filament\Resources\PendingEmailPLMEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPendingEmailPLMEmail extends ViewRecord
{
    protected static string $resource = PendingEmailPLMEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
