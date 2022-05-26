@extends(formatRole(auth()->user()->role).'.app')

@section('active_staff_overtime', 'active')
@section('content_header_home', '申請')
@section('title', '時間外申請')

@section('content_header')
    <li class="breadcrumb-item active"><b>時間外申請</b></li>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/staff/overtime.css') }}">
@endpush

@section('content')

    <div class="tab-main">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            
            <li class="nav-item " role="presentation">
                <a class="nav-link search active" id="list-tab" data-toggle="tab" href="#list" role="tab"
                    data-date="{{ $dates['current'] }}" aria-controls="profile" aria-selected="false"><b>一覧</b></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true"><b>{{ isset($infoRegister) ? '更新' : ' 申請' }}</b></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                @if (isset($infoRegister))
                    @include('staff.over-time.edit-form')
                @else
                    @include('staff.over-time.list')
                @endif
            </div>
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                @if (isset($infoRegister))
                    @include('staff.over-time.edit-form')
                @else
                    @include('staff.over-time.create-form')
                @endif

            </div>
        </div>
    </div>

    <!-- date-range-picker -->

@endsection


