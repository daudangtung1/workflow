@extends('staff.app')

@section('active_parttime', 'active')

@section('content_header')
    <li class="breadcrumb-item active"><b>パート出勤簿</b></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true"><b>申請</b></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#list" role="tab"
                        aria-controls="profile" aria-selected="false"><b>一覧</b></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pl-5 pr-5 pt-3 pb-3" id="home" role="tabpanel"
                    aria-labelledby="home-tab">
                    @include('staff.part-time.create-form')
                </div>
                <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="profile-tab">
                    {{-- @include('staff.over-time.list') --}}
                </div>
            </div>
        </div>
    </div>
    <!-- date-range-picker -->

@endsection
