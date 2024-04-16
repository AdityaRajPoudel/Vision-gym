<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="{{ route('member.index') }}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Members</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('trainer.index') }}">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Trainers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Inventory</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('announcement.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Announcements</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.register') }}">
                <i class="mdi mdi-emoticon menu-icon"></i>
                <span class="menu-title">User Registration</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Class Scheduiling</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Facility Management</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Attendance Tracking</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('attendance.index') }}">Member Attendance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('trainer.attendance.index') }}">Trainer Attendance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('member.attendance.list') }}">Member Attenance List</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Reporting and Analysis</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Total Revenue</a></li>

                </ul>
            </div>
        </li>

    </ul>
</nav>
