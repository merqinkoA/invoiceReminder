<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Reminder2Mail extends Mailable
{
    use Queueable, SerializesModels;
    public $emailData;
    /**
     * Create a new message instance.
     */
    public function __construct($emailData)
    {
        //
        $this->emailData = $emailData;
    }
    // public function build()
    // {
    //     return $this->subject('Subject of the Email')
    //         ->view('emails.IRtemplate') // Replace 'your_template' with your email template blade file
    //         ->with(['emailData' => $this->emailData]); // Pass data to the email template
    // }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('info@sumbawatimurmining.co.id', 'Sumbawa Timur Mining'),
            subject: 'Invoice Submit Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(

            view: 'emails.ReminderTemplate2',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
