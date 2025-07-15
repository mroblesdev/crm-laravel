<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::where('active', 1)->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function deleted()
    {
        $clients = Client::where('active', 0)->get();
        return view('clients.deleted', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'nullable|email'
        ]);

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'notes' => $request->notes,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('clients.index')->with('success', 'Cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return view('clients.notfound');
        }

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'nullable|email'
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->update(['active' => 0]);
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado');
    }

    public function activate(Client $client)
    {
        $client->update(['active' => 1]);
        return redirect()->route('clients.index')->with('success', 'Cliente reingresado');
    }
}
