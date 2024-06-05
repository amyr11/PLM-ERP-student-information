<?php

namespace App\Observers;

use App\Models\StudentTerm;

class StudentTermObserver
{
    /**
     * Handle the StudentTerm "created" event.
     */
    public function created(StudentTerm $studentTerm): void
    {
        //
    }

    /**
     * Handle the StudentTerm "updated" event.
     */
    public function updated(StudentTerm $studentTerm): void
    {
        if ($studentTerm->graduated) {
            if ($studentTerm->student->graduation_date === null) {
                $studentTerm->student->graduation_date = now();
                $studentTerm->student->save();
            }
        } else {
            $studentTerm->student->graduation_date = null;
            $studentTerm->student->save();
        }
    }

    /**
     * Handle the StudentTerm "delete d" event.
     */
    public function deleted(StudentTerm $studentTerm): void
    {
        //
    }

    /**
     * Handle the StudentTerm "restored" event.
     */
    public function restored(StudentTerm $studentTerm): void
    {
        //
    }

    /**
     * Handle the StudentTerm "force deleted" event.
     */
    public function forceDeleted(StudentTerm $studentTerm): void
    {
        //
    }
}
