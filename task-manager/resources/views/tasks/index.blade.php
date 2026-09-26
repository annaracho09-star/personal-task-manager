<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .add-button {
            display: inline-block;
            padding: 10px 15px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .task {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .task h3 {
            margin-top: 0;
        }

        .pending {
            color: #b8860b;
        }

        .completed {
            color: green;
        }

        button,
        .edit {
            padding: 7px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit {
            background: #ddd;
            color: black;
        }

        .status-button {
            background: #ddd;
        }

        .delete {
            background: #d9534f;
            color: white;
        }

        .success {
            background: #dff0d8;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Personal Task Manager</h1>

    <a href="/tasks/create" class="add-button">Add New Task</a>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($tasks as $task)

        <div class="task">

            <h3>{{ $task->task_name }}</h3>

            <p>{{ $task->description }}</p>

            <p>
                <strong>Status:</strong>

                <span class="{{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                    {{ $task->status }}
                </span>
            </p>

            <p>
                <strong>Due Date:</strong>
                {{ $task->due_date ?? 'No due date' }}
            </p>

            <a href="/tasks/{{ $task->id }}/edit" class="edit">
                Edit
            </a>

            <form action="/tasks/{{ $task->id }}/status"
                  method="POST"
                  style="display: inline;">
                @csrf
                @method('PATCH')

                <button type="submit" class="status-button">
                    Mark as {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}
                </button>
            </form>

            <form action="/tasks/{{ $task->id }}"
                  method="POST"
                  style="display: inline;"
                  onsubmit="return confirm('Are you sure you want to delete this task?');">

                @csrf
                @method('DELETE')

                <button type="submit" class="delete">
                    Delete
                </button>
            </form>

        </div>

    @empty

        <p>No tasks yet. Add your first task!</p>

    @endforelse

</div>

</body>
</html>