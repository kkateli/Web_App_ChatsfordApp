<div id="management-left-sidebar" class="sidebar_container">
    <header>
        <div class="user-account">
            <div class="dropdown">
                <div>
                    <span>
                        Welcome, {{ auth()->user()->name() }}
                    </span>
                </div>
            </div>
        </div>
    </header>
    <div class="sidebar d-print-none">
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane animated fadeIn active">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li>
                        </li>
                        <li>
                            <a href="{{ route('management.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="{{ route('profiles') }}"><i class="far fa-address-card fa-fw"></i>My Profile</a>   
                        </li>

                        <li>
                            <a href="{{ route('announcements') }}"><i class="fas fa-comment fa-fw"></i>Announcements</a>
                        </li>

                        <li>
                            <a href="{{ route('residents') }}"><i class="fas fa-user fa-fw"></i>Residents</a>
                        </li>

                        <li>
                            <a href="{{ route('employees') }}"><img src="{{ asset('assets/images/icon-employee.png') }}" alt="employee" class="img-employee"></i>Employees</a>
                        </li>

                        <li>
                            <a href="{{ route('jobs') }}"><i class="fas fa-wrench fa-fw"></i>Maintenance Requests</a>
                        </li>

                        <li>
                            <a href="{{ route('management.complaints') }}"><img src="{{ asset('assets/images/icon-complaint.png') }}" alt="complaint" class="img-complaint"></i>Complaints</a>
                        </li>

                        <li>
                            <a href="{{ route('events') }}"><i class="far fa-calendar-alt fa-fw"></i>Activities</a>
                        </li>

                        <li>
                            <a href="{{ route('management.menus') }}"><i class="fas fa-utensils fa-fw"></i>Meal Menu</a>
                        </li>

                        <li>
                            <a href="{{ route('homes') }}"><i class="fas fa-home fa-fw"></i>Homes</a>
                        </li>

                        <li>
                            <a href="{{ route('areas') }}"><i class="fas fa-map-marker-alt fa-fw"></i>Areas</a>
                        </li>

                        <li>
                            <a href="{{ route('maintenance-types') }}"><i class="fas fa-paint-roller fa-fw"></i>Maintenance Types</a>
                        </li>

                        <li>
                            <a href="{{ route('management.help') }}"><i class="fas fa-question fa-fw"></i>Help</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>