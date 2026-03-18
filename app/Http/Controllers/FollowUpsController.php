<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FollowUps;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'subject' => 'required|max:255',
            'follow_up_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $client->followUps()->create([
            'type_follow_up_id' => $request->type,
            'subject' => $request->subject,
            'description' => $request->description,
            'follow_up_date' => $request->follow_up_date,
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Seguimiento creado correctamente'
        ]);
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
            'type' => 'required',
            'subject' => 'required|max:255',
            'follow_up_date' => 'required|date'
        ]);

        $followUp = $client->followUps()->findOrFail($followUpId);
        $followUp->type_follow_up_id = $request->type;
        $followUp->subject = $request->subject;
        $followUp->description = $request->description;
        $followUp->follow_up_date = $request->follow_up_date;
        $followUp->status = $request->status;
        $followUp->save();

        return back();
    }
}
