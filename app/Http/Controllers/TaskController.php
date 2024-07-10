<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\User;
use App\Models\Etiqueta;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        
        $tasks = Task::all();
        $user = User::all();
        return view('tasks.index',[
            'tasks' => $tasks,
            'user'=> $user,
          
        ]);


    }

    public function create()
    {

        return view('tasks.create', [
            
            'priorities' => Priority::all(),
            'user' => User::all(),
            'etiqueta' => Etiqueta::all()
          
        ]);
    }

    public function show(Task $task)
    {

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store( Request $request)
    {

        // $task = new Task();

        // $task->name = request('name'); 
        // $task->description = request('description');

        // $task->save();
            $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'user_id' => 'required|exists:users,id',
            'etiqueta' => 'array',
            'etiqueta' => 'array|exists:etiqueta,id'

        ]);

            $task =Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'priority' => $request->priority,
                'completed' => false,
                'user_id' => $request->user_id,
            ]);
       
        $task->etiqueta()->attach($data['etiqueta']);

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        $etiqueta = Etiqueta::all();
        return view('tasks.edit', [
            'task' => $task,
            'etiqueta' => $etiqueta
        ]);
    }

    public function update(Task $task)
    {

        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'etiqueta' => 'array|exists:etiqueta,id'
        ]);

       $task->fill($data)->save();
       //$task->update($data);
      $task->etiqueta()->sync($data['etiqueta']);
        return redirect('/tasks/' . $task->id);
    }

    
}
