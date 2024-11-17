@extends('layouts.BeeOrder_header')

@section('title', 'Comments')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include jQuery if not already included -->
    <!-- Include Bootstrap if not already included for button styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">


        <h1>Comment View</h1>

        <!-- Add Comment Form -->
        <form id="addCommentForm">
            @csrf
            <input type="hidden" name="commentable_type" id="commentable_type" value="{{ $type }}"> <!-- Replace with the actual type -->
            <input type="hidden" name="commentable_id" id="commentable_id" value="{{ $id }}"> <!-- Corrected Blade syntax -->
            <input type="hidden" name="user_id" id="user_id" value="{{ $userId }}"> <!-- Corrected Blade syntax -->

            <div>
                <label for="comment">Add Comment:</label>
                <input type="text" name="comment" id="comment" class="form-control" required>
            </div>

        </form>

        <!-- Comment Table -->
        <table id="tasksTable" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Comment</th>
                    <th>update</th>
                    <th>delete</th>

                </tr>
            </thead>
            <tbody>
                @forelse($Comments as $comment)
                    <tr id="comment-{{ $comment->id }}">
                        <td>{{ $comment->id }}</td>
                        <td>
                            <input type="text" value="{{ $comment->comment }}" class="form-control" data-id="{{ $comment->id }}">
                        </td>
                        <td>
                            <button class="update-comment-btn " data-id="{{ $comment->id }}">Update</button>
                        </td>
                        <td>
                            <button class="delete-comment-btn " data-id="{{ $comment->id }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No comments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- AJAX Script to handle adding, updating, and deleting comments -->
    <script>
        $(document).ready(function() {
            // Handle form submission to add a new comment
            $('#addCommentForm').submit(function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                // Collect form data
                let formData = {
                    commentable_type: $('#commentable_type').val(),
                    commentable_id: $('#commentable_id').val(),
                    comment: $('#comment').val(),
                    user_id: $('#user_id').val(),
                    _token: '{{ csrf_token() }}'
                };



                // AJAX request to add comment
                $.ajax({
                    url: '{{ route('comments.store') }}', // Route to store comment
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Append new comment to the table
                        $('#tasksTable tbody').append(`
                            <tr id="comment-${response.id}">
                                <td>${response.id}</td>
                                <td>
                                    <input type="text" value="${response.comment}" class="form-control" data-id="${response.id}">
                                </td>
                                <td>
                                    <button class="update-comment-btn " data-id="${response.id}">Update</button>
                                    </td>
                                    <td>
                                    <button class="delete-comment-btn " data-id="${response.id}">Delete</button>
                                </td>
                            </tr>
                        `);
                        // Clear the form
                        $('#comment').val('');
                        $('#tasksTable tr:contains("No comments found.")').remove();

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any errors for debugging
                        alert('An error occurred while adding the comment.');

                    }
                });
            });

            // Handle updating a comment
            $(document).on('click', '.update-comment-btn', function() {
                let commentId = $(this).data('id');
                let newComment = $(`#comment-${commentId} .form-control`).val();

                $.ajax({
                    url: `{{ url('comments') }}/${commentId}`, // Route to update comment
                    type: 'PUT',
                    data: {
                        comment: newComment,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update the comment text in the table
                        $(`#comment-${response.id} .form-control`).val(response.comment);
                        alert('updated successfully.');

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any errors for debugging
                        alert('An error occurred while updating the comment.');
                    }
                });
            });

            // Handle deleting a comment
            $(document).on('click', '.delete-comment-btn', function() {
                let commentId = $(this).data('id');

                $.ajax({
                    url: `{{ url('comments') }}/${commentId}`, // Route to delete comment
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Remove the comment row from the table
                        $(`#comment-${commentId}`).remove();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any errors for debugging
                        alert('An error occurred while deleting the comment.');
                    }
                });
            });
        });
    </script>
@endsection

</body>
</html>
