<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Client::all());
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        // Retorna a view de criação (se for usar Blade)
        // return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|string',
            'address' => 'nullable|string'
        ]);

        $client = Client::create($validated);

        return response()->json($client, 201);
    }

    /**
     * Display the specified client.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        return response()->json(Client::findOrFail($id));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(string $id)
    {
        // Retorna a view de edição (se for usar Blade)
        // return view('clients.edit', ['client' => Client::findOrFail($id)]);
    }

    /**
     * Update the specified client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:clients,email,'.$client->id,
            'phone' => 'sometimes|string',
            'address' => 'nullable|string'
        ]);

        $client->update($validated);

        return response()->json($client);
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        Client::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}