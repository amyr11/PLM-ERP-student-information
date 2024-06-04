<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PendingEmailStudentPortal;
use Illuminate\Support\Facades\DB;

class SendStudentPortalCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $studentPortal;

    /**
     * Create a new message instance.
     */
    public function __construct(PendingEmailStudentPortal $studentPortal)
    {
        $this->studentPortal = $studentPortal;
    }

    public function build()
    {
        $template = DB::table('email_templates')->where('type', 'student_portal_credentials')->first();

        // Define default values
        $defaultSubject = 'Your Student Portal Credentials';
        $defaultBody = '
            <p>Dear Student,</p>
            <p>Your student portal credentials are as follows:</p>
            <p>Username: {{ $student_no }}</p>
            <p>Password: {{ $temp_password }}</p>
            <p>Please log in and change your password immediately.</p>
            <p>Best regards,</p>
            <p>PLM Office of the University Registrar</p>
        ';

        return $this->view('emails.student_portal_credentials')
            ->subject($template->subject ?? $defaultSubject)
            ->with([
                'subject' => $template->subject ?? $defaultSubject,
                'body' => str_replace(
                    ['{{ $student_no }}', '{{ $temp_password }}'],
                    [$this->studentPortal->student->student_no, $this->studentPortal->temp_password],
                    $template->body ?? $defaultBody
                ),
            ]);
    }
}