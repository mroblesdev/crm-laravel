<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use App\Models\Client;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:clientes', only: ['index']),
            new Middleware('permission:clientes-crear', only: ['create', 'store']),
            new Middleware('permission:clientes-editar', only: ['edit', 'update']),
            new Middleware('permission:clientes-eliminar', only: ['destroy']),
            new Middleware('permission:clientes-reingresar', only: ['activate']),
        ];
    }
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
        $client->load('contacts');

        return view('clients.show', compact('client'));
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

    public function generatePdf($id)
    {
        $client = Client::with('followUps')->findOrFail($id);
        $logo = Setting::getValue('logo');

        $pdf = Pdf::loadView('clients.details', compact('client', 'logo'))->setPaper('letter');
        return $pdf->download('cliente_' . $client->id . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }

    public function formUplodClientes()
    {
        return view('clients.import');
    }

    public function import(Request $resquest)
    {
        print_r($resquest->file('file'));
        Excel::import(new ClientsImport, $resquest->file('file'));

        return redirect()->route('clients.index')->with('success', 'Carga masiva de clientes con éxito');
    }
}
