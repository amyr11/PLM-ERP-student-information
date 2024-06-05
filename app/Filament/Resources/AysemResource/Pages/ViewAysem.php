<?php

namespace App\Filament\Resources\AysemResource\Pages;

use App\Filament\Resources\AysemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAysem extends ViewRecord
{
    protected static string $resource = AysemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
