<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

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

        return response()->json($order, 201);
    }
}
