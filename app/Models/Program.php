<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function studentTerm(): HasMany
    {
        return $this->hasMany(StudentTerm::class);
    }

    public function getStudentCountOnCurrentAysem(): int
    {
        return $this->studentTerm()
            ->where('aysem_id', Aysem::current()->id)
            ->where('enrolled', true)
            ->where('graduated', false)
            ->count();
    }
}
