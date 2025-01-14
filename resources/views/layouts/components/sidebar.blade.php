<div class="page-sidebar">
    <a class="logo" href="{{ route('dashboard') }}">
        {{ Auth::user()->hasBusinessAccount()
            ? Auth::user()->businesses->first()->business_name
            : __('Personal Finance') }}
    </a>


    <ul class="list-unstyled accordion-menu">
        <li class="{{ $page == 'Dashboard' ? 'active-page' : '' }}">
            <a href="{{ route('dashboard') }}" class="active"><i data-feather="activity"></i>{{ __('Dashboard') }}</a>
            {{--  <ul class="">
                    <li><a href="{{ route('dashboard') }}" class="active"><i class="far fa-circle"></i>{{ __('All') }}</a></li>
                    <li><a href="{{ route('dashboard') }}"><i class="far fa-circle"></i>{{ __('Expenses') }}</a></li>
                  </ul>  --}}
        </li>
        <li class="{{ $page == 'Transactions' ? 'active-page' : '' }}">
            <a href="#"><i data-feather="grid"></i>{{ __('Transactions') }}<i
                    class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="">
                <li><a href="{{ route('transactions.index') }}"><i class="far fa-circle"></i>{{ __('All') }}</a>
                </li>
                {{-- <li><a href="{{ route('transactions.summary') }}"><i class="far fa-circle"></i>{{ __('Summary') }}</a></li> --}}
                <li><a href="{{ route('transactions.report') }}"><i class="far fa-circle"></i>{{ __('Report') }}</a>
                </li>

            </ul>
        </li>
        <li class="{{ $page == 'Staff' ? 'active-page' : '' }}">
            {{-- <a href="#"><i data-feather="grid"></i>{{ __('Staff') }}<i class="fas fa-chevron-right dropdown-icon"></i></a> --}}
            <a href="#"><i data-feather="box"></i>{{ __('Staff') }}<i
                    class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="">
                <li><a href="{{ route('staff.index') }}"><i class="far fa-circle"></i>{{ __('All') }}</a></li>
                {{-- <li><a href="{{ route('salary.advance') }}"><i class="far fa-circle"></i>{{ __('Salary Advance') }}</a></li> --}}
                <li><a href="{{ route('staff.loan') }}"><i class="far fa-circle"></i>{{ __('Setup Loans') }}</a></li>

                <li><a href="{{ route('staff.loan.list') }}"><i class="far fa-circle"></i>{{ __('Loans') }}</a></li>
            </ul>
        </li>
        <li class="{{ $page == 'Apps' ? 'active-page' : '' }}">
            {{--  <a href="{{ route('calender') }}""><i data-feather="aperture"></i>Calender</a>  --}}
            {{--  <ul class="">
                    {{-- <li><a href="email.html"><i class="far fa-circle"></i>Email</a></li>  --}}
            {{--  <li><a href="contact.html"><i class="far fa-circle"></i>Contact</a></li> --}}
            {{--  <li><a href="{{ route('calender') }}"><i class="far fa-circle"></i>{{ __('Calender') }}</a></li>  --}}
            {{-- <li><a href="social.html"><i class="far fa-circle"></i>Social</a></li>
                    <li><a href="file-manager.html"><i class="far fa-circle"></i>File Manager</a></li> --}}
            {{--  </ul>  --}}
        </li>
        {{-- <li>
                  <a href="#"><i data-feather="code"></i>UI Kits<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li><a href="alerts.html"><i class="far fa-circle"></i>Alerts</a></li>
                    <li><a href="typography.html"><i class="far fa-circle"></i>Typography</a></li>
                    <li><a href="icons.html"><i class="far fa-circle"></i>Icons</a></li>
                    <li><a href="badge.html"><i class="far fa-circle"></i>Badge</a></li>
                    <li><a href="buttons.html"><i class="far fa-circle"></i>Buttons</a></li>
                    <li><a href="cards.html"><i class="far fa-circle"></i>Cards</a></li>
                    <li><a href="dropdowns.html"><i class="far fa-circle"></i>Dropdowns</a></li>
                    <li><a href="list-group.html"><i class="far fa-circle"></i>List Group</a></li>
                    <li><a href="toasts.html"><i class="far fa-circle"></i>Toasts</a></li>
                    <li><a href="modal.html"><i class="far fa-circle"></i>Modal</a></li>
                    <li><a href="pagination.html"><i class="far fa-circle"></i>Pagination</a></li>
                    <li><a href="popovers.html"><i class="far fa-circle"></i>Popovers</a></li>
                    <li><a href="progress.html"><i class="far fa-circle"></i>Progress</a></li>
                    <li><a href="spinners.html"><i class="far fa-circle"></i>Spinners</a></li>
                    <li><a href="accordion.html"><i class="far fa-circle"></i>Accordion</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i data-feather="box"></i>Plugins<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li><a href="block-ui.html"><i class="far fa-circle"></i>Block UI</a></li>
                    <li><a href="session-timeout.html"><i class="far fa-circle"></i>Session Timeout</a></li>
                    <li><a href="tree-view.html"><i class="far fa-circle"></i>Tree View</a></li>
                    <li><a href="select2.html"><i class="far fa-circle"></i>Select2</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i data-feather="star"></i>Pages<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li><a href="invoice.html"><i class="far fa-circle"></i>Invoice</a></li>
                    <li><a href="404.html"><i class="far fa-circle"></i>404 Page</a></li>
                    <li><a href="500.html"><i class="far fa-circle"></i>500 Page</a></li>
                    <li><a href="blank-page.html"><i class="far fa-circle"></i>Blank Page</a></li>
                    <li><a href="login.html"><i class="far fa-circle"></i>Login</a></li>
                    <li><a href="register.html"><i class="far fa-circle"></i>Register</a></li>
                    <li><a href="lockscreen.html"><i class="far fa-circle"></i>Lockscreen</a></li>
                    <li><a href="price.html"><i class="far fa-circle"></i>Price</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i data-feather="droplet"></i>Form<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li><a href="form-elements.html"><i class="far fa-circle"></i>Form Elements</a></li>
                    <li><a href="form-layout.html"><i class="far fa-circle"></i>Form Layout</a></li>
                    <li><a href="form-validation.html"><i class="far fa-circle"></i>Form Validation</a></li>
                    <li><a href="form-select2.html"><i class="far fa-circle"></i>Select2</a></li>
                  </ul>
                </li> --}}
        <li class="{{ $page == 'Budget' ? 'active-page' : '' }}">
            <a href="#"><i data-feather="aperture"></i>Budgets<i
                    class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="">
                <li><a href="{{ url('budget') }}"><i class="far fa-circle"></i>Create</a></li>
                <li><a href="{{ url('budgets/summary') }}"><i class="far fa-circle"></i>Summary</a></li>
            </ul>
        </li>
        {{--  <li>
                  <a href="{{ route('dashboard') }}"><i data-feather="pie-chart"></i>Charts</a>
                </li>  --}}

    </ul>
    <a href="#" id="sidebar-collapsed-toggle"><i data-feather="arrow-right"></i></a>
</div>
