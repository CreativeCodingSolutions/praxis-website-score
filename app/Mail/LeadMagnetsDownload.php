<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadMagnetsDownload extends Mailable
{
    use Queueable, SerializesModels;

    public string $magnetType;

    public function __construct(string $magnetType = 'pws_security')
    {
        $this->magnetType = $magnetType;
    }

    public function envelope(): \Illuminate\Mail\Envelope
    {
        $subject = match ($this->magnetType) {
            'pws_security' => 'Ihre DSGVO- & Sicherheits-Checkliste für Praxis-Websites',
            default => 'Ihr Lead Magnet ist bereit',
        };

        return new \Illuminate\Mail\Envelope(
            subject: $subject,
        );
    }

    public function content(): \Illuminate\Mail\Content
    {
        $downloadUrl = match ($this->magnetType) {
            'pws_security' => '/downloads/pws-security-checklist.pdf',
            default => '/downloads/lead-magnet.pdf',
        };

        return new \Illuminate\Mail\Content(
            view: 'emails.lead-magnet-download',
            with: ['downloadUrl' => $downloadUrl, 'magnetType' => $this->magnetType],
        );
    }
}
