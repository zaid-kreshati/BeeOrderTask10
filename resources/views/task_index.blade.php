@extends('layouts.BeeOrder_header')

@section('title', 'Tasks')

@section('content')

    <body>
        @csrf

        @role('leader')
            <button id="toggleFormButton" class="btn btn-primary mb-3">Create New Task</button>

            <form id="taskForm" action="{{ route('tasks.store') }}" method="POST" style="display: none;">
                @csrf
                <div class="task-list2">
                    <div class="schedule-item">
                        <label for="task_description">Task Description :</label>
                        <input type="text" class="form-control" id="task_description" name="task_description" required>
                    </div>

                    <div class="schedule-item">
                        <label for="dead_line">Deadline :</label>
                        <input type="datetime-local" class="form-control" id="dead_line" name="dead_line" required>
                    </div>

                    <label class="schedule-item" for="assignUsersDropdown">Assign Users:</label>
                    <select id="assignUsersDropdown" name="assign_users[]" multiple required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <label class="schedule-item" for="assignCategoriesDropdown">Assign Categories:</label>
                    <select id="assignCategoriesDropdown" class="form-control" name="assign_categories[]" multiple>
                        @foreach ($Categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="edit-button">Create Task</button>
            </form>
        @endrole

        <div class="container">
            <div class="search-container">
                <input type="text" id="searchBox" placeholder="Search tasks" autocomplete="on">
                <img src="{{ asset('BeeOrder/img/searchIcon.png') }}" alt="Search Icon">
            </div>

            <h1>Tasks View</h1>
            @include('partials.task_index', compact('tasks', 'users', 'Categories'))

            <!-- Paginate Links -->

            <div class="d-flex justify-content-center">
                <div id="pagination-links">
                    {{ $tasks->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>

        <script>
            $(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Initialize Select2 for dropdowns
                $('#assignUsersDropdown').select2();
                $('#assignCategoriesDropdown').select2();

                // Maintain a global array for tasks
                let tasks = @json($tasks);

                // Toggle form visibility
                $('#toggleFormButton').click(function() {
                    $('#taskForm').toggle();
                });

                $('#taskForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                // Load the last page of tasks after adding the new task
                const lastPage = response.lastPage;

                // Fetch tasks and load the last page
                fetchTasks(lastPage, function() {
                    // Clear the form fields
                    $('#task_description').val('');
                    $('#dead_line').val('');

                    // Clear the selections in the dropdowns
                    $('#assignUsersDropdown').val([]).trigger('change');
                    $('#assignCategoriesDropdown').val([]).trigger('change');

                    // Hide the form
                    $('#taskForm').hide();
                    alert(response.message);
                });
            } else {
                alert('Failed to create the task.');
            }
        },
        error: function(xhr) {
            alert('An error occurred. Please try again.');
        }
    });
});



                // Fetch tasks and load the specified page
                function fetchTasks(page, callback) {
    $.ajax({
        url: '{{ route('tasks.index') }}?page=' + page,
        type: 'GET',
        success: function(response) {
            // Update the table and pagination
            $('#tasksTable').html(response.tasks); // Update task list
            $('#pagination-links').html(response.pagination); // Update pagination

            // Execute the callback after the page is updated (if provided)
            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function(xhr) {
            alert('An error occurred. Please try again.');
        }
    });
}


                // Handle task deletion
                $(document).on('click', '.delete-task-button', function(e) {
                    e.preventDefault();
                    let taskId = $(this).data('id');

                    if (confirm('Are you sure you want to delete this task?')) {
                        $.ajax({
                            url: '{{ route('tasks.destroy', ':id') }}'.replace(':id', taskId),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(`#task-${taskId}`).remove();
                                    alert(response.message);
                                } else {
                                    alert('Failed to delete the task.');
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 403) {
                                    alert('You do not have permission to delete this task.');
                                } else {
                                    alert('An error occurred. Please try again.');
                                }
                            }
                        });
                    }
                });


            });
        </script>
    @endsection

</body>

</html>
