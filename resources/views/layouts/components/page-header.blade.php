<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="header-title flex-fill d-flex align-items-center">
            <a href="#" id="sidebar-toggle"><i data-feather="arrow-left"></i></a>
            <h5 class="ms-2">{{ $title }}</h5>
        </div>

        <div class="flex-fill" id="headerNav">
            <ul class="navbar-nav d-flex align-items-center">
                <!-- Notification Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link notifications-dropdown d-flex align-items-center" href="#" id="notificationsDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger ms-1" id="notification-count"
                              style="{{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'display: none;' }}">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                        <div class="spinner-grow text-danger ms-2 d-none" role="status" id="notif-loading">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end notif-drop-menu" aria-labelledby="notificationsDropDown">
                        <h6 class="dropdown-header">Notifications</h6>

                        <div id="notification-list">
                            @forelse(auth()->user()->notifications as $notification)
                                <a href="#">
                                    <div class="header-notif d-flex">
                                        <div class="notif-image">
                                            <span class="notification-badge bg-info text-white">
                                                <i class="fas fa-bullhorn"></i>
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p class="bold-notif-text mb-1">{{ $notification->data['message'] }}</p>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="dropdown-item text-center">No new notifications</div>
                            @endforelse
                        </div>

                        <div class="dropdown-footer text-center">
                            <button class="btn btn-sm btn-secondary w-100" id="mark-all-read">Mark All as Read</button>
                        </div>
                    </div>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link profile-dropdown d-flex align-items-center" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2">{{ auth()->user()->name }}</span>
                        @if (auth()->user()->avarta_url)
                            <img src="{{ auth()->user()->avarta_url }}" class="rounded-circle" alt="">
                        @else
                            <img src="../../assets/images/avatars/profile-image.png" class="rounded-circle" alt="">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                        <a class="dropdown-item" href="{{ route('staff-profile') }}">
                            <i data-feather="user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="log-out"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

<script>
    document.getElementById('mark-all-read').addEventListener('click', function() {
        fetch('{{ route("markAsRead") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
        .then(() => {
            document.getElementById('notification-list').innerHTML = '<div class="dropdown-item text-center">No new notifications</div>';
            let countBadge = document.getElementById('notification-count');
            countBadge.textContent = '0';
            countBadge.style.display = 'none';
        });
    });
</script>
