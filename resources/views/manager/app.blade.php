@extends('layouts.master')

@section('content_header_home', '総務処理')

@section('content_aside')
    <li class="nav-item mb-2">
        <a href="{{ route('login') }}" class="nav-link active">
            <i class="far fa-list-alt mr-2 h4 mb-0"></i>
            <p class="h4">
                申請
            </p>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('login') }}" class="nav-link active">
            <i class="far fa-calendar-minus mr-2 h4 mb-0"></i>
            <p class="h4">
                総務処理
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manager.staff.index') }}" class="nav-link @yield('active_staff')">
            <p>
                社員管理
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link @yield('active_staff')">
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
        <a href="{{ route('login') }}" class="nav-link @yield('active_partime')">
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
    <li class="nav-item">
        <a href="{{ route('manager.absence.index') }}" class="nav-link @yield('active_absence')">
            <p>
                欠勤届
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
@endsection
