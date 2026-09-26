<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button,
        a {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        button {
            background: #333;
            color: white;
            cursor: pointer;
        }

        a {
            background: #ddd;
            color: black;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Task</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/tasks/{{ $task->id }}" method="POST">

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
            rows="5"
        >{{ old('description', $task->description) }}</textarea>

        <label for="status">Status</label>

        <select id="status" name="status" required>

            <option value="Pending"
                {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="Completed"
                {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>
                Completed
            </option>

        </select>

        <label for="due_date">Due Date</label>

        <input
            type="date"
            id="due_date"
            name="due_date"
            value="{{ old('due_date', $task->due_date) }}"
        >

        <button type="submit">Update Task</button>

        <a href="/tasks">Cancel</a>

    </form>

</div>

</body>
</html>