<?php

namespace App\Models;

use App\Services\PLMEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    private function generatePLMEmail() {
        $this->plm_email = PLMEmail::generate($this->first_name, $this->middle_name, $this->last_name, $this->entry_date);
        $this->save();
    }

    private function generateStudentNumber() {
        $entryYear = $this->entry_date->format('Y');
        $series = $this->id;
        
        // Check if the student's 'city_id' belongs to 'Manila'
        $city = City::find($this->city_id);
        $cityName = $city->city_name;
        $cityIsManila = $cityName === 'Manila';
        // If the student lives in manila, create a variable with value 0, else 1
        $cityNumber = $cityIsManila ? 0 : 1;

        $studentNo = $entryYear . $cityNumber . str_pad($series, 4, '0', STR_PAD_LEFT);
        $this->student_no = $studentNo;
        $this->save();
    }

    protected static function booted()
    {
        static::created(function ($student) {
            $student->generateStudentNumber();
            $student->generatePLMEmail();
        });
    }
}
