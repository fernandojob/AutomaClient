<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use TCPDF;

class ClientPdfController extends Controller
{
    public function generatePDF()
    {
        
        $clients = Client::all();
        
        $pdf = new TCPDF();

        $pdf->SetCreator('Laravel TCPDF');
        $pdf->SetAuthor('Seu Nome');
        $pdf->SetTitle('Lista de Clientes');
        $pdf->SetSubject('Relatório de Clientes');
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 12);

        $html = '<h1 style="text-align:center;">Lista de Clientes</h1>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Nome</b></th>
                            <th><b>Email</b></th>
                            <th><b>Telefone</b></th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($clients as $client) {
            $html .= '<tr>
                        <td>' . $client->id . '</td>
                        <td>' . $client->name . '</td>
                        <td>' . $client->email . '</td>
                        <td>' . $client->phone . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        return response($pdf->Output('clientes.pdf', 'D'))
            ->header('Content-Type', 'application/pdf');
    }
}
