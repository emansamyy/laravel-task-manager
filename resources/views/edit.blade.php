@extends('layout')

@section('content')
<div>
    <div class="float-start">
        <h4 class="pb-3">Edit Task 
            - <span class="badge bg-warning">{{ $task->title }}</span>
        </h4>
    </div>
    <div class="float-end">
        <a href="{{ route('index') }}" class="btn btn-outline-primary">
            All Tasks
        </a>
    </div>
    <div class="clearfix"></div>
</div>

<div class="card text-white bg-dark mb-3">
    <form action="{{ route('task.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control col-12 col-md-6 mx-auto" id="title" placeholder="Enter title" name="title" value="{{ $task->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control col-12 col-md-6 mx-auto" id="description" placeholder="Description" name="description" value="{{ $task->description }}">
        </div>
        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="number" class="form-control col-12 col-md-6 mx-auto" id="priority" placeholder="Priority from 1 to 5" min="1" max="5" name="priority" value="{{ $task->priority }}">
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control col-12 col-md-6 mx-auto" id="due_date" placeholder="Due Date" name="due_date" value="{{ $task->due_date }}">
        </div>
        <div>
        <label for="project_id">Select Project:</label>
            <select class="form-control col-12 col-md-6 mx-auto" id="project_id" name="project_id" value="{{ $task->project_id }}">
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

@endsection
