<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $password;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;  // Store email
        $this->password = $password;  // Store password
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Peer Assessment Tool Account'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.user-password', // View path for the email
            with: [
                'password' => $this->password, // Pass the password to the view
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Set the recipient email address.
     */
    public function build()
    {
        return $this->to($this->email)  // Specify the recipient
                    ->subject('Your Peer Assessment Tool Account')  // Ensure subject is correct
                    ->view('mail.user-password')
                    ->with([
                        'password' => $this->password,  // Pass the password to the view
                    ]);
    }
}
