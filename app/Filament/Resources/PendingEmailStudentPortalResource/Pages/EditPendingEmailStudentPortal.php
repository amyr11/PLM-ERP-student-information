<?php

namespace App\Filament\Resources\PendingEmailStudentPortalResource\Pages;

use App\Filament\Resources\PendingEmailStudentPortalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingEmailStudentPortal extends EditRecord
{
    protected static string $resource = PendingEmailStudentPortalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
