<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CurriculumCourse extends Pivot
{
    protected $table = 'curriculum_course';

    protected $fillable = [
        'curriculum_id',
        'course_id',
        'semester',
        'year_level',
    ];
}