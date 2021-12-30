<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login') }}" class="brand-link header-1">

        <span class="brand-text font-weight-light text-center font-weight-bold ">ワークフローシステム</span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-size-auto-observer observed">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content">
                    <!-- Sidebar Menu -->
                    <nav class="">
                        <ul class="nav nav-pills nav-sidebar flex-column aside-ul" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item role-name menu-is-opening menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="icofont-paper"></i>
                                    <p class="ml-1">
                                        申請
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    <li class="nav-item">
                                        <a href="{{ route('staff-over-time.index') }}"
                                            class="nav-link @yield('active_staff_overtime')">
                                            <p>
                                                時間外申請
                                                <i class="right fas fa-caret-right"></i>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('staff-part-time.index') }}"
                                            class="nav-link @yield('active_staff_parttime')">
                                            <p>
                                                パート出勤簿
                                                <i class="right fas fa-caret-right"></i>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('staff-vacation.index') }}"
                                            class="nav-link  @yield('active_staff_vacation')">
                                            <p>
                                                休暇届
                                                <i class="right fas fa-caret-right"></i>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            @yield('content_aside')
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link">
                                    <p>
                                        ログアウト
                                        <i class="right fas fa-caret-right"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item clock">
                                <a href="#" class="nav-link">
                                    <i class="icofont-clock-time"></i>
                                    <p>
                                        <span id="dateReal"></span>
                                        <span id="clockReal"></span>
                                    </p>
                                </a>
                            </li>


                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 26.7376%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
