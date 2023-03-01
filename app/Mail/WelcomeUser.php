<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $txt;
    private $link;


    public function __construct($txt,$link)
    {
        $this->txt = $txt;
        $this->link = $link;

    }

    public function build()
    {
        //   return $this->view('emails.order');
        return $this->from('info@releeze.com')
            ->subject('welcome home!')
            //    ->attach($this->pdf_file)
            ->view('mails.register',[ 'user_name'=>$this->txt,'link'=>$this->link]);
    }

    /**
     * Get the message envelope.
     */
//    public function envelope(): Envelope
//    {
////        return new Envelope(
////            subject: 'Welcome User',
////        );
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
////        return new Content(
////            view: 'view.name',
////        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
