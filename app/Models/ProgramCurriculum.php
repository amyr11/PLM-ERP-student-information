<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramCurriculum extends Pivot
{
    protected $table = 'program_curriculum';

    protected $fillable = [
        'program_id',
        'curriculum_id',
    ];
}