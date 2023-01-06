<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class InvitationLetter extends Mailable
{
    use Queueable, SerializesModels;
    private $invitationUrl;
    private $invitationText;
    private $userName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitationUrl, $invitationText, $userName)
    {
        $this->invitationUrl = $invitationUrl;
        $this->invitationText = $invitationText;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromMail = config('mail.from.address');
        $fromName = config('mail.from.name');
        $subject = 'Invitation Letter';
        return $this->from($fromMail, $fromName)
            ->view('emails.invitation',['url' => $this->invitationUrl, 'text' => $this->invitationText, 'name' => $this->userName])
            ->subject($subject);
    }
}