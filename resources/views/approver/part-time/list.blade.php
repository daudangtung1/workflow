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
            width: 410px !important;
            min-width: 320px;
        }

        .w-150 {
            width: 150px !important;
        }

        .w-160 {
            width: 160px !important;
        }

        .w-140 {
            width: 140px !important;
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
            .button-right button {
                min-width: 100% !important;
            }
        }

        .vacation{
            background: #ffebeb;
        }
    </style>
@endpush
    <div class="card">
        <div class="card-body">
            {{--<form action="{{ route('approver.parttime.store') }}" method="POST">--}}
                {{--@csrf--}}
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
                                    <th class="w-150">日付</th>
                                    <th class="w-140">開始1</th>
                                    <th class="w-140">終了1</th>
                                    <th class="w-140">開始2</th>
                                    <th class="w-140">終了2</th>
                                    <th class="w-140">開始3</th>
                                    <th class="w-140">終了3</th>
                                    <th class="w-140">時間外計(分)</th>
                                    <th class="w-140">申請者(社員ID)</th>
                                    <th class="w-150">承認</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listRegister as $item)
                                @if(in_array($item['date'], $listCalendarData))
                                    <tr class="vacation">
                                        <td>{{ $item['date'] }}</td>
                                        <td>{{ $item['start_time1'] }}</td>
                                        <td>{{ $item['end_time1'] }}</td>
                                        <td>{{ $item['start_time2'] }}</td>
                                        <td>{{ $item['end_time2'] }}</td>
                                        <td>{{ $item['start_time3'] }}</td>
                                        <td>{{ $item['end_time3'] }}</td>
                                        <td>{{ $item['time'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>
                                            @if($item['approver'] != '')
                                                done
                                            @else
                                            <label class="custom-check">
                                                <input type="checkbox" name="id" class="check-one" value="{{ $item['id'] }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            @endif
                                        </td>
                                    </tr>
                                    @unset($item['date'])
                                @else
                                <tr>
                                        <td>{{ $item['date'] }}</td>
                                        <td>{{ $item['start_time1'] }}</td>
                                        <td>{{ $item['end_time1'] }}</td>
                                        <td>{{ $item['start_time2'] }}</td>
                                        <td>{{ $item['end_time2'] }}</td>
                                        <td>{{ $item['start_time3'] }}</td>
                                        <td>{{ $item['end_time3'] }}</td>
                                        <td>{{ $item['time'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>
                                            @if($item['approver'] != '')
                                                done
                                            @else
                                            <label class="custom-check">
                                                <input type="checkbox" name="id" class="check-one" value="{{ $item['id'] }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">{{ __('common.data.error') }}</td>
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
                            <button class="btn btn-primary w-100 form-button font-weight-bold" disabled id="update">承認</button>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>
            {{--</form>--}}
        </div>
    </div>
@push('scripts')
    <script src="{{asset('js/bootbox.min.js')}}"></script>
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

        $("#update").click(function(){
            bootbox.confirm({
                // title: "",
                message: "承認を取り消します。よろしいですか？",
                buttons: {
                cancel: {
                    label: "いいえ",
                },
                confirm: {
                    label: "はい",
                }
            },
                callback: function(result) {
                    if(result){
                        var id=[];
                        $('.custom-check input:checkbox[name=id]:checked').each(function(){
                            id.push($(this).val());
                        })
                        var url="{{route('approver.parttime.store')}}";

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: url,
                            method: "POST",
                            dataType: 'json',
                            data: {
                                _token:'{{ csrf_token() }}',
                                id: id,
                            },
                            success: function(data){
                                if(data.statusCode===200){
                                    $('.custom-check input:checkbox[name=id]').each(function(){
                                        if($(this).prop('checked')){
                                            $(this).parents('td').text('done').find('label').remove();
                                        }
                                    });
                                    bootbox.alert({
                                        message: "成功!",
                                        buttons: {
                                            ok: {
                                                label: '近い'
                                            }
                                        }
                                    });
                                }

                            },
                            error: function(data){
                                alert('error!');
                            }
                        });
                    }
                }
            });
        });

    </script>
@endpush
