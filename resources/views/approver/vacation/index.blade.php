@extends('approver.app')

@section('active_vacation', 'active')
@section('title', '全てチェック')

@section('content_header')
    <li class="breadcrumb-item active"><b>全てチェック</b></li>
@endsection

@push('styles')
    <style>

        input[type="checkbox"] {
            width: 22px;
            height: 22px;
            border: 1px solid #C2C7D0;
        }

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
        }

        .w-150 {
            width: 150px !important;
        }

        .w-160 {
            width: 160px !important;
        }

        .w-795 {
            width: 795px !important;
        }

        .w-140 {
            width: 140px !important;
        }


    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('approver.vacation.store') }}" method="POST">
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
                    <div class="col-md-12 overflow-auto mb-0">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="w-150">日付(開始)</th>
                                    <th class="w-160">日付(終了)</th>
                                    <th class="w-160">種別</th>
                                    <th class="w-795">理由</th>
                                    <th class="w-140">申請者(社員ID)</th>
                                    <th class="w-150">承認</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listVacation as $item)
                                    <tr>
                                        <td>{{ $item['start_date'] }}</td>
                                        <td>{{ $item['end_date'] }}</td>
                                        <td>{{ $item['type'] }}</td>
                                        <td>{{ $item['reason'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td><input type="checkbox" name="id[]" class="check-one"
                                                value="{{ $item['id'] }}"></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('common.data.error') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="note">
                            ※承認したデータは編集不可となります。<br>
                            ※承認期限は、締め日(毎月10日)+1営業日後です。
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7"><button class="btn btn-primary w-100 form-button font-weight-bold"
                                    disabled>承認</button>
                            </div>
                        </div>
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
