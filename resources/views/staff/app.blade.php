@extends('layouts.master')

@section('content_header_home', '申請')

@section('content_aside')
    <li class="nav-item mb-2">
        <a href="{{ route('login') }}" class="nav-link active">
            <i class="far fa-list-alt mr-2 h4"></i>
            <p class="h4">
                申請
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('staff.over-time.index') }}" class="nav-link @yield('active_overtime')">
            <p>
                時間外申請
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('staff.part-time.index') }}" class="nav-link @yield('active_parttime')">
            <p>
                パート出勤簿
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('staff.vacation.index') }}" class="nav-link  @yield('active_vacation')">
            <p>
                休暇届
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('staff.absence.index') }}" class="nav-link  @yield('active_absence')">
            <p>
                欠勤届
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
@endsection
