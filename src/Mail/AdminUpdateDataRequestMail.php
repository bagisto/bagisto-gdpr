<?php

namespace Webkul\GDPR\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminUpdateDataRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminUpdateRequest;

    public function __construct($adminUpdateRequest) {
        $this->adminUpdateRequest = $adminUpdateRequest;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->adminUpdateRequest['email'])
            ->subject('Request Status')
            ->view('gdpr::emails.customers.admin-update-data-request')->with($this->adminUpdateRequest);
    }
}
