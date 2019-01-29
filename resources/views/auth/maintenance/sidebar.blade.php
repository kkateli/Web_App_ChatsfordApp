<div id="maintenance-left-sidebar" class="sidebar_container">
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
                            <a href="{{ route('maintenance.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="{{ route('maintenance.jobs') }}"><i class="fas fa-wrench fa-fw"></i>Maintenance Requests</a>
                        </li>

                        <li>
                            <a href="{{ route('maintenance.change-password') }}"><i class="fas fa-undo fa-fw"></i>Change password</a>
                        </li>

                        <li>
                            <a href="{{ route('maintenance.help') }}"><i class="fas fa-question fa-fw"></i>Help</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
