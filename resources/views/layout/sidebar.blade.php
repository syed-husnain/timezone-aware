<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Timezone<span></span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item {{ active_class(['tasks/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#tasks" role="button"
                    aria-expanded="{{ is_active_route(['tasks/*']) }}" aria-controls="tasks">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Tasks</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['tasks*']) }}" id="tasks">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('tasks.create') }}"
                                class="nav-link {{ active_class(['tasks/create']) }}">Add</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tasks.index') }}" class="nav-link {{ active_class(['tasks']) }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
