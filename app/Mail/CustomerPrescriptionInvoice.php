<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Prescription;
use App\PrescriptionInvoice;

class CustomerPrescriptionInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $invoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Prescription $order, PrescriptionInvoice $invoice)
    {
        $this->order = $order;
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->email)->subject('Prescription Invoice')->view('emails.prescriptioninvoice',compact('order','invoice'));
    }
}
