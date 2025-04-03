<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class MailController extends Controller
{
    public function sendTestEmail(Request $request)
    {
        try {
            // Enviar o e-mail
            Mail::to('teste@example.com')->send(new TestEmail());

            // Garantir que a mensagem flash está sendo definida corretamente
            return to_route('dashboard')->with('success', 'E-mail enviado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, adicionar mensagem de erro
            return to_route('dashboard')->with('error', 'Falha ao enviar o e-mail.');
        }
    }
}
