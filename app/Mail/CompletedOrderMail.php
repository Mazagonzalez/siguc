<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\RequestThermoformed;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletedOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestId;
    public $comment;
    public $typeRequest;
    /**
     * Create a new message instance.
     */
    public function __construct($requestId, $comment, $typeRequest)
    {
        $this->requestId = $requestId;
        $this->comment = $comment;
        $this->typeRequest = $typeRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Orden completada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        try {
            if ($this->typeRequest == 1) {
                $request = Request::findOrFail($this->requestId);
            } elseif ($this->typeRequest == 3) {
                $request = RequestThermoformed::findOrFail($this->requestId);
            }
        } catch (\Exception $e) {
            Log::error('Error al cargar la request en CompletedOrderMail: ' . $e->getMessage());
        }

        return new Content(
            view: 'emails.completed-order-mail',
            with: [
                'request' => $request,
                'comment' => $this->comment,
            ],
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
