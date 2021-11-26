@extends('manager.app')

@section('active_overtime', 'active')

@section('content_header')
    <li class="breadcrumb-item active"><b>時間外･交通費申請 </b></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link pl-5 pr-5 {{ $active == 'index' ? 'active' : '' }}" id="home-tab" data-toggle="tab"
                        href="#home" role="tab" aria-controls="home" aria-selected="true"><b>検索</b></a>
                </li>
                <li class="nav-item d-{{ $active == 'show' ? '' : 'none' }}" role="presentation">
                    <a class="nav-link pl-5 pr-5 {{ $active == 'show' ? 'active' : '' }}" id="list-tab" data-toggle="tab"
                        href="#list" role="tab" aria-controls="list" aria-selected="true"><b>検索結果</b></a>
                </li>
                <li class="nav-item " role="presentation">
                    <a class="nav-link pl-5 pr-5" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                        aria-controls="edit" aria-selected="true"><b>修正</b></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  pl-5 pr-5 pt-3 pb-3 {{ $active == 'index' ? 'active show' : '' }}" id="home"
                    role="tabpanel" aria-labelledby="home-tab">
                    @include('manager.over-time.search')
                </div>
                @if ($active == 'show')
                    <div class="tab-pane fade active show" id="list" role="tabpanel" aria-labelledby="list-tab">
                        @include('manager.over-time.list')
                    </div>
                @endif
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    @include('manager.over-time.edit-form')
                </div>
            </div>
        </div>
    </div>
    <!-- date-range-picker -->

@endsection
