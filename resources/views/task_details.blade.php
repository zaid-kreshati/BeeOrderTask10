@extends('layouts.BeeOrder_header')

@section('title', 'Task Details')

@section('content')

@php
    use App\Enums\TaskStatus;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
</head>

<body>
    <div class="container">
        <h1>Task Details</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @hasrole('leader')
            @if ($task)
                @csrf
                @method('PUT')
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>End Flag</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="task-{{ $task->id }}">
                            <td>{{ $task->id }}</td>
                            <td>
                                <input type="text" name="task_description" id="task_description" class="form-control" value="{{ $task->task_description }}">
                            </td>

                            <td>
                                <input type="datetime-local" id="dead_line" name="dead_line" class="edit-input" value="{{ $task->dead_line }}">
                            </td>

                            <td>
                                {{$task->status}}
                                <!-- Task Status Dropdown -->
                                <select id="task_status" name="status">
                                    <!-- Show the current status as the default selected option -->
                                    <option value="{{ TaskStatus::TO_DO->value }}" {{ $task->status === TaskStatus::TO_DO->value ? 'selected' : '' }}>
                                        {{ TaskStatus::TO_DO->value }}
                                    </option>
                                    <option value="{{ TaskStatus::IN_PROGRESS->value }}" {{ $task->status === TaskStatus::IN_PROGRESS->value ? 'selected' : '' }}>
                                        {{ TaskStatus::IN_PROGRESS->value }}
                                    </option>
                                    <option value="{{ TaskStatus::DONE->value }}" {{ $task->status === TaskStatus::DONE->value ? 'selected' : '' }}>
                                        {{ TaskStatus::DONE->value }}
                                    </option>
                                </select>
                            </td>



                            <td>
                                <button type="submit" class="update-task-btn">Update</button>
                            </td>
                            <td>
                                @if ($task->end_flag)
                                    <img src="{{ asset('BeeOrder/img/true.png') }}" alt="True" class="icon">
                                @else
                                    <img src="{{ asset('BeeOrder/img/false.png') }}" alt="False" class="icon">
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('comments.index', ['type' => 'Task', 'id' => $task->id]) }}" class="btn btn-info">View Comments</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            @else
                <p>No task details available.</p>
            @endif
        @else
            @if ($task)
                @csrf
                @method('PUT')
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>End Flag</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="task-{{ $task->id }}">
                            <td>{{ $task->id }}</td>

                            <!-- Read-only Description Field -->
                            <td>
                                <input type="hidden" name="task_description" value="{{ $task->task_description }}">
                                <span>{{ $task->task_description }}</span>
                            </td>

                            <!-- Read-only Deadline Field -->
                            <td>
                                <input type="hidden" name="dead_line" value="{{ $task->dead_line }}">
                                <span>{{ $task->dead_line }}</span>
                            </td>

                            <!-- Task Status Dropdown for Non-Leaders -->
                            <td>
                                {{$task->status}}

                                <!-- Task Status Dropdown -->
                                <select id="task_status" name="status">
                                    <!-- Show the current status as the default selected option -->
                                    <option value="{{ TaskStatus::TO_DO->value }}" {{ $task->status === TaskStatus::TO_DO->value ? 'selected' : '' }}>
                                        {{ TaskStatus::TO_DO->value }}
                                    </option>
                                    <option value="{{ TaskStatus::IN_PROGRESS->value }}" {{ $task->status === TaskStatus::IN_PROGRESS->value ? 'selected' : '' }}>
                                        {{ TaskStatus::IN_PROGRESS->value }}
                                    </option>
                                    <option value="{{ TaskStatus::DONE->value }}" {{ $task->status === TaskStatus::DONE->value ? 'selected' : '' }}>
                                        {{ TaskStatus::DONE->value }}
                                    </option>
                                </select>
                            </td>


                            <td>
                                <button type="submit" class="update-task-btn">Update</button>
                            </td>

                            <td>
                                @if ($task->end_flag)
                                    <img src="{{ asset('BeeOrder/img/true.png') }}" alt="True" class="icon">
                                @else
                                    <img src="{{ asset('BeeOrder/img/false.png') }}" alt="False" class="icon">
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('comments.index', ['type' => 'Task', 'id' => $task->id]) }}" class="btn btn-info">View Comments</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>No task details available.</p>
            @endif
        @endrole

        <h1>Subtasks</h1>

        @hasrole('leader')
            <!-- Form to Add Subtask -->
            <div class="form-group">
                <h3>Add New Subtask</h3>
                <form id="addSubtaskForm">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="text" id="name" name="name" class="form-control" >
                </form>
            </div>

            <!-- Subtasks Table -->
            @if ($Subtasks)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                            <th>View Comments</th>
                        </tr>
                    </thead>
                    <tbody id="subtasksTableBody">
                        @forelse($Subtasks as $subtask)
                        <form class="update-subtask-form" data-id="{{ $subtask->id }}">

                            <tr id="subtask-{{ $subtask->id }}">
                                <td>{{ $subtask->id }}</td>
                                <td>
                                    <input type="text" class="form-control subtask-name" value="{{ $subtask->name }}" >
                                </td>

                                <td>
                                    {{$subtask->status}}

                                    <!-- SubTask Status Dropdown -->
                                    <select name="subtask_status" >

                                            <!-- Default option showing the current status -->

                                        <option value="{{ TaskStatus::TO_DO->value }}" {{ $subtask->status === TaskStatus::TO_DO->value ? 'selected' : '' }}>
                                            {{ TaskStatus::TO_DO->value }}
                                        </option>
                                        <option value="{{ TaskStatus::IN_PROGRESS->value }}" {{ $subtask->status === TaskStatus::IN_PROGRESS->value ? 'selected' : '' }}>
                                            {{ TaskStatus::IN_PROGRESS->value }}
                                        </option>
                                        <option value="{{ TaskStatus::DONE->value }}" {{ $subtask->status === TaskStatus::DONE->value ? 'selected' : '' }}>
                                            {{ TaskStatus::DONE->value }}
                                        </option>
                                    </select>
                                </td>

                                <td>

                                    <button class="update-subtask-btn btn btn-success" data-id="{{ $subtask->id }}">Update</button>
                                </td>
                                <td>
                                    <button class="delete-subtask-btn btn btn-danger" data-id="{{ $subtask->id }}">Delete</button>
                                </td>
                                <td class="action-buttons">
                                    <a href="{{ route('comments.index', ['type' => 'Subtask', 'id' => $subtask->id]) }}" class="btn btn-info">View Comments</a>
                                </td>
                            </tr>
                        </form>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No subtasks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p>No subtasks found.</p>
            @endif
        @else
            <!-- Subtasks Table for non-leaders -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>View Comments</th>
                    </tr>
                </thead>
                <tbody id="subtasksTableBody">
                    @forelse($Subtasks as $subtask)
                        <tr id="subtask-{{ $subtask->id }}">
                            <td>{{ $subtask->id }}</td>
                            <td>{{ $subtask->name }}</td>

                                <td>
                                    {{$subtask->status}}

                                    <!-- SubTask Status Dropdown -->
                                    <select name="subtask_status" >

                                            <!-- Default option showing the current status -->

                                        <option value="{{ TaskStatus::TO_DO->value }}" {{ $subtask->status === TaskStatus::TO_DO->value ? 'selected' : '' }}>
                                            {{ TaskStatus::TO_DO->value }}
                                        </option>
                                        <option value="{{ TaskStatus::IN_PROGRESS->value }}" {{ $subtask->status === TaskStatus::IN_PROGRESS->value ? 'selected' : '' }}>
                                            {{ TaskStatus::IN_PROGRESS->value }}
                                        </option>
                                        <option value="{{ TaskStatus::DONE->value }}" {{ $subtask->status === TaskStatus::DONE->value ? 'selected' : '' }}>
                                            {{ TaskStatus::DONE->value }}
                                        </option>
                                    </select>
                                </td>


                                <td>
                                <button class="update-subtask-btn btn btn-success" data-id="{{ $subtask->id }}">Update</button>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('comments.index', ['type' => 'Subtask', 'id' => $subtask->id]) }}" class="btn btn-info">View Comments</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No subtasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endrole
    </div>

     <!-- AJAX Script to handle adding, updating, and deleting subtasks -->
<script>
    $(document).ready(function() {
        // Handle form submission to add a subtask
        $('#addSubtaskForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            let formData = {
                task_id: $('input[name="task_id"]').val(),
                name: $('#name').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('subtasks.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#subtasksTableBody').append(`
                        <tr id="subtask-${response.subtask.id}">
                            <td>${response.subtask.id}</td>
                            <td>
                                <input type="text" class="form-control subtask-name" value="${response.subtask.name}" >
                            </td>
                            <td>
                                <select name="subtask_status" >
                                    <option value="" disabled selected>${response.subtask.status }</option>
                                    <option value="To Do" ${response.subtask.status == 'To Do' ? 'selected' : ''}>To Do</option>
                                    <option value="In Progress" ${response.subtask.status == 'In Progress' ? 'selected' : ''}>In Progress</option>
                                    <option value="Done" ${response.subtask.status == 'Done' ? 'selected' : ''}>Done</option>
                                </select>
                            </td>
                            <td>
                                <button class="update-subtask-btn btn btn-success" data-id="${response.subtask.id}">Update</button>
                            </td>
                            <td>
                                <button class="delete-subtask-btn btn btn-danger" data-id="${response.subtask.id}">Delete</button>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ url('comments/Subtask') }}/${response.subtask.id}" class="btn btn-info">View Comments</a>
                            </td>
                        </tr>
                    `);
                    $('#name').val(''); // Clear the input field
                    $('#subtasksTableBody tr:contains("No subtasks found")').remove();
                },
                error: function(response) {
                    alert('Error adding subtask.');
                }
            });
        });

        // Handle subtask update
        $(document).on('click', '.update-subtask-btn', function(e) {
            e.preventDefault();


            let subtaskId = $(this).data('id');
            let name = $(`#subtask-${subtaskId} .subtask-name`).val();
            let status = $(`#subtask-${subtaskId} select[name="subtask_status"]`).val();

            $.ajax({
                url: `{{ url('subtask/') }}/${subtaskId}`,
                type: 'PUT',
                data: {
                    name: name,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Subtask updated successfully.');
                },
                error: function(response) {
                    alert('Error updating subtask.');
                }
            });
        });

        // Handle subtask deletion
        $(document).on('click', '.delete-subtask-btn', function(e) {
            let subtaskId = $(this).data('id');

            if (confirm('Are you sure you want to delete this subtask?')) {
                $.ajax({
                    url: `{{ url('subtask/') }}/${subtaskId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $(`#subtask-${subtaskId}`).remove();
                        alert('Subtask deleted successfully.');
                    },
                    error: function(response) {
                        alert('Error deleting subtask.');
                    }
                });
            }
        });

        // Handle task update
        $(document).on('click', '.update-task-btn', function(e) {
            e.preventDefault();

            let taskId = $(this).closest('tr').attr('id').split('-')[1];
            let task_description = $(`#task-${taskId} input[name="task_description"]`).val();
            let dead_line = $(`#task-${taskId} input[name="dead_line"]`).val();
            let status = $(`#task-${taskId} select[name="status"]`).val();

            $.ajax({
                url: `/task/${taskId}`, // Assuming RESTful route, adjust if necessary
                type: 'PUT',
                data: {
                    task_description: task_description,
                    dead_line: dead_line,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Task updated successfully.');
                },
                error: function(response) {
                    alert('Error updating task.');
                }
            });
        });
    });
</script>


    </body>

@endsection
