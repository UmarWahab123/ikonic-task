<!-- resources/views/header.blade.php -->

<header class="site-header mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(auth()->check())
                    <a href="{{ route('user-logout') }}" class="btn btn-dark">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endif
            </div>
        </div>
    </div>
</header>

