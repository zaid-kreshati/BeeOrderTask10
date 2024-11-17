<!-- Categories Table -->
<table id="categoriesTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            @role('leader')
                <th>Update</th>
                <th>Delete</th>
            @endrole
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
            <tr id="category-{{ $category->id }}">
                <td>{{ $category->id }}</td>
                <td>
                    @role('leader')
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
                    @else
                        {{ $category->name }}
                    @endrole
                </td>
                <td>
                    @role('leader')
                        <input type="color" name="color" value="{{ $category->color }}" class="color-box" required>
                    @else
                        <div class="color-square" style="background-color: {{ $category->color }};"></div>
                    @endrole
                </td>
                @role('leader')
                    <td>
                        <button class="update-category-button edit-button" data-id="{{ $category->id }}">Update</button>
                    </td>
                    <td>
                        <button class="delete-category-button edit-button" data-id="{{ $category->id }}">Delete</button>
                    </td>
                @endrole
            </tr>
        @empty
            <tr>
                <td colspan="5">No categories found.</td>
            </tr>
        @endforelse
    </tbody>

    <script>
       $(function() {
    // Ensure CSRF token is sent with every AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize search functionality and attach it after every update
    function initializeSearch() {
        const searchBox = document.getElementById('searchBox');
        const categoriesTableBody = document.querySelector('#categoriesTable tbody');

        searchBox.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            categoriesTableBody.innerHTML = '';

            $.ajax({
                url: '/categories/search',
                type: 'GET',
                data: { search: query },
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(category => {
                            let row;
                            if ('{{ auth()->user()->hasRole("leader") }}') {
                                row = `
                                    <tr id="category-${category.id}">
                                        <td>${category.id}</td>
                                        <td><input type="text" name="name" value="${category.name}" class="form-control" required></td>
                                        <td><input type="color" name="color" value="${category.color}" class="color-box" required></td>
                                        <td><button class="update-category-button edit-button" data-id="${category.id}">Update</button></td>
                                        <td><button class="delete-category-button edit-button" data-id="${category.id}">Delete</button></td>
                                    </tr>
                                `;
                            } else {
                                row = `
                                    <tr id="category-${category.id}">
                                        <td>${category.id}</td>
                                        <td>${category.name}</td>
                                        <td><div class="color-square" style="background-color: ${category.color};"></div></td>
                                    </tr>
                                `;
                            }
                            categoriesTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    } else {
                        categoriesTableBody.innerHTML = '<tr><td colspan="5">No categories found.</td></tr>';
                    }
                }
            });
        });
    }

    // Call search initialization once at the start
    initializeSearch();


});





    </script>
