<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    
    public function index()
    {
        $clients = Client::all();
        return Inertia::render('Clients/index', ['clients' => $clients]);
    }

    
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        Client::create($validated);

        return Redirect::route('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    
    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return Redirect::route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return Redirect::route('clients.index')->with('success', 'Cliente removido com sucesso!');
    }

    public function exportPdf()
    {
        // Obtém os clientes do banco de dados
        $clients = Client::all();

        // Criando novo PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AutomaClient');
        $pdf->SetTitle('Lista de Clientes');
        $pdf->SetHeaderData('', 0, 'Lista de Clientes', '');

        // Definindo margens
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Definindo o HTML do PDF
        $html = '<h1>Lista de Clientes</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">';
        $html .= '<tr>
                    <th><strong>Nome</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Telefone</strong></th>
                    <th><strong>Endereço</strong></th>
                  </tr>';

        foreach ($clients as $client) {
            $html .= '<tr>
                        <td>' . $client->name . '</td>
                        <td>' . $client->email . '</td>
                        <td>' . $client->phone . '</td>
                        <td>' . $client->address . '</td>
                      </tr>';
        }

        $html .= '</table>';

        
        $pdf->writeHTML($html, true, false, true, false, '');

        
        return response($pdf->Output('clientes.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }
}
