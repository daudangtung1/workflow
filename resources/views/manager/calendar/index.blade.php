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
            width: 80px;
            display: inline;
        }

        .c-year a {
            color: #000
        }

        .c-year i {
            font-size: 20px;
            margin-top: 3px
        }

        table {
            border-collapse: separate;
            border-spacing: 0.2em 0.5em;
            width: 100% !important;
        }

        table tr td,
        table tr th {
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.15);
            border-radius: 3px;
            padding: 10px 15px;
            text-align: center;
        }

        table label {
            font-weight: unset !important;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link pl-5 pr-5 active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true"><b>登録</b></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  pl-5 pr-5 pt-3 pb-3 active show" id="home" role="tabpanel"
                    aria-labelledby="home-tab">
                    <form action="{{ route('manager.calendar.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <span><b>営業日カレンダー</b></span><br>
                                <span>休業日にチェックを入れてください</span>
                            </div>
                            <div class="col-md-3 pt-2 c-year">
                                <a href="javascript:void(0)" class="prev" data-year="{{ request()->prev }}">
                                    <i class="right fas fa-caret-left"></i></a>
                                <input type="text" name="year_text" id="year_text" value="{{ request()->year_text }}"
                                    data-year="{{ request()->year }}" class="form-control text-center ">
                                    <input type="hidden" name="year" value="{{ request()->year }}">
                                <a href="javascript:void(0)" class="next" data-year="{{ request()->next }}">
                                    <i class="right fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 overflow-auto">
                                <table id="table1">
                                    <thead>
                                        <tr>
                                            <th style="color: #E40E0E; background-color: #F2DEDE">日</th>
                                            <th>月</th>
                                            <th>火</th>
                                            <th>水</th>
                                            <th>木</th>
                                            <th>金</th>
                                            <th style="color: #3B89CF; background-color: #D9EDF7">土</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calendar as $item)
                                            @if ($item['week'] == 0)
                                                <tr>
                                            @endif
                                            <td style="background-color: {{ $item['color'] }}"><input type="checkbox"
                                                    name="day[]" id="day{{ $item['day'] }}" value="{{ $item['day'] }}" {{ isset($arrCalendar[$item['day']]) ? 'checked' : '' }}>
                                                <label for="day{{ $item['day'] }}">{{ $item['day'] }}</label>
                                            </td>
                                            @if ($item['week'] == 6)
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-3">
                                <button class="btn btn-primary w-100 font-weight-bold">登録(更新)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable({
                "scrollY": "500px",
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
