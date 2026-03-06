<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AguinaldoMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public $empleado,
        public $pdf
    ) {}

    public function build()
    {
        return $this->subject('Informacion de aguinaldo')
            ->view('emails.aguinaldo')
            ->attachData(
                $this->pdf->output(),
                'aguinaldo.pdf',
                ['mime' => 'application/pdf']
            );
    }
}
