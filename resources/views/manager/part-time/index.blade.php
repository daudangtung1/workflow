@extends('manager.app')

@section('active_part_time', 'active')
@section('title', 'パート出勤簿')

@section('content_header')
    <li class="breadcrumb-item active"><b>パート出勤簿 </b></li>
@endsection

@push('scripts')
    <link rel="stylesheet" href="{{ asset('css/staff/parttime.css') }}">
@endpush

@section('content')

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $active == 'index' ? 'active' : '' }}" id="home-tab" data-toggle="tab"
                        href="#home" role="tab" aria-controls="home" aria-selected="true"><b>検索</b></a>
                </li>
                @if ($active == 'show')
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $active == 'show' ? 'active' : '' }}" id="list-tab" data-toggle="tab"
                        href="#list" role="tab" aria-controls="list" aria-selected="true"><b>検索結果</b></a>
                </li>
                <li class="nav-item d-none" role="presentation">
                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                        aria-controls="edit" aria-selected="true"><b>修正</b></a>
                </li>
                @endif
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  {{ $active == 'index' ? 'active show' : '' }}" id="home"
                    role="tabpanel" aria-labelledby="home-tab">
                    @include('manager.part-time.search')
                </div>
                @if ($active == 'show')
                    <div class="tab-pane fade active show" id="list" role="tabpanel" aria-labelledby="list-tab">
                        @include('manager.part-time.list')
                    </div>
                @endif
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    @include('manager.part-time.edit-form')
                </div>
            </div>

    <!-- date-range-picker -->

@endsection
