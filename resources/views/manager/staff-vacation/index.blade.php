@extends('manager.app')

@section('active_vacation1', 'active')
@section('title', '休暇届')

@section('content_header')
    <li class="breadcrumb-item active"><b>休暇届</b></li>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/staff/vacation.css') }}">

@endpush

@section('content')

    <div class="tab-main">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true"><b>申請</b></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link search" id="list-tab" data-date="" data-toggle="tab" href="#list" role="tab"
                    aria-controls="list" aria-selected="false"><b>一覧</b></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('manager.staff-vacation.create-form')
            </div>
            <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                @include('manager.staff-vacation.list')
            </div>
        </div>
    </div>

    <!-- date-range-picker -->

@endsection
