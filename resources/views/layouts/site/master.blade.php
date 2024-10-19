<!DOCTYPE html>
<html lang="en">
@include('layouts.site.head')
<body>
    <div class="login-register-container">
        <a href="{{ url('/login/form') }}" class="login-link">Login</a>
        <a href="{{ url('/registration/form') }}" class="register-link">Register</a>
      </div>
	@include('layouts.site.main-header')
    <div class="container-fluid">
        <main class="tm-main">
            <!-- Search form -->

            @yield('content')

            @yield('pagination')
            @include('layouts.site.footer')
        </main>
    </div>
    @include('layouts.site.scripts')
</body>
</html>
