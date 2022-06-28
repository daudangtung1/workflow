<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <div style="width: 26px;border-bottom: 1.9px solid #4B545C; margin-bottom:9px"></div>
                <div style="width: 22px;border-bottom: 1.9px solid #4B545C; margin-bottom:9px"></div>
                <div style="width: 30px;border-bottom: 1.9px solid #4B545C; margin-bottom:9px"></div>
            </a>
        </li>

    </ul>
    <ol class="navbar-nav float-sm-left ml-2 hide-mobile">
        <li class="breadcrumb-item"><a href="{{ route('login') }}">@yield('content_header_home')</a></li>
        @yield('content_header')
    </ol>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto test">
        <li class="nav-item d-flex hide-mobile">
            <a class="nav-link  pl-0 ml-25 mr-25 font-weight-bold" role="button">
                <span>{{ (auth()->user()) ? auth()->user()->fullName : '' }}</span>
            </a>
            <div class="border-li"></div>
        </li>
        <li class="nav-item d-flex ">
            <a class="nav-link  pl-0 ml-25 mr-25 font-weight-bold" href="{{route('login')}}" role="button">
                社員ID: {{ (auth()->user()) ? auth()->user()->user_id : '' }}
            </a>
            <div class="border-li"></div>
        </li>
        <li class="nav-item nav-last">
            <a class="nav-link  pl-0 ml-25" href="javascript:void(0)" id="wf_nav_user">
                <i class="icofont-gear font-24 color-nav"></i>
            </a>
            <ul class="hidden_logout" id="wf_nav_user_list">
                <li>
                    <a href="{{route('change_password')}}">Change password</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}">ログアウト</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>