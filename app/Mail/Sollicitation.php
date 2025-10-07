<?php

namespace App\Mail;

use App\Models\Application;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class Sollicitation extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;

    /**
     * Create a new message instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('PERSONAL_MAIL_FROM_ADDRESS', 'matse@vanhorebeek.be'), env('PERSONAL_MAIL_FROM_NAME', 'Matse Van Horebeek')),
            subject: $this->application->template->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $html = RichContentRenderer::make($this->application->template->body)
            ->mergeTags([
                'company' => $this->application->company_name ?? '',
                'contact_person' => $this->application->company_contact ?? 'meneer/mevrouw',
                'contact_email' => $this->application->company_email ?? '',
                'role' => $this->application->company_role ?? '',
                'application_name' => $this->application->company_application_name ?? '',
                'application_url' => $this->application->company_application_url ?? '',
                'note' => RichContentRenderer::make($this->application->note)
                    ->mergeTags([
                        'company' => $this->application->company_name ?? '',
                        'contact_person' => $this->application->company_contact ?? 'meneer/mevrouw',
                        'contact_email' => $this->application->company_email ?? '',
                        'role' => $this->application->company_role ?? '',
                        'application_name' => $this->application->company_application_name ?? '',
                        'application_url' => $this->application->company_application_url ?? '',
                    ]) ?? ''
            ])
            ->toHtml();

        return new Content(
            view: 'emails.sollicitation-text',
            with: ['html' => $html],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        if (!$this->application->letter) {
            return [
                Attachment::fromStorageDisk('public', $this->application->document->file_path)
                    ->as('cv_Matse_Van_Horebeek.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [
            Attachment::fromStorageDisk('public', $this->application->document->file_path)
                ->as('cv_Matse_Van_Horebeek.pdf')
                ->withMime('application/pdf'),
            Attachment::fromStorageDisk('private', $this->application->letter)
                ->as('sollicitatiebrief_Matse_Van_Horebeek.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
