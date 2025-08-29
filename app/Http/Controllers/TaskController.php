<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Mail\TaskMail;
use App\Models\Client;
use App\Models\User;
use App\Notifications\Tasks;
use App\Providers\MailConfigServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SweetAlert2\Laravel\Swal;

class TaskController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:tareas', only: ['index']),
            new Middleware('permission:tareas-crear', only: ['create', 'store']),
            new Middleware('permission:tareas-editar', only: ['edit', 'update']),
            new Middleware('permission:tareas-eliminar', only: ['destroy']),
            new Middleware('permission:calendario', only: ['calendar', 'events']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('active', 1)->orderBy('name', 'asc')->get();
        return view('tasks.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en_proceso,completado',
            'due_date' => 'required|date',
            'client_id' => 'nullable|exists:clients,id',
        ]);

        /*Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'client_id' => $request->client_id,
            'user_id' => Auth::id()
        ]);*/

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->due_date = $request->input('due_date');
        $task->client_id = $request->input('client_id');
        $task->user_id = Auth::id();
        $task->save();

        // Envio de correo electronico al usuario asignado
        MailConfigServiceProvider::class;
        //Mail::to($task->user->email)->send(new TaskMail($task));

        // Notificacion al administrador
        $admin = User::find(1);
        //$admin->notify(new Tasks($task));

        Swal::success([
            'title' => 'Tarea guardada',
            'text' => 'La tarea se guardo correctamente.',
            'icon' => 'success'
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        $task->load('client');
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $clients = Client::where('active', 1)->orderBy('name', 'asc')->get();
        return view('tasks.edit', compact('task', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en_proceso,completado',
            'due_date' => 'required|date',
            'client_id' => 'nullable|exists:clients,id',
        ]);

        $task->update($request->all());

        Swal::success([
            'title' => 'Tarea modifica',
            'text' => 'La tarea se modifico correctamente.',
            'icon' => 'success'
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        Swal::success([
            'title' => 'Tarea eliminada',
            'text' => 'La tarea se eliminó correctamente.',
            'icon' => 'success'
        ]);

        return redirect()->route('tasks.index');
    }

    // Muestra la vista con el calendario
    public function calendar()
    {
        return view('tasks.calendar');
    }

    public function events()
    {
        $tasks = Task::select(['id', 'title', 'due_date as start'])->get();
        return response()->json($tasks);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['status' => 'ok', 'count' => auth()->user()->unreadNotifications->count()], 200);
        }
        return response()->json(['status' => 'not_found'], 404);
    }
}
