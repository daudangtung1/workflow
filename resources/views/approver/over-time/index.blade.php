@extends('approver.app')

@section('active_overtime1', 'active')
@section('title', '時間外･交通費申請')

@section('content_header')
    <li class="breadcrumb-item active"><b>時間外･交通費申請</b></li>
@endsection

@push('styles')
    <style>
        .note {
            font-size: 16px;
            line-height: 28px;
            color: #4B545C;
            margin-top: 30px;
        }

        .check-all {
            font-size: 14px;
            line-height: 20px;
            color: #3B89CF;
        }

        .form-button {
            height: 46px;
            font-size: 18px;
            font-weight: 700;
            margin: 116px 0 50px 0;
            width: 410px !important;
            min-width: 320px;
        }

        .w-230 {
            width: 230px !important;
        }

        .w-318 {
            width: 318px !important;
        }

        .w-291 {
            width: 291px !important;
        }

        .w-276 {
            width: 276px !important;
        }

        .w-150 {
            width: 150px !important;
        }

        @media only screen and (max-width: 1165px) {
            .form-button {
                margin: 30px 0 50px 0px !important;
                width: 100% !important;
            }
            
        }
        @media only screen and (max-width: 600px) {
            .button-right {
                width: 100% !important;
            }
        }

    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('approver.over_time.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3 text-right">
                                <a class="check-all pr-5" href="javascript:void(0)">全てチェック</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 overflow-auto">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="w-150">日付</th>
                                    <th class="w-150">開始時刻</th>
                                    <th class="w-150">終了時刻</th>
                                    <th class="w-150">時間外計(分)</th>
                                    <th class="w-230">申請者(社員ID)</th>
                                    <th class="w-150">承認</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listRegister as $item)
                                    <tr>
                                        <td>{{ $item['date'] }}</td>
                                        <td>{{ $item['start_time'] }}</td>
                                        <td>{{ $item['end_time'] }}</td>
                                        <td>{{ $item['time'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>
                                            <label class="custom-check">
                                                <input type="checkbox" name="id[]" class="check-one"
                                                    value="{{ $item['id'] }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('common.data.error') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="note float-left">
                            ※承認したデータは編集不可となります。<br>
                            ※承認期限は、締め日(毎月10日)+1営業日後です。
                        </div>
                        <div class="float-right button-right">
                            <button class="btn btn-primary w-100 form-button font-weight-bold" disabled>承認</button>
                        </div>
                        <div style="clear: both"></div>
                    </div>


                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.check-all').click(function() {
            if ($('.check-one').length == $('.check-one:checked').length) {
                $('.check-one').prop('checked', false)
            } else {
                $('.check-one').prop('checked', true)
            }

            checkSubmit();
        });

        $('.check-one').click(function() {
            checkSubmit();
        })

        function checkSubmit() {
            if ($('.check-one:checked').length > 0) {
                $('.form-button').prop('disabled', false);
            } else {
                $('.form-button').prop('disabled', true);
            }
        }
    </script>
@endpush
