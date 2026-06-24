<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class LeadVerificationEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $verifyUrl = URL::signedRoute('lead.verification.verify', [
            'id' => $notifiable->id,
            'hash' => $this->token,
        ]);

        return (new MailMessage)
            ->subject('Bestätigen Sie Ihre Email-Adresse — Praxis Website Score')
            ->view('emails.lead-verify', ['verifyUrl' => $verifyUrl]);
    }
}
