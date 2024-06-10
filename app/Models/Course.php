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

    public function curriculumCourses(): BelongsToMany
    {
        return $this->belongsToMany(CurriculumCourse::class, 'curriculum_courses', 'course_id', 'curriculum_id')
                    ->withPivot('semester', 'year_level')
                    ->withTimestamps();
    }
}