<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class StudentTerm extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function aysem(): BelongsTo
    {
        return $this->belongsTo(Aysem::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    public function registrationStatus(): BelongsTo
    {
        return $this->belongsTo(RegistrationStatus::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_no', 'student_no');
    }

    public static function getStudentCountByYearLevel(int $yearLevel, Aysem $aysem): int
    {
        $latestStudents = static::select('student_no', DB::raw('MAX(id) as latest_id'))
            ->where('aysem_id', $aysem->id)
            ->groupBy('student_no');
    
        return static::whereIn('id', $latestStudents->pluck('latest_id'))
            ->where('year_level', $yearLevel)
            ->where('aysem_id', $aysem->id)
            ->where('enrolled', true)
            ->count();
    }

    public static function getEnrolledStudentCount($aysem): int
    {
        $latestStudents = static::select('student_no', DB::raw('MAX(id) as latest_id'))
            ->where('aysem_id', $aysem->id)
            ->groupBy('student_no');
    
        return static::whereIn('id', $latestStudents->pluck('latest_id'))
            ->where('enrolled', true)
            ->count();
    }
    
}
