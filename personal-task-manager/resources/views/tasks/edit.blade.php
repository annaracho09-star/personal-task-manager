<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .buttons {
            margin-top: 20px;
        }

        button,
        a {
            padding: 10px 15px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        button {
            background: #333;
            color: white;
        }

        .back {
            color: #333;
            margin-left: 10px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Task</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="task_name">Task Name</label>
        <input
            type="text"
            id="task_name"
            name="task_name"
            value="{{ old('task_name', $task->task_name) }}"
            required
        >

        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
            required
        >{{ old('description', $task->description) }}</textarea>

        <label for="status">Status</label>
        <select id="status" name="status" required>

            <option value="Pending"
                {{ $task->status === 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="Completed"
                {{ $task->status === 'Completed' ? 'selected' : '' }}>
                Completed
            </option>

        </select>

        <label for="due_date">Due Date</label>
        <input
            type="date"
            id="due_date"
            name="due_date"
            value="{{ old('due_date', $task->due_date) }}"
            required
        >

        <div class="buttons">

            <button type="submit">
                Update Task
            </button>

            <a href="{{ route('tasks.index') }}" class="back">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>