<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aysem extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public static function current(): Aysem
    {
        // Return the latest academic year and semester
        return static::orderBy('academic_year', 'desc')
            ->orderBy('semester', 'desc')
            ->first();
    }
}
