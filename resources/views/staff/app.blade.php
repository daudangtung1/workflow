@extends('layouts.master')

@section('content_header_home', '申請')
@section('title', '申請')

@section('content_aside')
    @if (auth()->user()->active_menu_approver == \App\Enums\UserApproverMenu::SHOW)
        <li class="nav-item role-name sub-title menu-is-opening menu-open">
            <a href="#" class="nav-link active">
                <i class="icofont-law-document"></i>
                <p class="ml-1">
                    承認作業
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                    <a href="{{ route('approver.overtime.index') }}" class="nav-link @yield('active_overtime1') ">
                        <p>
                            時間外申請 ({{ request()->overTime->count() }})
                            <i class="right fas fa-caret-right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('approver.parttime.index') }}" class="nav-link @yield('active_parttime1') ">
                        <p>
                            パート出勤簿 ({{ request()->partTime->count() }})
                            <i class="right fas fa-caret-right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('approver.vacation.index') }}" class="nav-link @yield('active_vacation1') ">
                        <p>
                            休暇届 ({{ request()->vacation->count() }})
                            <i class="right fas fa-caret-right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('approver.censorship.index') }}" class="nav-link @yield('censorship') ">
                        <p>
                            月次承認 ({{\App\Models\ParttimeRegister::countTotalNotApproval() + \App\Models\OvertimeRegister::countTotalNotApproval()}})
                            <i class="right fas fa-caret-right"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </li>
    @endif
@endsection
