@extends('manager.app')

@section('active_calendar', 'active')
@section('title', 'カレンダー管理')

@section('content_header')
    <li class="breadcrumb-item active"><b>カレンダー管理 </b></li>
@endsection

@push('styles')
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        input[name='year_text'] {
            width: 100px;
            display: inline;
        }

        .c-year a {
            color: #4B545C;
        }

        .prev {
            margin-left: 25px;
            margin-right: 10px;
        }

        .next {
            margin-left: 10px;
        }

        .c-year i {
            font-size: 20px;
            position: relative;
            top: 2px;
        }

        table {
            border-collapse: separate;
            border-spacing: 0.1em 15px;
            width: 100% !important;
        }

        .dataTables_scrollHeadInner,
        .dataTables_scrollHead {
            z-index: 1000 !important;
        }

        .dataTables_scrollBody {
            bottom: 30px;
            z-index: 1 !important;
        }

        table tr th {
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.15);
            border-radius: 0px;
            padding: 10px 15px;
            text-align: center;
            color: #1F232E;
            font-size: 16px;
            font-weight: 500;
        }

        table tr td {
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.15);
            padding: 10px 15px;
            font-size: 16px;
            font-weight: 400;
        }

        table label {
            font-weight: unset !important;
            margin-bottom: 0 !important;
        }

        .content2 {
            padding: 30px 30px 56px;
        }

        .frm-button {
            width: 219px;
            height: 46px;
            font-weight: bold;
            font-size: 18px;
            line-height: 26px;
            margin-top: 20px !important;
        }

        .title {
            font-weight: 500;
            font-size: 16px;
            line-height: 23px;

            color: #1F232E
        }

        .sub-title {
            font-weight: normal;
            font-size: 14px;
            line-height: 20px;

            color: #444444;

        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .dataTables_scrollBody::-webkit-scrollbar {
            display: none;
        }

        .dataTables_scrollBody {
            /* overflow: hidden !important; */
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        @media only screen and (max-width: 600px) {
            .dataTables_scrollBody {
                overflow: scroll !important;
            }
        }

        .dataTables_scrollBody:hover,
        .dataTables_scrollBody:active {
            width: calc(100% + 15px) !important;
            overflow: auto !important;
            -ms-overflow-style: unset;
            /* IE and Edge */
            scrollbar-width: unset;
        }

        .dataTables_scrollBody:hover::-webkit-scrollbar {
            display: block;
        }

        @media only screen and (max-width: 600px) {
            .c-year {
                margin-top: 15px;
            }

            .c-year .prev {
                margin-left: 0px;
            }

            .d-ubflex {
                display: block !important;
            }

            td {
                text-align: center !important;
            }
        }

    </style>
@endpush

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true"><b>登録</b></a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form action="{{ route('manager.calendar.store') }}" method="POST">
                @csrf

                <div class="content2">
                    <div class="row">
                        <div class="col-md-12 d-flex d-ubflex">
                            <div>
                                <span class="title">営業日カレンダー</span><br>
                                <span class="sub-title">休業日にチェックを入れてください</span>
                            </div>

                            <div class="c-year">
                                <a href="javascript:void(0)" class="prev" data-year="{{ request()->prev }}">
                                    <i class="right fas fa-caret-left"></i></a>
                                <input type="text" name="year_text" id="year_text" value="{{ request()->year_text }}"
                                    data-year="{{ request()->year }}" class="form-control text-center ">
                                <input type="hidden" name="year" value="{{ request()->year }}">
                                <a href="javascript:void(0)" class="next" data-year="{{ request()->next }}">
                                    <i class="right fas fa-caret-right"></i></a>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 overflow-auto">
                            <table id="table1">
                                <thead>
                                    <tr>
                                        <th style="color: #E40E0E; background-color: #F2DEDE">日</th>
                                        <th style="background: #fff">月</th>
                                        <th style="background: #fff">火</th>
                                        <th style="background: #fff">水</th>
                                        <th style="background: #fff">木</th>
                                        <th style="background: #fff">金</th>
                                        <th style="color: #3B89CF; background-color: #D9EDF7">土</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calendar as $item)
                                        @if ($item['week'] == 0)
                                            <tr>
                                        @endif
                                        <td style="background-color: {{ $item['color'] }}"><input type="checkbox"
                                                name="day[]" id="day{{ $item['day'] }}" value="{{ $item['day'] }}"
                                                {{ isset($arrCalendar[$item['day']]) ? 'checked' : '' }}>
                                            <label
                                                for="day{{ $item['day'] }}">{{ \Carbon\Carbon::parse($item['day'])->format('m/d') }}</label>
                                        </td>
                                        @if ($item['week'] == 6)
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary  frm-button">登録(更新)</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable({
                "scrollY": "564px",
                lengthChange: false,
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": true,
                scrollX: true,
                scroller: true
            });
        });

        $('.prev').click(function() {
            let redirect = `{{ route('manager.calendar.index') }}?year=${ $(this).data('year') }`;

            location.assign(redirect);
        })

        $('.next').click(function() {
            let redirect = `{{ route('manager.calendar.index') }}?year=${ $(this).data('year') }`;

            location.assign(redirect);
        })
    </script>
@endpush
