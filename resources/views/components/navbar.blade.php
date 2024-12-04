<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $user->firstname.' '.$user->lastname }}</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    Change Password
                    <span class="float-right"><i class="fas fa-envelope mr-2"></i></span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('signout') }}" class="dropdown-item">
                    Sign Out
                    <span class="float-right"><i class="fas fa-envelope mr-2"></i></span>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
