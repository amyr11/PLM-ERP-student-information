<?php

namespace App\Models;

use App\Services\PLMEmail;
use App\Services\StudentCredential;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_no';
    public $incrementing = false;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'entry_date' => 'date',
    ];

    public static function generateStudentNumber($academic_year, $city_id) {
        // Series number which is the next number in the total number of students in a specific aysem
        $series = Student::whereHas('aysem', function($query) use ($academic_year) {
            $query->where('academic_year', $academic_year);
        })->count() + 1;
        
        // Check if the student's 'city_id' belongs to 'Manila'
        $city = City::find($city_id);
        $cityName = $city->city_name;
        $cityIsManila = $cityName === 'Manila';
        // If the student lives in manila, create a variable with value 0, else 1
        $cityNumber = $cityIsManila ? 0 : 1;

        $studentNo = $academic_year . $cityNumber . str_pad($series, 4, '0', STR_PAD_LEFT);
        
        return $studentNo;
    }

    private function storePassword($password) {
        $this->password = Hash::make($password);
        $this->save();
    }
    
    private function addTerm($aysemId) {
        $this->terms()->create([
            'aysem_id' => $aysemId,
            'registration_status_id' => RegistrationStatus::where('status', 'Pending')->first()->id,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    | Below are the relationships of the Student model with other models
    |
    */

    public function terms(): HasMany
    {
        return $this->hasMany(StudentTerm::class);
    }

    public function biologicalSex(): BelongsTo
    {
        return $this->belongsTo(BiologicalSex::class);
    }

    public function civilStatus(): BelongsTo
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function citizenship(): BelongsTo
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function birthplaceCity(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function aysem(): BelongsTo
    {
        return $this->belongsTo(Aysem::class);
    }

    protected static function booted()
    {
        static::created(function ($student) {
            $randomPassword = Str::random(6);
            $student->storePassword($randomPassword);
            StudentCredential::addToPendingCredentials($student->student_no, $randomPassword);
        });
    }
}
