@extends('layouts.master')

@section('content_header_home', '承認作業')
@section('title', '承認作業')

@section('content_aside')
    <li class="nav-item role-name ">
        <a href="{{ route('login') }}" class="nav-link active mb-0">
            <i class="icofont-paper"></i>
            <p class="ml-1">
                申請
            </p>
        </a>
    </li>
    <li class="nav-item role-name sub-title">
        <a href="{{ route('login') }}" class="nav-link active">
            <i class="icofont-law-document"></i>
            <p class="ml-1">
                承認作業
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('approver.over_time.index') }}" class="nav-link @yield('active_overtime') ">
            <p>
                時間外申請 ({{ request()->overTime->count() }})
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('approver.part_time.index') }}" class="nav-link @yield('active_parttime') ">
            <p>
                パート出勤簿 ({{ request()->partTime->count() }})
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('approver.vacation.index') }}" class="nav-link @yield('active_vacation') ">
            <p>
                休暇届 ({{ request()->vacation->count() }})
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
    <li class="nav-item" style="display: none">
        <a href="{{ route('approver.absence.index') }}" class="nav-link @yield('active_absence') ">
            <p>
                欠勤届 ({{ request()->absence->count() }})
                <i class="right fas fa-caret-right"></i>
            </p>
        </a>
    </li>
@endsection
