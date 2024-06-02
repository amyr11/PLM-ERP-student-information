<?php

namespace App\Filament\Resources\PendingEmailPLMEmailResource\Pages;

use App\Filament\Resources\PendingEmailPLMEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingEmailPLMEmail extends EditRecord
{
    protected static string $resource = PendingEmailPLMEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
