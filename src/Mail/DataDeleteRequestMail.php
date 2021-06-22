<?php

namespace Webkul\GDPR\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DataDeleteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataDeleteRequest;

    public function __construct($dataDeleteRequest) {
        $this->dataDeleteRequest = $dataDeleteRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->dataDeleteRequest['email'])
            ->subject(trans('gdpr::app.mail.new-data-request.new-request-for-data-delete'))
            ->view('gdpr::emails.customers.new-data-delete-request')->with($this->dataDeleteRequest);
    }
}
