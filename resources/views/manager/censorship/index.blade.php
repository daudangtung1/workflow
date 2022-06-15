@extends('approver.app')

@section('censorship', 'active')
@section('title', '月次承認')

@section('content_header')
    <li class="breadcrumb-item active"><b>月次承認</b></li>
@endsection

@push('styles')
    <style>
        .search,
        .table tr:hover {
            cursor: pointer;
        }

        .form-button {
            margin-top: 50px;
            height: 46px;
            font-size: 18px;
            font-weight: 700;
        }

        .custom-check {
            height: 22px;
            margin-bottom: 0px;
        }
    </style>
@endpush

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $active == 'index' ? 'active' : '' }}" id="home-tab" data-toggle="tab"
               href="#search" role="tab" aria-controls="home" aria-selected="true"><b>検索</b></a>
        </li>
        @if ($active == 'list')
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $active == 'list' ? 'active' : '' }}" id="list-tab" data-toggle="tab"
                   href="#list" role="tab" aria-controls="list" aria-selected="true"><b>検索結果</b></a>
            </li>
        @endif
        @if ($active == 'show')
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $active == 'show' ? 'active' : '' }}" id="list-tab" data-toggle="tab"
                   href="#show" role="tab" aria-controls="list" aria-selected="true"><b>一覧</b></a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{ $active == 'index' ? 'active show' : '' }}" id="search"
             role="tabpanel" aria-labelledby="home-tab">
            @include('manager.censorship.search')
        </div>
        @if ($active == 'list')
            @include('manager.censorship.list')
        @endif
        @if ($active == 'show')
            @include('manager.censorship.show')
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $('document').ready(function () {
            $('body').on('click', '.censorship-item td:not(.action)', function (e) {
                var tr = $(this).closest('tr');
                var model = tr.data('model');
                var date = tr.data('date');
                var userId = tr.data('user');
                var form = $('.form-table');
                form.find('input[type="hidden"][name="model"]').val(model)
                form.find('input[type="hidden"][name="date"]').val(date)
                form.find('input[type="hidden"][name="user_id"]').val(userId)
                form.submit();
            });

            $(document).on("click", ".search", function () {
                loading();
                let date = $(this).attr('data-date');
                let model = $(this).attr('data-model');
                let userId = $(this).attr('data-user_id');

                var form = $('.form-show');
                form.find('input[type="hidden"][name="model"]').val(model)
                form.find('input[type="hidden"][name="date"]').val(date)
                form.find('input[type="hidden"][name="user_id"]').val(userId)
                form.submit();
            });

            function showButton()
            {
                var atLeastOneIsChecked = $(".check-one:checked").map(function () {
                    return $(this).val();
                }).get();

                if (atLeastOneIsChecked.length > 0) {
                    $('.form-button').removeClass('d-none');
                } else {
                    $('.form-button').addClass('d-none');
                }
            }

            $(document).on("change", ".check-one", function () {
                showButton();
            });

            $('body').on('click', '.check-all', function () {
                if($(this).is(':checked')){
                    $('.check-one').prop('checked', true);
                } else {
                    $('.check-one').prop('checked', false);
                }
                showButton();
            });
        });
    </script>
@endpush
