<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientsReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Relatório de Clientes e Pedidos')
                    ->markdown('emails.clients_report')
                    ->attach($this->pdfPath, [
                        'as' => 'relatorio_clientes_pedidos.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
