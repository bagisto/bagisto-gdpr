<?php

namespace Webkul\GDPR\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DataUpdateRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataUpdateRequest;

    public function __construct($dataUpdateRequest) {
        $this->dataUpdateRequest = $dataUpdateRequest;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->dataUpdateRequest['email'])
            ->subject(trans('gdpr::app.mail.new-data-request.new-request-for-data-update'))
            ->view('gdpr::emails.customers.new-data-update-request')->with($this->dataUpdateRequest);
    }
}
