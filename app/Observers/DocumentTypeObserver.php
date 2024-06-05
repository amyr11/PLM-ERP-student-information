<?php

namespace App\Observers;

use App\Models\DocumentType;

class DocumentTypeObserver
{
    /**
     * Handle the DocumentType "created" event.
     */
    public function created(DocumentType $documentType): void
    {
        //
    }

    /**
     * Handle the DocumentType "updated" event.
     */
    public function updated(DocumentType $documentType): void
    {
        foreach ($documentType->requestedDocuments as $requestedDocument) {
            $requestedDocument->studentRequest->calculateTotalPrice();
        }
    }

    /**
     * Handle the DocumentType "deleted" event.
     */
    public function deleted(DocumentType $documentType): void
    {
        foreach ($documentType->requestedDocuments as $requestedDocument) {
            $requestedDocument->studentRequest->calculateTotalPrice();
        }
    }

    /**
     * Handle the DocumentType "restored" event.
     */
    public function restored(DocumentType $documentType): void
    {
        //
    }

    /**
     * Handle the DocumentType "force deleted" event.
     */
    public function forceDeleted(DocumentType $documentType): void
    {
        //
    }
}
