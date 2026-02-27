<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ColillaPagoMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public $empleado,
        public $pdf
    ) {}

    public function build()
    {
        return $this->subject('Colilla de pago')
            ->view('emails.colilla')
            ->attachData(
                $this->pdf->output(),
                'colilla_pago.pdf',
                ['mime' => 'application/pdf']
            );
    }
}
