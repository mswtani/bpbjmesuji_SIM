<?php

namespace App\Mail;

use App\Models\HelpdeskTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HelpdeskAccessLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Tiket Helpdesk.
     */
    public HelpdeskTicket $ticket;

    /**
     * URL akses tiket.
     */
    public string $ticketUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(
        HelpdeskTicket $ticket,
        string $ticketUrl
    ) {
        $this->ticket = $ticket;
        $this->ticketUrl = $ticketUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tautan Akses Tiket Helpdesk - '
                . $this->ticket->ticket_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.helpdesk.access-link',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}