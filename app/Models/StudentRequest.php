<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentRequest extends Model
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
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_no', 'student_no');
    }

    public function studentRequestMode(): BelongsTo
    {
        return $this->belongsTo(StudentRequestMode::class, 'student_request_mode_id');
    }

    public function studentRequestStatus(): BelongsTo
    {
        return $this->belongsTo(StudentRequestStatus::class, 'student_request_status_id');
    }
}