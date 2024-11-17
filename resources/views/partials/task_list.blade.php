@foreach($categories as $category)
    <div class="category-card">
        <div class="category-header">
            <div class="color-box" style="background-color: {{ $category->color }};"></div>
            <div class="category-name">{{ $category->name }}</div>
        </div>

        <div class="task-list">
            @role('leader')
                @if($category->task->count())
                    @foreach($category->task as $catTask)
                        <div class="task-item">
                            {{ $catTask->task_description }}
                        </div>
                    @endforeach
                @else
                    <p>No tasks found for this category.</p>
                @endif
            @else
                @if($category->task->count())
                    @foreach($category->task as $catTask)
                        @foreach($catTask->user as $user)
                            @if($user->id == $userId)
                                <div class="task-item">
                                    {{ $catTask->task_description }}
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <p>No tasks found for this category.</p>
                @endif
            @endrole
        </div>
    </div>
@endforeach

