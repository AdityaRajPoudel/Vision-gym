<nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
    <a href="" class="navbar-brand">
        <h1 class="m-0 display-4 font-weight-bold text-uppercase text-white">Vision Gym</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav ml-auto p-4 bg-secondary">
            <a href="#" class="nav-item nav-link active">Home</a>
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
            @else

            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
            @endauth
            @endif

            {{-- <a href="#" class="nav-item nav-link">Classes</a> --}}
        </div>
    </div>
</nav>