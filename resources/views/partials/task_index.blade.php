<table id="tasksTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>View Details</th>
            @role('leader')
                <th>Delete</th>
            @endrole
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $task)
            <tr id="task-{{ $task->id }}">
                <td>{{ $task->id }}</td>
                <td>{{ $task->task_description }}</td>
                <td>{{ $task->status }}</td>
                <td class="action-buttons">
                    <a href="{{ route('tasks.details', $task->id) }}" class="btn btn-info">View Details</a>
                </td>
                @role('leader')
                    <td>
                        <button class="delete-task-button btn btn-danger" data-id="{{ $task->id }}">Delete</button>
                    </td>
                @endrole
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<script>
    $(function() {
        // Handle AJAX Search functionality inside the partial view
        const searchBox = $('#searchBox');
        const tasksTableBody = $('#tasksTable tbody');

        searchBox.on('input', function() {
            const query = this.value.toLowerCase().trim();
            const currentPage = "{{ request('page') ?? 1 }}";

            if (query === '') {
                // If search box is empty, load the tasks for the current page
                fetchTasks(currentPage);
            } else {
                $.ajax({
                    url: '/tasks/search', // Adjust the route as necessary
                    type: 'GET',
                    data: { search: query },
                    success: function(response) {
                        tasksTableBody.empty();

                        if (response.length > 0) {
                            response.forEach(task => {
                                const row = `
                                    <tr id="task-${task.id}">
                                        <td>${task.id}</td>
                                        <td>${task.task_description}</td>
                                        <td>${task.status}</td>
                                        <td class="action-buttons">
                                             <a href="{{ route('tasks.details', $task->id) }}" class="btn btn-info">View Details</a>
                                        </td>
                                        @role('leader')
                                            <td>
                                                <button class="delete-task-button btn btn-danger" data-id="${task.id}">Delete</button>
                                            </td>
                                        @endrole
                                    </tr>`;
                                tasksTableBody.append(row);
                            });
                        } else {
                            tasksTableBody.html('<tr><td colspan="5" class="text-center">No tasks found.</td></tr>');
                        }
                    },
                    error: function() {
                        alert('An error occurred while searching for tasks.');
                    }
                });
            }
        });

        // Function to fetch tasks for a specific page
        function fetchTasks(page) {
            $.ajax({
                url: '{{ route('tasks.index') }}?page=' + page,
                type: 'GET',
                success: function(response) {
                    $('#tasksTable').html(response.tasks);
                    $('#pagination-links').html(response.pagination);
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    });
</script>
