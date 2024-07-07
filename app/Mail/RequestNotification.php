<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $bodyDetails = $this->details;
        $subject = $this->details['document_name'] . ' ' . $this->details['document'] . '-' . $this->details['doc_id'] . '  Action Required';
        // return $this->from('support@qzolve.com', 'Qzolve ERP')
        // ->subject($subject)->view('procurement.email.actionLink', compact('bodyDetails'));
        return $this->from('erp@al-hada.com.sa', 'Al Hada - Qzolve ERP')
            ->subject($subject)->view('request_and_approval.email.notifiy', compact('bodyDetails'));
    }
}
