@extends('manager.app')

@section('active_absence', 'active')
@section('title', '欠勤届')

@section('content_header')
    <li class="breadcrumb-item active"><b>欠勤届</b></li>
@endsection
@push('scripts')
    <link rel="stylesheet" href="{{ asset('css/staff/absence.css') }}">
@endpush

@section('content')
   
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link  {{ $active == 'index' ? 'active' : '' }}" id="home-tab" data-toggle="tab"
                        href="#home" role="tab" aria-controls="home" aria-selected="true"><b>検索</b></a>
                </li>
                <li class="nav-item d-{{ $active == 'show' ? '' : 'none' }}" role="presentation">
                    <a class="nav-link  {{ $active == 'show' ? 'active' : '' }}" id="list-tab" data-toggle="tab"
                        href="#list" role="tab" aria-controls="list" aria-selected="true"><b>検索結果</b></a>
                </li>
                <li class="nav-item " role="presentation">
                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                        aria-controls="edit" aria-selected="true"><b>修正</b></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade   {{ $active == 'index' ? 'active show' : '' }}" id="home"
                    role="tabpanel" aria-labelledby="home-tab">
                    @include('manager.absence.search')
                </div>
                @if ($active == 'show')
                    <div class="tab-pane fade active show" id="list" role="tabpanel" aria-labelledby="list-tab">
                        @include('manager.absence.list')
                    </div>
                @endif
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    @include('manager.absence.edit-form')
                </div>
            </div>
 
    <!-- date-range-picker -->
@endsection
