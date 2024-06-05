<?php

// CAN'T MAKE IT WORK FOR DELETION. Handled email sending directly in PendingEmailStudentPortalResource instead.

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use App\Models\PendingEmailStudentPortal;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendStudentPortalCredentials;
use Illuminate\Support\Facades\Log;

class BulkSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $students;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $students)
    {
        $this->students = $students;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->students as $student) {
            $student = PendingEmailStudentPortal::find($student->id);
            if ($student && $student->student) {
                Mail::to($student->student->personal_email)->send(new SendStudentPortalCredentials($student));
                Log::info('Email sent to: ' . $student->student->personal_email);
            }
        }
    }
}