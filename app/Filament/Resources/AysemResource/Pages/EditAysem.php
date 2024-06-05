<?php

namespace App\Filament\Resources\AysemResource\Pages;

use App\Filament\Resources\AysemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAysem extends EditRecord
{
    protected static string $resource = AysemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
