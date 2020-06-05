<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRequest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $user;
    public $amount;
    public $currency;

    public function __construct($user, $amount, $currency)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->currency = $currency;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->markdown('mail.paymentRequest', ['user' => $this->user, 'amount' => $this->amount, 'currency' => $this->currency]);
    }
}
