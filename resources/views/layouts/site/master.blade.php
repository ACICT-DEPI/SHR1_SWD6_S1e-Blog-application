<!DOCTYPE html>
<html lang="en">
@include('layouts.site.head')
<body>
    @guest

    <div class="login-register-container">
        <a href="{{ url('/login/form') }}" class="login-link">Login</a>
        <a href="{{ url('/registration/form') }}" class="register-link">Register</a>
      </div>
      @endguest
      @auth
      <div class="login-register-container">
          <a href="{{ url('/my/posts') }}" class="login-link">Dashboard</a>

        </div>

    @endauth
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
