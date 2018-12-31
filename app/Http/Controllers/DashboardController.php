<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::all()->where('chat_id', $user->chat_id);

        return view('dashboard', [
            'user' => $user,
            'tasks' => $tasks,
        ]);
    }

    public function finish($taskId)
    {
        $task = Task::where('chat_id', auth()->user()->chat_id)
            ->where('id', $taskId)
            ->first();

        if(is_null($task)) {
            abort(403, 'Unauthorized action.');
        } else {
            $task->completed = true;
            $task->save();
        }
        
        return redirect('/dashboard');
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('edit', [
            'user' => $user,
        ]);
    }

    public function saveProfile(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->chat_id = $request->chat_id;
        $user->save();

        return redirect('/dashboard');
    }
}
