@extends('layouts.master')

{{-- @section('header_active', 'active') --}}

@section('content_aside')

    <li class="nav-item">
        <a href="{{ route('staff.over-time.index') }}" class="nav-link @yield('active_overtime')">
            <p>
                時間外申請
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('staff.part-time.index') }}" class="nav-link @yield('active_parttime')">
            <p>
                パート出勤簿
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('staff.vacation.index') }}" class="nav-link  @yield('active_vacation')">
            <p>
                休暇届
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link  @yield('active_absence')">
            <p>
                欠勤届
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
    </li>
@endsection
