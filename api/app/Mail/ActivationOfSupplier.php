<?php

namespace App\Mail;

use App\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationOfSupplier extends Mailable
{
    use Queueable, SerializesModels;

    private $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function build()
    {
        return $this->markdown('emails.supplier.activation')
            ->subject('Ative seu email de fornecedor')
            ->with([
                'supplier' => $this->supplier
            ]);
    }
}
