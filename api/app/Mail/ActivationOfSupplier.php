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
        return $this->view('emails.supplier.activation')
            ->subject('Ative seu email de fornecedor')
            ->with([
                'supplierName'  => $this->supplier->name,
                'urlActivation' => env('APP_CLIENT_URL_ACTIVATION_SUPPLIER')
                    . sprintf("?supplier=%s&token=%s", $this->supplier->id, $this->supplier->hashactivation)
            ]);
    }
}
