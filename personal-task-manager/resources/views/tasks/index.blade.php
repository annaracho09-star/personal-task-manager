<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            text-align: center;
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

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #333;
            color: white;
        }

        .pending {
            color: #856404;
        }

        .completed {
            color: #155724;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        button {
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Personal Task Manager</h1>

    <a href="{{ route('tasks.create') }}" class="add-button">
        + Add Task
    </a>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->count() > 0)

        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($tasks as $task)

                    <tr>
                        <td>{{ $task->task_name }}</td>

                        <td>{{ $task->description }}</td>

                        <td>
                            @if($task->status === 'Completed')
                                <span class="completed">
                                    {{ $task->status }}
                                </span>
                            @else
                                <span class="pending">
                                    {{ $task->status }}
                                </span>
                            @endif
                        </td>

                        <td>{{ $task->due_date }}</td>

                        <td>
                            <div class="actions">

                                <a href="{{ route('tasks.edit', $task) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>

    @else

        <p>No tasks found. Add your first task!</p>

    @endif

</div>

</body>
</html>