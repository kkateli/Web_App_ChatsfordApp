<nav class="navbar navbar-fixed-top d-print-none" style="background-color: #d8cfc0">
    <div class="container-fluid">

        <div class="navbar-btn">
            <button type="button" href="#menu-toggle" id="menu-toggle"><i class="fas fa-bars"></i></button>
        </div>

        <div class="navbar-brand">
            <a href=" "><img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-responsive logo"></a>                
        </div>

        <div class="navbar-right">
            <div class="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('logout') }}" class="icon-menu"><i class="fas fa-sign-out-alt fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
