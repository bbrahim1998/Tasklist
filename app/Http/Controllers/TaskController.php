<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{


    public function index(): View
    {
        $tasks = Task::latest('id')->paginate(6);


        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return View('tasks.create',[
            'task' =>new Task(),
            'updating' =>false,
            'actionUrl' =>route('tasks.store'),
            'submitButtonText' => 'Crear Tarea'
        ]);
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());
        return redirect() ->route('tasks.index');
    }

    public function edit(Task $task): View
    {
        return view ('tasks.edit', [
            'task'=>$task,
            'updating' => true,
            'actionUrl' => route('tasks.update', $task),
            'submitButtonText' => 'Actualizar tarea',
        ]);

    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        return redirect() ->route('tasks.index');
    }

    public function toggle(Task $task): RedirectResponse
    {
        $task->update([
            'completed' => !$task->completed,
        ]);
        return redirect() -> route("tasks.index");
    }
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect() ->route('tasks.index');
    }
}
