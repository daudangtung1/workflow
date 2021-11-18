@extends('approver.app')

@section('active_overtime', 'active')

@section('content_header')
    <li class="breadcrumb-item active"><b>時間外･交通費申請</b></li>
@endsection

@push('styles')
    <style>
        table a {
            color: #000 !important;
        }

        table thead {
            background: #E8EDF4;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px
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
                    <div class="col-md-12 overflow-auto mt-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>日付</th>
                                    <th>開始時刻</th>
                                    <th>終了時刻</th>
                                    <th>時間外計(分)</th>
                                    <th>申請者(社員ID)</th>
                                    <th>承認</th>
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
                    <div class="col-md-12">
                        <span>
                            ※承認したデータは編集不可となります。<br>
                            ※承認期限は、締め日(毎月10日)+1営業日後です。
                        </span>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4"><button class="btn btn-primary w-100 form-button"
                                    disabled>承認</button></div>
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
