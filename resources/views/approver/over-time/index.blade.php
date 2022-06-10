@extends('approver.app')

@section('active_overtime1', 'active')
@section('title', '時間外･交通費申請')

@section('content_header')
<li class="breadcrumb-item active"><b>時間外･交通費申請</b></li>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('css/staff/overtime.css') }}">
<style>
    #count_data {
        font-size: 15px;
        vertical-align: middle;
    }
</style>
@endpush
@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $active == 'index' ? 'active' : '' }}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><b>検索</b></a>
    </li>
    @if ($active == 'show')
    <li class="nav-item" role="presentation">
        <a class="nav-link  {{ $active == 'show' ? 'active' : '' }}" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">
            <b>
                検索結果
                @if(isset($dataRegister))
                @include('approver.over-time.count')
                @endif
            </b>
        </a>
    </li>
    @endif
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade  {{ $active == 'index' ? 'active show' : '' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('approver.over-time.search')
    </div>
    @if ($active == 'show')
    <div class="tab-pane fade active show" id="list" role="tabpanel" aria-labelledby="list-tab">
        @include('approver.over-time.list')
    </div>
    @endif
</div>
@endsection