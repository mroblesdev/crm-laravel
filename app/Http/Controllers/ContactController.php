<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:contactos', only: ['index']),
            new Middleware('permission:contactos-crear', only: ['create', 'store']),
            new Middleware('permission:contactos-editar', only: ['edit', 'update']),
            new Middleware('permission:contactos-eliminar', only: ['destroy']),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
        ]);

        $client->contacts()->create($request->all());

        return back()->with('success', 'Contacto agregado');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client, Contact $contact)
    {
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
        ]);

        $contact->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client, Contact $contact)
    {
        $contact->delete();
        return back();
    }
}
