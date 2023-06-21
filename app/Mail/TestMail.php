<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $status;
    public $risk;
    public $requestType;
    public $viewName;
    

    /**
     * Create a new message instance.
     *
     * @param  string  $status
     * @param  mixed  $risk
     * @param  string  $requestType
     * @param  string  $viewName
     * @return void
     */
     
    public function __construct($status, $risk, $requestType, $viewName)
    {
        $this->status = $status;
        $this->risk = $risk;
        $this->requestType = $requestType;
        $this->viewName = $viewName;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
     public function envelope()
    {
        return new Envelope(
            subject: 'Test Mail',
        );
    }
    
      /**
     * Build the message.
     *
     * @return $this
     */
     

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'Email.email',
        );
    }
    
    public function build()
    {
        if ($this->viewName === 'approval-mail') {
            return $this->view('Email.approval-mail')
                ->subject('Approval Email')
                ->with([
                    'status' => $this->status,
                    'risk' => $this->risk,
                ]);
        } else {
            return $this->view('Email.rejection-mail')
                ->subject('Rejection Email')
                ->with([
                    'status' => $this->status,
                    'risk' => $this->risk,
                ]);
        }
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
