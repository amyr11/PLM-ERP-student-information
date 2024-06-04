<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PendingEmailPLMEmail;
use Illuminate\Support\Facades\DB;

class SendPLMEmailCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $plmEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(PendingEmailPLMEmail $plmEmail)
    {
        $this->plmEmail = $plmEmail;
    }

    public function build()
    {
        $template = DB::table('email_templates')->where('type', 'plm_email_credentials')->first();

        // Define default values
        $defaultSubject = 'Your PLM Email Credentials';
        $defaultBody = '
            <p>Dear Student,</p>
            <p>Your PLM email credentials are as follows:</p>
            <p>Email: {{ $plm_email }}</p>
            <p>Password: {{ $temp_password }}</p>
            <p>Please log in and change your password immediately.</p>
            <p>Best regards,</p>
            <p>PLM Office of the University Registrar</p>
        ';

        return $this->view('emails.plm_email_credentials')
            ->subject($template->subject ?? $defaultSubject)
            ->with([
                'subject' => $template->subject ?? $defaultSubject,
                'body' => str_replace(
                    ['{{ $plm_email }}', '{{ $temp_password }}'],
                    [$this->plmEmail->student->plm_email, $this->plmEmail->temp_password],
                    $template->body ?? $defaultBody
                ),
            ]);
    }
}