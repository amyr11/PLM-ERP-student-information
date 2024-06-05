<?php

namespace App\Filament\Resources\AysemResource\Pages;

use App\Filament\Resources\AysemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAysems extends ListRecords
{
    protected static string $resource = AysemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
