<div id="resident-left-sidebar" class="sidebar_container">
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
    <div class="sidebar">
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane animated fadeIn active">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <li>
                            <a href="{{ route('resident.dashboard') }}"><i class="fas fa-comment fa-fw"></i>Announcements</a>
                        </li>

                        <li>
                            <a href="{{ route('user.profile') }}"><i class="far fa-address-card fa-fw"></i>My Profile</a>
                        </li>

                        <li>
                            <a href="{{ route('resident.events') }}"><i class="far fa-calendar-alt fa-fw"></i>Activities</a>
                        </li>

                        <li>
                            <a href="{{ route('resident.menus') }}"><i class="fas fa-utensils fa-fw"></i>Meal Menu</a>
                        </li>

                        <li>
                            <a href="{{ route('resident.jobs') }}"><i class="fas fa-wrench fa-fw"></i>Maintenance Requests</a>
                        </li>

                        <li>
                            <a href="{{ route('resident.complaints') }}"><img src="{{ asset('assets/images/icon-complaint.png') }}" alt="complaint" class="img-complaint"></i>Complaints</a>
                        </li>

                        <li>
                            <a href="{{ route('resident.help') }}"><i class="fas fa-question fa-fw"></i>Help</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
