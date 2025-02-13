<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class EmployeeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public array $mailData;
    public ?string $attachmentPath;

    public function __construct(array $mailData, ?string $attachmentPath=null)
    {
        //
        $this->mailData = $mailData;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailData['subject'],
           // message:$this->mailData['message'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.employee_email',
            with: ['mailData' => $this->mailData]
        );
   
          //  with: ['messageContent' => $this->messageContent]
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return !empty($this->attachmentPath)&&file_exists($this->attachmentPath)
        ?[Attachment::fromPath($this->attachmentPath)]
        :[];
    }
}
