@push('styles')
    <!-- daterange picker -->
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .font-weight-normal {
            padding-top: 2px !important;
        }

        @media only screen and (max-width: 600px) {
            small {
                position: unset !important;
                display: block;
            }

            #div-null {
                display: none;
            }
        }

        small {
            position: absolute;
            margin-left: 5px;
            line-height: 35px;
            width: 100%;
        }

        #result {
            color: red;
            font-weight: bold
        }

        .time {
            font-weight: bold
        }

        .border-bot {
            border-bottom: 1px solid #dbdbdb;
        }

        .form-group .col-md-1 {
            margin: auto;
        }

    </style>
@endpush
<form class="formSm" method="POST">
    @csrf
    <div class="row pb-3">
        <div class="col-md-5 pr-5 mt-5 pl-5">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group select-time select-search">
                        <label for="">申請者ID</label>
                        <select class="chosen-select" name="user_register">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($staffs as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
                                    {{ $item->id . ' - ' . $item->fullName }}
                                </option>
                            @endforeach
                        </select>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>

                        <div class="input-group date input-date" id="date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                placeholder="年-月-日" required data-toggle="datetimepicker" value="{{ isset($infoRegister) ? $infoRegister['date'] : '' }}" />
                            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>

                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>申請時刻1</label>
                            <div class="row">
                                <div class="col-xl select-time">
                                    <select class="chosen-select" name="start_time_first">
                                        <option value=""></option>
                                        @foreach ($times as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="col-xl select-time">
                                    <select class="chosen-select" name="end_time_first">
                                        <option value=""></option>
                                        @foreach ($times as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-12">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>申請時刻2</label>
                            <div class="row">
                                <div class="col-xl select-time">
                                    <select class="chosen-select" name="start_time_second">
                                        <option value=""></option>
                                        @foreach ($times as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="col-xl select-time">
                                    <select class="chosen-select" name="end_time_second">
                                        <option value=""></option>
                                        @foreach ($times as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-12">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>申請時刻3</label>
                            <div class="row">
                                <div class="col-xl select-time">
                                    <select class="chosen-select" name="start_time_third">
                                        <option value=""></option>
                                        @foreach ($times as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="col-xl select-time">
                                    <select class="chosen-select" name="end_time_third">
                                        <option value=""></option>
                                        @foreach ($times as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group select-time select-search">
                        <label for="">申請者ID</label>
                        <select class="chosen-select" name="approver">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($approvers as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
                                    {{ $item->id . ' - ' . $item->fullName }}
                                </option>
                            @endforeach
                        </select>
                        <small></small>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>

                        <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#approval_date"
                                name="approval_date" placeholder="年-月-日" data-toggle="datetimepicker" value="" />
                            <div class="input-group-append" data-target="#approval_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>

                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>

                <div class="col-md-12">
                    <div class="form-group select-time">
                        <label for="">総務確認</label>
                        <select class="chosen-select" name="manager_status_edit">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach (\App\Enums\ManagerStatus::asArray() as $item)
                                <option value="{{ $item }}">
                                    {{ \App\Enums\ManagerStatus::getDescription($item) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4 mt-5">
            <div class="row" id="div-null">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">&nbsp</label>
                        <div style="height: calc(1.6em + 0.75rem + 2px)"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group border-bot">
                        <label for="">&nbsp</label><br>
                        <div style="height: calc(1.6em + 0.75rem + 2px)">
                            <span class="ml-2 mt-1">
                                <span>勤務時間1(分)</span>
                                <span class="float-right"><span id="time1" class="h4"></span>
                                    分</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group border-bot">
                        <label for="">&nbsp</label><br>
                        <div style="height: calc(1.6em + 0.75rem + 2px)">
                            <span class="ml-2 mt-1">
                                <span>勤務時間2(分)</span>
                                <span class="float-right"><span id="time2" class="h4"></span>
                                    分</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group border-bot">
                        <label for="">&nbsp</label><br>
                        <div style="height: calc(1.6em + 0.75rem + 2px)">
                            <span class="ml-2 mt-1">
                                <span>勤務時間3(分)</span>
                                <span class="float-right"><span id="time3" class="h4"></span>
                                    分</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="form-group border-bot">
                        <div style="height: calc(1.6em + 0.75rem + 2px)">
                            <span class="ml-2 mt-1">
                                <span>合計</span>
                                <span class="float-right"><span id="result" class="h4"></span>
                                    分</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 mt-3  pr-5 pl-5"><button disabled
                class="btn btn-primary w-100 form-button form-button-edit"><b>更新</b></button></div>
        <div class="col-md-1"></div>
        <div class="col-md-5 mt-3  pr-5 pl-5">
            <button class="btn btn-primary w-100 form-button form-button-delete" disabled><b>削除</b></button>
        </div>
    </div>
    <input type="hidden" name="id">

</form>

@push('scripts')
    <script>
        $('.form-button-edit').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.part_time.update_info', 'update') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
            $('.formSm').submit();
        });

        $('.form-button-delete').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.part_time.destroy', 'delete') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
            $('.formSm').submit();
        })

        $('select[name=user_register]').change(function() {
            let name = $('select[name=user_register] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('select[name=approver]').change(function() {
            let name = $('select[name=approver] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('#approval_date').datetimepicker();

        $('#date').datetimepicker({
            useCurrent: false,
            format: "YYYY-MM-DD",
            locale: "ja",
            daysOfWeekDisabled: [0, 6],
        });

        //////
        var arrName = {
            start_time_first: '09:00',
            end_time_first: '12:00',
            start_time_second: '13:00',
            end_time_second: '16:00',
            start_time_third: '16:00',
            end_time_third: '17:00',
        };

        $(document).ready(function() {
            for (const [index, item] of Object.entries(arrName)) {
                $(`select[name=${index}]`).select2({
                    placeholder: item,
                    allowClear: true,
                });

                $(`select[name=${index}]`).change(() => {
                    caculate();
                });
            }
             $('.select-time .select2-selection__arrow').html('<i class="far fa-clock"></i>');
            //  $('#date').datetimepicker('minDate', new Date('{{ \Carbon\Carbon::now()->toDateString() }}'));
           
        });

        function resetForm() {
            $('#time1').html('');
            $('#time2').html('');
            $('#time3').html('');
            $('#result').html('');
        }


        function caculate() {
            resetForm();
            let disable = true; 
            let total = 0;

            let arrTime = [{
                    startTime: $(`select[name=start_time_first]`).val(),
                    endTime: $(`select[name=end_time_first]`).val(),
                    id: 'time1',
                },
                {
                    startTime: $(`select[name=start_time_second]`).val(),
                    endTime: $(`select[name=end_time_second]`).val(),
                    id: 'time2',
                },
                {
                    startTime: $(`select[name=start_time_third]`).val(),
                    endTime: $(`select[name=end_time_third]`).val(),
                    id: 'time3',
                }
            ];

            let totalTime = arrTime.forEach((item) => {
                var startTime = item.startTime;
                var endTime = item.endTime;

                if (startTime != '' && endTime != '' && startTime <= endTime) {
                    date1 = new Date("01/01/2007 " + startTime);
                    date2 = new Date("01/01/2007 " + endTime);
                    let hours = Math.abs(date2 - date1);
                    hours = hours / (1000 * 60 * 60);
                    total += hours;

                    $(`#${item.id}`).html(hours);
                }

            });
            let id = $('input[name=id]').val();

            if (total > 0 && id)
                disable = false;

            $('.form-button').prop('disabled', disable);  

            $('#result').html(total);
        }


    </script>
@endpush
