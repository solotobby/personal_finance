<div class="page-sidebar">
    <a class="logo" href="{{ route('staff.dashboard') }}">
        {{ Auth::guard('staffs')->check() ? Auth::guard('staffs')->user()->businessName : __('Personal Finance') }}
    </a>

    <ul class="list-unstyled accordion-menu">
        <li class="{{ $page == 'Dashboard' ? 'active-page' : '' }}">
            <a href="{{ route('staff.dashboard') }}" class="active">
                <i data-feather="activity"></i> {{ __('Dashboard') }}
            </a>
        </li>

        <li class="{{ $page == 'Task' ? 'active-page' : '' }}">
            <a href="{{ route('staff.tasks') }}" class="active">
                <i data-feather="trello"></i> {{ __('Task') }}
            </a>
        </li>

    </ul>

    <a href="#" id="sidebar-collapsed-toggle"><i data-feather="arrow-right"></i></a>
</div>
