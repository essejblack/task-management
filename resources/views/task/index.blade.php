<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table {
            border-collapse: collapse;
        }

        table tr td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .dropzone {
            border: 2px dashed #ccc;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Task Manager</h1>

    <table id="task-table" class="table mt-4">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr data-task-id="{{ $task->id }}">
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-task-btn" data-task-id="{{ $task->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#task-table tbody').sortable({
            axis: 'y',
            handle: 'td',
            update: function (event, ui) {
                var tasks = [];

                $('#task-table tbody tr').each(function () {
                    tasks.push($(this).data('task-id'));
                });

                // Send AJAX request to update the task order
                $.ajax({
                    url: '/tasks/update-order',
                    type: 'POST',
                    data: {
                        tasks: tasks
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            }
        });

        // Delete task
        $('.delete-task-btn').click(function () {
            var taskId = $(this).data('task-id');

            // Send AJAX request to delete the task
            $.ajax({
                url: '/tasks/' + taskId,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);

                    // Remove task row from the table
                    $(`[data-task-id="${taskId}"]`).remove();
                }
            });
        });
    });
</script>
</body>
</html>