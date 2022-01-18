@push('styles')
    <!-- daterange picker -->
    <style>
        .datepicker-days td.disabled2,
        .datepicker-days td.weekend {
            background: #FFD1D1 !important;
            border-radius: 50%;
        }

        .datepicker-days td.active {
            background: #007bff !important;
            border-radius: 0.25rem;
        }
    </style>
@endpush


        <div class="tab-content1 d-flex2">
            <div class="w-410 left-content">
                <form action="{{ route('staff-part-time.store') }}" class="frmSubmit" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12" id="notiDanger">

                        </div>
                    </div>
                    <div class="row ">
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
                                        <div class="col-md-12 d-flex1">
                                            <div class="select-time">
                                                <select class="chosen-select" name="start_time_first">
                                                    <option value=""></option>
                                                    <option value="0">&nbsp;</option>
                                                    @foreach ($times as $item)
                                                        <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                        <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="m-auto text-center span-date">~</div>
                                            <div class="select-time">
                                                <select class="chosen-select" name="end_time_first">
                                                    <option value=""></option>
                                                    <option value="0">&nbsp;</option>
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
                                        <div class="col-md-12 d-flex1">
                                            <div class="select-time">
                                                <select class="chosen-select" name="start_time_second">
                                                    <option value=""></option>
                                                    <option value="0">&nbsp;</option>
                                                    @foreach ($times as $item)
                                                        <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                        <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="m-auto text-center span-date">~</div>
                                            <div class="select-time">
                                                <select class="chosen-select" name="end_time_second">
                                                    <option value=""></option>
                                                    <option value="0">&nbsp;</option>
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
                                            <div class="select-time">
                                                <select class="chosen-select" name="start_time_third">
                                                    <option value=""></option>
                                                    <option value="0">&nbsp;</option>
                                                    @foreach ($times as $item)
                                                        <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                        <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="text-center m-auto span-date">~</div>
                                            <div class="select-time">
                                                <select class="chosen-select" name="end_time_third">
                                                    <option value=""></option>
                                                    <option value="0">&nbsp;</option>
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
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 text-center form-sbm form-button">{{ (isset($infoRegister)) ? '更新(修正)' : '申請(登録)' }} </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ (isset($infoRegister) && !$infoRegister['disable']) ? $infoRegister['id'] : '' }}">
                </form>
            </div>
            <div class="w-410">
                <div class="row" id="div-null" style="height: 47px">
                    
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
                        <form action="{{ route('staff-part-time.destroy', $infoRegister['id']) }}" class="frmDelete" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button class="btn btn-danger w-100 text-center form-button form-delete" type="button"> 削除</button>
                        </form>
                    </div>        
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <input type="hidden" id="message" value="期間が無効になっている">
@push('scripts')
    <script>
        $('.chosen-select').on('select2:select', function (e) {
            if($(this).val() == 0 ) {
                $(this).val('').trigger('change');
            }
           
        });
        
        $('.form-delete').click(() => {
            if(confirm('本当に削除しますか？')) {
                $('.frmDelete').submit();
            }
        })
        
        $('.form-sbm').click(e => {
            e.preventDefault();
            let time = $(`#result`).html();
            let date = $('input[name=date]').val();

            if(time*1 <= 0 || !date || !checkTimeStart()) {
                $('#notiDanger').html('');
                return makeDangerAlert('期間が無効になっている', 'notiDanger');
            }

            $('.frmSubmit').submit();
        })

        var arrName = {
            start_time_first: '09:00',
            end_time_first: '12:00',
            start_time_second: '13:00',
            end_time_second: '16:00',
            start_time_third: '16:00',
            end_time_third: '17:00',
        };

        var objMessage = {
            registered: '指定された日付に申請済みデータがあります。上書きしますか？ ',
            approved: '指定された日付にはすでに承認済みデータが存在するため、登録できません',
            outside: '申請可能期間外のため、登録できません',
        };

        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
        @php($date = \Carbon\Carbon::now()->day < 11 ? \Carbon\Carbon::now()->subMonth()->toDateString() : \Carbon\Carbon::now()->toDateString());
        var formDateCheck = '{{ \Carbon\Carbon::parse($date)->format("Y-m-11") }}';
        var toDateCheck = '{{ \Carbon\Carbon::parse($date)->addMonth()->format("Y-m-10") }}';

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
             $('.select-time .select2-selection__arrow').html('<i class="icofont-clock-time"></i>');
            //  $('#date').datetimepicker('minDate', new Date('{{ \Carbon\Carbon::now()->toDateString() }}'));
           
        });

        function resetForm() {
            $('#time1').html('');
            $('#time2').html('');
            $('#time3').html('');
            $('#result').html('');
        }

        //check register old date
        $("#date").on("change.datetimepicker", function(e) {
            let dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
            let date = new Date(e.date);

            date = date.toLocaleDateString('fr-CA');

            $('button').prop('disabled', false);

            if($('.form-sbm').html() == '承認済み') {
                $('.form-sbm').removeClass('btn-danger');
                $('.form-sbm').addClass('btn-primary');
                $('.form-sbm').html('更新(修正)');
            }

            if(date == 'Invalid Date')
                date = $('input[name=date]').val();

            if (dateNow > date)
                $('button').prop('disabled', true);

            // resetForm();
            $.ajax({
                url: "{{ route('staff-part-time.edit', 'info-register') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(data) {
                    $(`select[name=start_time_first]`).val(data.start_time_first).trigger('change');
                    $(`select[name=end_time_first]`).val(data.end_time_first).trigger('change');
                    $(`select[name=start_time_second]`).val(data.start_time_second).trigger('change');
                    $(`select[name=end_time_second]`).val(data.end_time_second).trigger('change');
                    $(`select[name=start_time_third]`).val(data.start_time_third).trigger('change');
                    $(`select[name=end_time_third]`).val(data.end_time_third).trigger('change');
                    $('.select-time select').prop('disabled', false);

                    let checkOverride = 0;
                    //approved
                    if(data.id && data.id != `{{ $infoRegister['id'] }}`) {
                        $('#message').val(objMessage.registered);
                        checkOverride = 1;
                    }

                     //outside
                    if(date < formDateCheck || date > toDateCheck) {
                        $('#message').val(objMessage.outside);
                    }

                    if (data.disable) {
                        $('.form-sbm').removeClass('btn-primary');
                        $('.form-sbm').addClass('btn-danger');
                        $('.form-sbm').html('承認済み');
                        $('.form-sbm, .select-time select').prop('disabled', true);  
                        $('#message').val(objMessage.approved);

                    }
                    caculate(checkOverride);
                }
            })
        });

        function caculate(checkOverride = 0) {
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
                    hours = hours / (1000 * 60);
                    total += hours;

                    $(`#${item.id}`).html(hours);
                }

            });

            let date = $('input[name=date]').val();

            if (date >= formDateCheck && date <= toDateCheck && $('.form-sbm').html() != '承認済み')
                disable = false;

            $('#notiDanger').html('');
            if(disable || checkOverride == 1)
               makeDangerAlert($('#message').val(), 'notiDanger');

            $('button').prop('disabled', disable);  

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
        $('.input-date').datetimepicker({
            format: "YYYY-MM-DD",
            locale: "ja",
            disabledDates: [
                @foreach ($listCalendar as $item)
                    moment("{{ $item->date }}"),
                @endforeach
            ],
        });
    </script>

@endpush