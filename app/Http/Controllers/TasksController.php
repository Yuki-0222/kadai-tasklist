<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
 
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // => なぜ、"\"が付くんだっけ？
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10); // => "desc"は降順、"asc"が昇順
            
            $data = [
                'user' => $user,
                'tasks' => $tasks, // view 'welcom' の$tasksに対して、$taskを代入している認識でOK？
            ];
        }
        
        return view('welcome', $data);
    }

    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:15',
            'content' => 'required|max:191',
        ]);
        
        $request->user()->tasks()->create([
                'content' => $request->content,
                'status' => $request->status
            ]);

        return redirect('/');
    }

    public function show($id)
    {
        $task = Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
            ]);

        }
        
        else {
            return redirect('/');
        }       
    }

    public function edit($id)
    {
        $task = Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        
        else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:15',
            'content' => 'required|max:191',
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        
        return redirect('/');
    }
}
