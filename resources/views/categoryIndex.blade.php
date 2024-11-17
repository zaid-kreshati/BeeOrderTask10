@extends('layouts.BeeOrder_header')

@section('title', 'Categories')

@section('content')

    <body>
        @csrf

        <!-- Create New Category Button and Form -->
        @role('leader')
            <button id="toggleCreateFormBtn" class="btn btn-primary mb-3">Create New Category</button>

            <div id="createCategoryForm" style="display: none;">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form id="CategoryCreate" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="category">
                        <label for="name">Category Name:</label>
                        <input type="text" id="name" name="name" class="category_name" value="{{ old('name') }}">
                    </div>

                    <div class="category">
                        <label for="color">Category Color:</label>
                        <input type="color" id="color" name="color" class="color-box" value="{{ old('color') }}">
                    </div>

                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    @error('color')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <button class="edit-button">Create</button>
                </form>
            </div>
        @endrole

        <!-- Search Input Field -->
        <div class="search-container">
            <input type="text" id="searchBox" placeholder="Search categories" autocomplete="off">
            <img src="{{ asset('BeeOrder/img/searchIcon.png') }}" alt="Search Icon">
        </div>

        <!-- Horizontal Schedule Container -->
        <div>
            <h1>Categories View</h1>

            @include('partials.categoryIndex', ['categories' => $categories])
        </div>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            <div id="pagination-links">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- AJAX and jQuery Script for Creating, Updating, Deleting, and Searching Categories -->
        <script>
            $(function() {
                // Ensure CSRF token is sent with every AJAX request
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Toggle Create Category Form
                $('#toggleCreateFormBtn').click(function() {
                    $('#createCategoryForm').toggle(); // Toggle form visibility
                });

                // Handle Category Creation via AJAX
                $('#CategoryCreate').submit(function(e) {
                    e.preventDefault(); // Prevent form submission

                    let categoryName = $('#name').val();
                    let categoryColor = $('#color').val();

                    $.ajax({
                        url: '{{ route('categories.store') }}',
                        type: 'POST',
                        data: {
                            name: categoryName,
                            color: categoryColor,
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message); // Success message

                                // Fetch the last page where the new category will be displayed
                                fetchCategories(response.lastPage);

                                // Clear input fields
                                $('#name').val('');
                                $('#color').val('#000000');

                                // Hide the form
                                $('#createCategoryForm').hide();
                            } else {
                                alert('Failed to create the category.');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                if (errors.name) {
                                    alert('Name Error: ' + errors.name.join(', '));
                                }
                                if (errors.color) {
                                    alert('Color Error: ' + errors.color.join(', '));
                                }
                            } else {
                                alert('An error occurred. Please try again.');
                            }
                        }
                    });
                });



                // Handle Category Update via AJAX
                function updateCategory(categoryId, categoryName, categoryColor) {
                    $.ajax({
                        url: '{{ route('categories.update', ':id') }}'.replace(':id', categoryId),
                        type: 'PUT',
                        data: {
                            name: categoryName,
                            color: categoryColor,
                            _token: '{{ csrf_token() }}' // CSRF token
                        },
                        success: function(response) {
                            alert(response.success ? response.message : 'Permission denied.');
                        },
                        error: function(xhr) {
                            alert('An error occurred. Please try again.');
                        }
                    });
                }

                // Handle Category Deletion via AJAX
                function deleteCategory(categoryId) {
                    if (confirm('Are you sure you want to delete this category?')) {

                        $.ajax({
                            url: '{{ route('categories.destroy', ':id') }}'.replace(':id', categoryId),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}' // CSRF token
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Deleted successfully.');
                                    $(`#category-${categoryId}`).remove(); // Remove category row
                                } else {
                                    alert('Permission denied.');
                                }
                            },
                            error: function() {
                                alert('An error occurred. Please try again.');
                            }
                        });
                    }
                }

                // Update Category Button Click
                $(document).on('click', '.update-category-button', function(e) {
                    e.preventDefault();
                    let categoryId = $(this).data('id');
                    let categoryRow = $(this).closest('tr');
                    let categoryName = categoryRow.find('input[name="name"]').val();
                    let categoryColor = categoryRow.find('input[name="color"]').val();
                    updateCategory(categoryId, categoryName, categoryColor);
                });

                // Delete Category Button Click
                $(document).on('click', '.delete-category-button', function(e) {
                    e.preventDefault();
                    let categoryId = $(this).data('id');
                    deleteCategory(categoryId);
                });

            });
            // Handle Pagination Links Click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                fetchCategories(page);
            });

            function fetchCategories(page) {
                $.ajax({
                    url: '{{ route('categories.index') }}?page=' + page,
                    type: 'GET',
                    success: function(response) {

                        $('#categoriesTable ').html(response.categories); // Update table body with new categories
                        $('#pagination-links').html(response.pagination); // Update pagination links
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        </script>
    </body>
@endsection
