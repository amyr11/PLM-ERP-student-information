<?php

namespace App\Models;

use App\Observers\DocumentTypeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(DocumentTypeObserver::class)]
class DocumentType extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function requestedDocuments(): HasMany
    {
        return $this->hasMany(RequestedDocument::class);
    }
}
