@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        
        .relative{
            position: relative;width: 187px;
        }
        .relative>input{
            cursor: pointer;
        }
         .relative>.input-group-append{
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            pointer-events: none;
        } 

        .flatpickr-input[readonly]{
            background: #fff;
            /* color: #fff; */
            
        }
        
        input::-webkit-input-placeholder {
            color: black;
            opacity: 0.5 !important;
        }

        /*----custom flatickr----*/
        .flatpickr-calendar.animate.open{
            width: 186px;
        }

        .flatpickr-time input.flatpickr-minute, .flatpickr-time input.flatpickr-hour{
            padding-left: 0 !important;
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
                                    <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date" placeholder="年-月-日" required data-toggle="datetimepicker" value="{{ request()->date ? request()->date : '' }}" id="date_readonly">
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
                                                <div class="input-group">
                                                    <div class="relative">
                                                        <input type="text" class="form-control chosen-select" name="start_time_first" placeholder="{{\Carbon\Carbon::parse(Auth::user()->start_time_working)->format('H:i')}}" readonly id="start_time_first">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-auto text-center span-date">~</div>
                                            <div class="select-time">
                                                <div class="input-group">
                                                    <div class="relative">
                                                        <input type="text" class="form-control chosen-select" name="end_time_first" placeholder="12:00" readonly id="end_time_first">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <div class="input-group">
                                                <div class="relative">
                                                    <input type="time" class="form-control chosen-select" name="start_time_second" placeholder="13:00" readonly id="start_time_second">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="m-auto text-center span-date">~</div>
                                            <div class="select-time">
                                                <div class="input-group">
                                                <div class="relative">
                                                    <input type="time" class="form-control chosen-select" name="end_time_second" placeholder="{{\Carbon\Carbon::parse(Auth::user()->end_time_working)->format('H:i')}}" readonly id="end_time_second">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                    </div>
                                                </div>
                                                </div>
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
                                                <div class="input-group">
                                                <div class="relative">
                                                    <input type="time" class="form-control chosen-select" name="start_time_third" placeholder="16:00" readonly id="start_time_third">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="text-center m-auto span-date">~</div>
                                            <div class="select-time">
                                                <div class="input-group">
                                                <div class="relative">
                                                    <input type="time" class="form-control chosen-select" name="end_time_third" placeholder="17:00" readonly id="end_time_third">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 text-center form-button">{{ (isset($infoRegister)) ? '更新(修正)' : '申請(登録)' }} </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ (isset($infoRegister) && !$infoRegister['disable']) ? $infoRegister['id'] : '' }}">
                </form>
            </div>
            <div class="w-410">
                <div class="row" id="div-null" style="height: 155px">
                    
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
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <input type="hidden" id="message" value="期間が無効になっている">
@push('scripts')
<script src="{{ asset('js/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/moment/moment-with-locales.min.js') }}"></script>
    <script>
        $('.chosen-select').on('select2:select', function (e) {
            if($(this).val() == 0 ) {
                $(this).val('').trigger('change');
            }
           
        });
        $('.form-button').click(e => {
            e.preventDefault();
            let time = $(`#result`).html();
            let date = $('input[name=date]').val();
            date=moment(new Date(date)).format('YYYY-mm-dd');
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

                $(`input[name=${index}]`).change(() => {
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
            // date = date.toLocaleDateString('fr-CA');
            date=moment(new Date(e.date)).format('YYYY-MM-DD');
            $('button').prop('disabled', false);

            if($('.form-button').html() == '承認済み') {
                $('.form-button').removeClass('btn-danger');
                $('.form-button').addClass('btn-primary');
                $('.form-button').html('申請(登録)');
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
                    $(`input[name=start_time_first]`).val(data.start_time_first).trigger('change');
                    $(`input[name=end_time_first]`).val(data.end_time_first).trigger('change');
                    $(`input[name=start_time_second]`).val(data.start_time_second).trigger('change');
                    $(`input[name=end_time_second]`).val(data.end_time_second).trigger('change');
                    $(`input[name=start_time_third]`).val(data.start_time_third).trigger('change');
                    $(`input[name=end_time_third]`).val(data.end_time_third).trigger('change');
                    $('.select-time input').prop('disabled', false);

                    let checkOverride = 0;
                    //approved
                    if(data.id) {
                        $('#message').val(objMessage.registered);
                        checkOverride = 1;
                    }

                     //outside
                    if(date < formDateCheck || date > toDateCheck) {
                        $('#message').val(objMessage.outside);
                    }

                    if (data.disable) {
                        $('.form-button').removeClass('btn-primary');
                        $('.form-button').addClass('btn-danger');
                        $('.form-button').html('承認済み');
                        $('.form-button, .select-time input').prop('disabled', true);  
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
                    startTime: $(`input[name=start_time_first]`).val(),
                    endTime: $(`input[name=end_time_first]`).val(),
                    id: 'time1',
                },
                {
                    startTime: $(`input[name=start_time_second]`).val(),
                    endTime: $(`input[name=end_time_second]`).val(),
                    id: 'time2',
                },
                {
                    startTime: $(`input[name=start_time_third]`).val(),
                    endTime: $(`input[name=end_time_third]`).val(),
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
            date=moment(new Date(date)).format('YYYY-MM-DD');

            if (date >= formDateCheck && date <= toDateCheck && $('.form-button').html() != '承認済み')
                disable = false;

            $('#notiDanger').html('');
            if(disable || checkOverride == 1)
               makeDangerAlert($('#message').val(), 'notiDanger');

            $('button').prop('disabled', disable);  

            $('#result').html(total);
        }

        function checkTimeStart() {
            var start1 = $(`input[name=start_time_first]`).val();
            var end1 = $(`input[name=end_time_first]`).val();
            var start2 = $(`input[name=start_time_second]`).val();
            var end2 = $(`input[name=end_time_second]`).val();
            var start3 = $(`input[name=start_time_third]`).val();
            var end3 = $(`input[name=end_time_third]`).val();

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
            format: "YYYY/MM/DD (dd)",
            locale: "ja",
            useCurrent: false,
            disabledDates: [
                @foreach ($listCalendar as $item)
                    moment("{{ $item->date }}"),
                @endforeach
            ],
        });

        $('#date_readonly').attr('autocomplete', 'off');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $('#start_time_first').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            defaultHour: '09',
            defaultMinute: '00',
            minTime: "{{\Carbon\Carbon::parse(Auth::user()->start_time_working)->format('H:i')}}",
            maxTime: "12:00",
        });

        $('#end_time_first').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            defaultHour: '12',
            defaultMinute: '00',
            minTime: "{{\Carbon\Carbon::parse(Auth::user()->start_time_working)->format('H:i')}}",
            maxTime: "12:00",
        });

        $('#start_time_second').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            defaultHour: '13',
            defaultMinute: '00',
            minTime: "13:00",
            maxTime: "{{\Carbon\Carbon::parse(Auth::user()->end_time_working)->format('H:i')}}",
        });

        $('#end_time_second').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            minTime: "13:00",
            maxTime: "{{\Carbon\Carbon::parse(Auth::user()->end_time_working)->format('H:i')}}",
        });

        $('#start_time_third').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            defaultHour: '20',
            defaultMinute: '00',
        });

        $('#end_time_third').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
        });
    </script>
@endpush
