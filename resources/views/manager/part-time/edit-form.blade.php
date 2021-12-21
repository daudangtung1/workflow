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
            font-size: 14px;
            line-height: 46px;
            font-weight: 400;
            color: #1F232E;
            width: 100%;
            margin-left: 15px;
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

        .form-button-delete {
            margin-top: 287px !important;
        }

        .left-content {
            margin-right: 290px !important;
        }

        @media only screen and (max-width: 1450px) {
            .left-content {
                margin-right: 150px !important;
            }
        }

        @media only screen and (max-width: 1300px) {
            .tab-content1 .left-content {
                margin-right: 150px !important;
            }
        }

        @media only screen and (max-width: 1023px) {
            small {
                position: unset !important;
                display: block;
                margin-left: 0 !important;
                line-height: 24px !important;
            }
            #div-null {
                display: none;
            }
            .form-button-delete {
                margin-top: 50px !important;
            }

        }

        .pb-71 {
            padding-bottom: 71px !important;
        }

    </style>
@endpush
<form class="formSm" method="POST">
    @csrf
    
            <div class="tab-content1 pb-71 d-flex2">
                <div class="w-410 left-content">
                    <div class="row">
                        <div class="col-md-12" id="notiDanger">

                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="select-time select-search select-100">
                                    <label for="">申請者ID</label>
                                    <select class="chosen-select" name="user_register">
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
                    </div>
                        <div class="row mt-30">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">日付</label>
                                    <div class="input-group date input-date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                            placeholder="年-月-日" required data-toggle="datetimepicker" value="{{ request()->date ? request()->date : '' }}" />
                                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="icofont-calendar"></i></div>
                                        </div>
                                    </div>
        
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                        </div>
        
                        <div class="row ">
                            <div class="col-md-12 mt-30">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>申請時刻1</label>
                                        <div class="row">
                                            <div class="col-md-12 d-flex1 select1">
                                          
                                                <div class="select-time  select-min ">
                                                    <select class="chosen-select" name="start_time_first">
                                                        <option value=""></option>
                                                        @foreach ($times as $item)
                                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="m-auto text-center">~</div>
                                                <div class="select-time  select-min">
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
                                        @error('end_time_first')
                                            <div>{{ $message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-12 mt-30">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>申請時刻2</label>
                                        <div class="row">
                                            <div class="col-md-12 d-flex1 select1">
                                                <div class="select-time select-min">
                                                    <select class="chosen-select" name="start_time_second">
                                                        <option value=""></option>
                                                        @foreach ($times as $item)
                                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="m-auto text-center">~</div>
                                                <div class="select-time select-min">
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
                            </div>
                        
                            <div class="col-md-12 mt-30">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>申請時刻3</label>
                                        <div class="row">
                                            <div class="col-md-12 d-flex1">
                                                <div class="select-time select-min select1">
                                                    <select class="chosen-select" name="start_time_third">
                                                        <option value=""></option>
                                                        @foreach ($times as $item)
                                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="text-center m-auto">~</div>
                                                <div class="select-time select-min">
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
                          
                        
                            <div class="col-md-12 mt-30">
                                <div class="form-group">
                                    <div class="select-time select-search select-100">
                                        <label for="">承認者ID</label>
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
                            </div>
                            <div class="col-md-12 mt-30">
                                <div class="form-group">
                                    <label for="">承認状態</label>
            
                                    <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#approval_date"
                                            name="approval_date" placeholder="年-月-日" data-toggle="datetimepicker" value="" />
                                        <div class="input-group-append" data-target="#approval_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                            <div class="col-md-12 mt-30">
                                <div class="form-group">
                                    <div class="select-time select-100">
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
                            <div class="col-md-12">
                                <button class="btn btn-primary w-100 form-button form-button-edit" disabled>更新</button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ (isset($infoRegister) && !$infoRegister['disable']) ? $infoRegister['id'] : '' }}">
                </div>
                <div class="w-410">
                    <div class="row" id="div-null" style="height: 257px">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group border-bot">
                                <div >
                                        <span class="min-text">勤務時間1(分)</span>
                                        <span class="float-right right-text"><span id="time1" class="result-text"></span>
                                            分</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group border-bot mt-62">
                                <div >
                                        <span class="min-text">勤務時間2(分)</span>
                                        <span class="float-right right-text"><span id="time2" class="result-text"></span>
                                            分</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group border-bot  mt-62">
                                <div >
                                        <span class="min-text">勤務時間3(分)</span>
                                        <span class="float-right right-text"><span id="time3" class="result-text"></span>
                                            分</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-65">
                                <div >
                                        <span class="min-text">合計</span>
                                        <span class="float-right"><span id="result" class="result-text"></span>
                                            分</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 form-button form-button-delete" disabled><b>削除</b></button>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
       
    <input type="hidden" name="id">

</form>

@push('scripts')
    <script>
        
        $('.form-button-edit').click(function(e) {
            let formData = new FormData($('.formSm')[0]);
            let time = $(`#result`).html();

            if(time*1 <= 0 || !checkTimeStart()) {
                e.preventDefault();
                $('#notiDanger').html('');
                return makeDangerAlert('期間が無効になっている', 'notiDanger');
            }

            if (confirm('すでに”登録されたデータがあります。上書き更新してもよろしいですか？')) {
                $('.formSm').attr({
                    method: 'POST',
                    action: '{{ route('manager.part_time.update_info', 'update') }}'
                });
                $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
                $('.formSm').submit();
            } else {
                e.preventDefault();
            }
        });

        $('.form-button-delete').click(function(e) {
            let formData = new FormData($('.formSm')[0]);

            if (confirm('対象日付の申請データを削除します。よろしいですか？')) {
                $('.formSm').attr({
                    method: 'POST',
                    action: '{{ route('manager.part_time.destroy', 'delete') }}'
                });
                $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
                $('.formSm').submit();
            } else {
                e.preventDefault();
            }
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

        $('#approval_date').datetimepicker({
            format: false,
            locale: 'ja',
            icons: {
                time: 'far fa-clock',
            },
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
             $('.select-min .select2-selection__arrow').html('<i class="icofont-clock-time""></i>');
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
            $('#notiDanger').html('');
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
                    hours = hours / (1000 * 60);
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

        function checkTimeStart() {
            var start1 = $(`select[name=start_time_first]`).val();
            var end1 = $(`select[name=end_time_first]`).val();
            var start2 = $(`select[name=start_time_second]`).val();
            var end2 = $(`select[name=end_time_second]`).val();
            var start3 = $(`select[name=start_time_third]`).val();
            var end3 = $(`select[name=end_time_third]`).val();

            let check = true;

            if(start1 > end1 || start2 > end2 || start3 > end3) {
                check = false;
            }

            if(start2 < end1 && end1 != '' && start2 != '') {
                check = false;

            }

            if(start3 < end2 && end2 != '' && start3 != '') {
                check = false;
            }

            if(start3 < end1 && end1 != '' && start3 != '') {
                check = false;
            }

           return check;
        }

    </script>
@endpush
