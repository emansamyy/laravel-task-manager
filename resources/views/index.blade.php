@extends('layout')

@section('content')
<div>
    <div class="float-start">
        <h4 class="pb-3">Tasks</h4>
    </div>
    <div class="float-end">
        <a href="{{ route('task.create') }}" class="btn btn-outline-primary">
            Add New Task
        </a>
    </div>
    <div class="clearfix"></div>
</div>

<div class="mb-3">
    <label for="projectSelect" class="form-label">Select Project:</label>
    <select class="form-select" id="projectSelect">
        <option value="">All Projects</option>
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
</div>

@if (count($tasks) === 0)
<div class="alert alert-danger">
    <p>There are no tasks.</p>
</div>
@else
<ul id="task-list" class="list-group">
    @foreach($tasks as $task)
    <li class="list-group-item" data-task-id="{{ $task->id }}">
        <div class="card text-white bg-dark mb-3">
            <div class="card-header">
                
            </div>
            <div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <h5 class="card-title">{{ $task->title }}</h5>
        </div>
        <div class="col-md-4 text-end">
            <span style = "background-color:black;"class="badge badge-warning">PRIORITY: {{ $task->priority }}</span>
        </div>
    </div>
    <p class="card-text">{{ $task->description }}</p>
    <div class="row">
        <div class="col-md-8">
            <span class="badge badge-pill badge-dark">DUE DATE: {{ $task->due_date }}</span>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-outline-success">
                Edit
            </a>
            <form style="display:inline;"action="{{ route('task.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" >
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

        </div>
    </li>
    @endforeach
</ul>
@endif
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    $(document).ready(function() {
        const taskList = document.getElementById('task-list');
    new Sortable(taskList, {
        handle: '.list-group-item',
        onUpdate: function (event) {
            const tasks = Array.from(taskList.children);

const totalTasks = tasks.length;
const maxPriority = 5;
const scalingFactor = maxPriority / totalTasks;

const normalizedTasks = tasks.map((task, index) => ({
    id: task.dataset.taskId,
    priority: Math.round(index * scalingFactor) + 1
}));

            $.ajax({
                url: '/tasks/reorder',
                method: 'POST',
                data: {
                    tasks: normalizedTasks
                },
                success: function () {
                    console.log('success');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle the error, if needed
                    console.error(error);
                }
            });

        }});

        $(document).on('change', '#projectSelect', function() {  
                 const selectedProjectId = $(this).val();
            const url = selectedProjectId ? `/?project=${selectedProjectId}` : '/';
            window.location.href = url;
        });
 
});
</script>