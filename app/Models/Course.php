<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function curriculums(): BelongsToMany
    {
        return $this->belongsToMany(Curriculum::class)
                    ->withPivot('semester', 'year_level')
                    ->withTimestamps();
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function aysem(): BelongsTo
    {
        return $this->belongsTo(Aysem::class);
    }
}