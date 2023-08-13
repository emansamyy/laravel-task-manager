<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedProjectId = $request->query('project');
        if ($selectedProjectId) {
            $tasksQuery = Task::query();
            $tasksQuery->where('project_id', $selectedProjectId);
            $tasks = $tasksQuery->get()->sortBy('priority'); 
        }
        else{
        $tasks = Task::get()->sortBy('priority');}
        $projects = Project::get();
        
        return view('index', compact('tasks'), compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects=Project::all();
        return view('create' , compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->project_id = $request->project_id;
        $task->save();
        return redirect()->route('index')->with('success', 'Task created successfully.');    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects=Project::all();
        return view('edit', ['task' => Task::findOrFail($id)] , compact('projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task= Task::findOrFail($id);
        $request->validate([
            'title' => 'required',
        ]);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->project_id = $request->project_id;
        $task->save();
        return redirect()->route('index')->with('success', 'Task edited successfully.');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task= Task::findOrFail($id);
        $task->delete();
        return redirect()->route('index')->with('success', 'Task deleted successfully.');
    }
    public function reorder(Request $request)
{
    $tasks = $request->input('tasks');

    foreach ($tasks as $task) {
        Task::where('id', $task['id'])->update(['priority' => $task['priority']]);
    }

    return response()->json(['message' => 'Task order updated successfully']);
}
}