<?php

namespace App\Models;

use App\Observers\RequestedDocumentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([RequestedDocumentObserver::class])]
class RequestedDocument extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function requestedDocumentStatus(): BelongsTo
    {
        return $this->belongsTo(RequestedDocumentStatus::class);
    }

    public function studentRequest(): BelongsTo
    {
        return $this->belongsTo(StudentRequest::class);
    }
}