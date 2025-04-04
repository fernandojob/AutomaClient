<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientsReportMail;
use TCPDF;

class ReportController extends Controller
{
    public function sendClientsReport()
    {
        $clients = Client::with('orders')->get();

        // Criando o PDF com TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator('AutomaClient');
        $pdf->SetAuthor('AutomaClient');
        $pdf->SetTitle('Relatório de Clientes e Pedidos');
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        $html = view('pdf.clients_orders', compact('clients'))->render();
        $pdf->writeHTML($html, true, false, true, false, '');

        // Salvando o PDF temporariamente
        $pdfPath = storage_path('app/public/relatorio_clientes.pdf');
        $pdf->Output($pdfPath, 'F'); // 'F' salva o arquivo no servidor

        // Enviar e-mail com o relatório em anexo
        Mail::to('fernandonunesjob@gmail.com')->send(new ClientsReportMail($pdfPath));

        return redirect()->back()->with('success');
    }
}
