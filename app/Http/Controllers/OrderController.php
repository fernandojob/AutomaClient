<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index($clientId)
    {
        $client = Client::with('orders')->findOrFail($clientId);
        return response()->json($client);
    }

    public function store(Request $request, $clientId)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $client = Client::findOrFail($clientId);
        $order = $client->orders()->create($request->all());

        // Enviar e-mail para o cliente
        Mail::to($client->email)->send(new OrderConfirmationMail($order));

        return response()->json([
            'message' => 'Pedido criado e e-mail enviado!',
            'order' => $order
        ], 201);
    }
}
