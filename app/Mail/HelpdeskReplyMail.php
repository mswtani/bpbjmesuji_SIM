<?php

namespace App\Mail;

use App\Models\HelpdeskMessage;
use App\Models\HelpdeskTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HelpdeskReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Tiket Helpdesk.
     */
    public HelpdeskTicket $ticket;

    /**
     * Balasan terbaru dari petugas.
     */
    public HelpdeskMessage $reply;

    /**
     * Create a new message instance.
     */
    public function __construct(
        HelpdeskTicket $ticket,
        HelpdeskMessage $reply
    ) {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Balasan Helpdesk - ' . $this->ticket->ticket_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.helpdesk.reply',
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