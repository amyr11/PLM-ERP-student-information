<?php

namespace App\Observers;

use App\Models\RequestedDocument;

class RequestedDocumentObserver
{
    /**
     * Handle the RequestedDocument "created" event.
     */
    public function created(RequestedDocument $requestedDocument): void
    {
        $requestedDocument->studentRequest->calculateTotalPrice();
    }

    /**
     * Handle the RequestedDocument "updated" event.
     */
    public function updated(RequestedDocument $requestedDocument): void
    {
        $requestedDocument->studentRequest->calculateTotalPrice();
    }

    /**
     * Handle the RequestedDocument "deleted" event.
     */
    public function deleted(RequestedDocument $requestedDocument): void
    {
        $requestedDocument->studentRequest->calculateTotalPrice();
    }

    /**
     * Handle the RequestedDocument "restored" event.
     */
    public function restored(RequestedDocument $requestedDocument): void
    {
        //
    }

    /**
     * Handle the RequestedDocument "force deleted" event.
     */
    public function forceDeleted(RequestedDocument $requestedDocument): void
    {
        //
    }
}
