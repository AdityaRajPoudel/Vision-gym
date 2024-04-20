<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
            {{-- <a class="nav-link" href="{{ route('get.membership') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Get Membership</span>
            </a> --}}
        </li>
        {{-- @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2) --}}
        @if (auth()->user()->user_type_id == 1 )
        <li class="nav-item">
            <a class="nav-link" href="{{ route('banners.index') }}">
                <i class="mdi mdi-image-area menu-icon"></i>
                <span class="menu-title">Banners</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('member.index') }}">
                <i class="mdi mdi-account-star menu-icon"></i>
                <span class="menu-title">Members</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('trainer.index') }}">
                <i class="mdi mdi-dumbbell menu-icon"></i>
                <span class="menu-title">Trainers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('announcement.index') }}">
                <i class="mdi mdi-bell-ring menu-icon"></i>
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
            <a class="nav-link" href="{{ route('schedule.index') }}">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Class Scheduiling</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#inv" aria-expanded="false" aria-controls="inv">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Inventory</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="inv">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Products</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="#">Suppliers</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('purchase.index') }}">Purchases</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="sales">
                <i class="mdi mdi-currency-brl menu-icon"></i>
                <span class="menu-title">Sales</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sales">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('sales.index') }}">Billing</a></li>
                </ul>
            </div>
        </li>
        @endif
        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
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
                    <li class="nav-item"> <a class="nav-link" href="{{ route('progress.index') }}">Member Progress</a></li>

                </ul>
            </div>
        </li>
        @endif
        @if (auth()->user()->user_type_id == 0)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.membership') }}">
                <i class="mdi mdi-account-star menu-icon"></i>
                <span class="menu-title">Get Membership</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#test" aria-expanded="false" aria-controls="test">
                <i class="mdi mdi-file-chart menu-icon"></i>
                <span class="menu-title">Reporting and Analysis</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="test">
                <ul class="nav flex-column sub-menu">
                     @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 0)
                    <li class="nav-item"> <a class="nav-link" href="{{ route('member.report.index') }}">Member Attendance Report</a></li>
                    @endif
                    @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                    <li class="nav-item"> <a class="nav-link" href="{{ route('trainer.report.index') }}">Trainer Attendance Report</a></li>
                    @endif
                </ul>
            </div>
        </li>
    </ul>
</nav>
