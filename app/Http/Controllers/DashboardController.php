<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FollowUps;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasksInProgress = Task::where('user_id', $user->id)->where('status', 'en progreso')->get();
        $tasksCompleted = Task::where('user_id', $user->id)->where('status', 'completada')->get();
        $tasksPendings = Task::where('user_id', $user->id)->where('status', 'pendiente')->get();
        $clients = Client::all();
        $follows = FollowUps::whereDate('follow_up_date', today())->get();
        return view('dashboard', compact('tasksPendings', 'tasksInProgress', 'tasksCompleted', 'clients', 'follows'));
    }
}
