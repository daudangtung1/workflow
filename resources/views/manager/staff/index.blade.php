@extends('manager.app')

@section('active_staff', 'active')

@section('content_header')
    <li class="breadcrumb-item active"><b>休暇届</b></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request()->list ? '' : 'active' }}" id="home-tab" data-toggle="tab" href="#home"
                        role="tab" aria-controls="home" aria-selected="true"><b>申請</b></a>
                </li>
                <li class="nav-item" role="presentation">
                    @if (request()->list)
                        <a class="nav-link search active" id="list-tab" data-date="" data-toggle="tab" href="#list"
                            {{-- href="{{ request()->active_list ? route('manager.staff.show', ['active_list']) : '#list' }}" --}} role="tab" aria-controls="list" aria-selected="false"><b>一覧</b></a>
                    @else
                        <a class="nav-link search" id="list-tab" {{-- href="#list" --}}
                            href="{{ route('manager.staff.index', ['list' => 'active']) }}"><b>一覧</b></a>
                    @endif

                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show pl-5 pr-5 pt-3 pb-3
                {{ request()->list ? '' : 'active' }}"
                    id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if(isset($action))
                        @include('manager.staff.edit-form')
                    @else
                        @include('manager.staff.create-form')
                    @endif
                </div>
                <div class="tab-pane fade
                {{ request()->list ? 'active show' : '' }}" id="list"
                    role="tabpanel" aria-labelledby="list-tab">
                    @if (request()->list)
                        @include('manager.staff.list')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- date-range-picker -->

@endsection
