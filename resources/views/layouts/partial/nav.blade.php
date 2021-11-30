
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-stream"></i></a>
        </li>

    </ul>
    <ol class="navbar-nav float-sm-left ml-2">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">@yield('content_header_home')</a></li>
        @yield('content_header')
    </ol>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto test">
        <li class="nav-item d-flex">
            <a class="nav-link p-0" data-widget="fullscreen" href="#" role="button">
                <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle" style="width: 40px"> 
                <span class="hide-mobile">{{ (auth()->user()) ? auth()->user()->fullName : '' }}</span>
            </a>
            <div class="border-li"></div>
        </li>
        <li class="nav-item d-flex pl-1 hide-mobile">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                社員ID: {{ (auth()->user()) ? auth()->user()->user_id : '' }}
            </a>
            <div class="border-li"></div>
        </li>
        <li class="nav-item pl-1">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-cog"></i>
            </a>
        </li>
    </ul>
</nav>
