@extends('layouts.master')

@section('content_header_home', '総務処理')
@section('title', '総務処理')

@section('content_aside')
    <li class="nav-item role-name menu-is-opening menu-open">
        <a href="#" class="nav-link active">
            <i class="icofont-paper"></i>
            <p class="ml-1">
                申請
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: block;">
            <li class="nav-item">
                <a href="{{ route('manager.staff-over-time.index') }}" class="nav-link @yield('active_overtime1')">
                    <p>
                        時間外申請
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('manager.staff-part-time.index') }}" class="nav-link @yield('active_parttime1')">
                    <p>
                        パート出勤簿
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manager.staff-vacation.index') }}" class="nav-link  @yield('active_vacation1')">
                    <p>
                        休暇届
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item role-name sub-title menu-is-opening menu-open">
        <a href="#" class="nav-link active">
            <i class="icofont-tasks-alt"></i>
            <p class="ml-1">
                総務処理
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: block;">
            <li class="nav-item">
                <a href="{{ route('manager.staff.index') }}" class="nav-link @yield('active_staff')">
                    <p>
                        社員管理
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link @yield('active_manager')">
                    <p>
                        事業所･部署管理
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manager.calendar.index') }}" class="nav-link @yield('active_calendar')">
                    <p>
                        カレンダー管理
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manager.over-time.index') }}" class="nav-link @yield('active_overtime')">
                    <p>
                        時間外申請
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('manager.part_time.index') }}" class="nav-link @yield('active_part_time')">
                    <p>
                        パート出勤簿
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manager.vacation.index') }}" class="nav-link @yield('active_vacation')">
                    <p>
                        休暇届
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item" style="display: none">
                <a href="{{ route('manager.absence.index') }}" class="nav-link @yield('active_absence')">
                    <p>
                        欠勤届
                        <i class="right fas fa-caret-right"></i>
                    </p>
                </a>
            </li>
        </ul>
    </li>

@endsection
