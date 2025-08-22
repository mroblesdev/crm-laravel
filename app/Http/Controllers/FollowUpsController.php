<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FollowUps;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FollowUpsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:seguimientos', only: ['index']),
            new Middleware('permission:seguimientos-crear', only: ['create', 'store']),
            new Middleware('permission:seguimientos-editar', only: ['edit', 'update']),
            new Middleware('permission:seguimientos-eliminar', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {
        $client->load('followUps');

        return view('clients.followups.index', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'follow_up_date' => 'required|date'
        ]);

        $client->followUps()->create([
            'subject' => $request->subject,
            'description' => $request->description,
            'follow_up_date' => $request->follow_up_date,
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client, $followUpId)
    {
        $followUp = $client->followUps()->findOrFail($followUpId);

        return response()->json($followUp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client, $followUpId)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'follow_up_date' => 'required|date'
        ]);

        $followUp = FollowUps::find($followUpId);
        $followUp->subject = $request->subject;
        $followUp->description = $request->description;
        $followUp->follow_up_date = $request->follow_up_date;
        $followUp->status = $request->status;
        $followUp->save();

        return back();
    }
}
