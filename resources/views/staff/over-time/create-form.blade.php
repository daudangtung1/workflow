@push('styles')
<link rel="stylesheet" href="{{asset('css/timepicki/timepicki.css')}}">
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

    .relative {
        position: relative;
    }

    .select-time {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .select-time input {
        width: 335px;
    }

    .select-time .form-control[readonly] {
        background: #fff;
    }

    .relative .input-group-append {
        position: absolute;
        top: 0;
        left: calc(335px - 57px);
        height: 46px;
        pointer-events: none;
    }

    /*----custom timepicki----*/
    input.timepicki-input {
        width: 70% !important;
        padding-left: 2px !important;
    }

    input.timepicki-input:focus {
        outline: none;
    }

    .prev,
    .next {
        position: relative;
        background: none !important;
    }

    .prev::after {
        font-family: 'IcoFont';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        content: "\ea6a";
        font-size: 16px;
    }

    .next::after {
        font-family: 'IcoFont';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        content: "\ea67";
        font-size: 16px;
    }

    .mi_tx input {
        pointer-events: none !important;
    }
</style>
@endpush
<div class="tab-content1 d-flex2">
    <div class="w-410 left-content">
        <form action="{{ route('staff-over-time.store') }}" class="frmSubmit" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12" id="notiDanger">

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>

                        <div class="input-group date input-date" id="date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date" placeholder="年-月-日" required data-toggle="datetimepicker" value="{{ request()->date ? request()->date : '' }}" autocomplete="off" />
                            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="icofont-calendar"></i></div>
                            </div>
                        </div>

                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>開始時刻</label>
                        <div class="row">
                            <div class="col">
                                <div class="select-time relative">
                                    <input type="text" class="form-control chosen-select" name="start_time" id="start_time">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                    </div>
                                    <span class="ml-11">
                                        30分単位
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>終了時刻</label>
                        <div class="row">
                            <div class="col">
                                <div class="select-time relative end_time_form">
                                    <input type="text" class="form-control chosen-select" name="end_time" id="end_time">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                    </div>
                                    <span class="ml-11">
                                        30分単位
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ (isset($infoRegister) && !$infoRegister['disable']) ? $infoRegister['id'] : '' }}">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary w-100 text-center form-button"> 申請(登録)</button>
                </div>
            </div>
            <input type="hidden" name="start_time_working" value="{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}">
            <input type="hidden" name="end_time_working" value="{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}">
        </form>
    </div>
    <div class="w-410">
        <div class="row hide-mobile" style="height: 158px">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group border-bot min-text">
                    <div>
                        <span class="min-text">業前作業時間（~<span id="start_time_working">{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}</span>）</span>
                        <span class="float-right"><span id="before_start" class="result-text"></span>
                            分</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group border-bot mt-56 min-text">
                    <div>
                        <span class="min-text">業後作業時間（<span id="end_time_working">{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}</span>~）</span>
                        <span class="float-right"><span id="after_end" class="result-text"></span>
                            分</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group  mt-56 ">
                    <div>
                        <span class="min-text">時間外勤務計</span>
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
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script src="{{asset('js/timepicki/timepicki.js')}}"></script>
<script src="{{ asset('js/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/moment/moment-with-locales.min.js') }}"></script>
<script>
        var date_auth_start=new Date("01/01/2007 " + "{{Auth::user()->start_time_working}}").getHours();
        $("#start_time").timepicki({
            step_size_minutes: 30,
            show_meridian: false,
            min_hour_value: 0,
            max_hour_value: date_auth_start,
            start_time: ["00", "00"],
        });

        var date_auth_end=new Date("01/01/2007 " + "{{Auth::user()->end_time_working}}").getHours();
        $('#end_time').timepicki({
            step_size_minutes: 30,
            show_meridian: false,
            min_hour_value: date_auth_end,
            max_hour_value: 23,
            start_time: ["17", "30"],
        });

        $('#end_time_form').datetimepicker();
</script>
<script>
    $('.chosen-select').on('select2:select', function(e) {
        if ($(this).val() == 0) {
            $(this).val('').trigger('change');
        }
    });
    $('.form-button').click(e => {
        e.preventDefault();
        let time = $(`#result`).html();
        let date = $('input[name=date]').val();

        if (time * 1 <= 0 || !date) {
            $('#notiDanger').html('');
            return makeDangerAlert('期間が無効になっている', 'notiDanger');
        }

        $('.frmSubmit').submit();
    });


    var objMessage = {
        registered: '指定された日付に申請済みデータがあります。上書きしますか？ ',
        approved: '指定された日付にはすでに承認済みデータが存在するため、登録できません',
        outside: '申請可能期間外のため、登録できません',
    };

    var arrName = {
        start_time: '07:00',
        end_time: '17:30',
    };

    var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
    @php($date = \Carbon\Carbon::now()-> day < 11 ? \Carbon\Carbon::now()->subMonth()-> toDateString() : \Carbon\Carbon::now()-> toDateString());
    var formDateCheck = '{{ \Carbon\Carbon::parse($date)->format("Y-m-11") }}';
    var toDateCheck = '{{ \Carbon\Carbon::parse($date)->addMonth()->format("Y-m-10") }}';

    $(document).ready(function() {
        for (const [index, item] of Object.entries(arrName)) {
            $(`select[name=${index}]`).select2({
                placeholder: item,
                allowClear: true,
            });
        }
        $('.select-time .select2-selection__arrow').html('<i class="icofont-clock-time"></i>');
    });

    $("#date").on("change.datetimepicker", function(e) {
        let date = new Date(e.date);
        date = date.toLocaleDateString('fr-CA');

        if (date == 'Invalid Date')
            date = $('input[name=date]').val();

        if ($('.form-button').html() == '承認済み') {
            $('.form-button').removeClass('btn-danger');
            $('.form-button').addClass('btn-primary');
            $('.form-button').html('申請(登録');
        }

        let startTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}";
        let endTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}";

        $.ajax({
            url: "{{ route('staff-over-time.edit', 'info-register') }}",
            type: 'get',
            dataType: 'json',
            data: {
                date: date,
            },
            success: function(data) {
                // setSelectTime(data.time);

                if (data.start_time_working)
                    startTimeWorking = data.start_time_working;

                if (data.end_time_working)
                    endTimeWorking = data.end_time_working;


                $(`input[name=start_time]`).val(data.start_time).trigger('change');
                $(`input[name=end_time]`).val(data.end_time).trigger('change');
                $('.select-time select').prop('disabled', false);

                $(`input[name=start_time_working]`).val(startTimeWorking);
                $(`input[name=end_time_working]`).val(endTimeWorking);

                $('#start_time_working').html(startTimeWorking);
                $('#end_time_working').html(endTimeWorking);

                $('#message').val('期間が無効になっている');

                let checkOverride = 0;
                //approved
                if (data.id) {
                    $('#message').val(objMessage.registered);
                    checkOverride = 1;
                }

                //outside
                if (date < formDateCheck || date > toDateCheck) {
                    $('#message').val(objMessage.outside);
                }

                if (data.disable) {
                    $('.form-button').removeClass('btn-primary');
                    $('.form-button').addClass('btn-danger');
                    $('.form-button').html('承認済み');
                    $('.form-button, .select-time select').prop('disabled', true);
                    $('#message').val(objMessage.approved);
                }

                caculate(checkOverride);
            }
        })
    });

    function resetForm() {
        $('#before_start').html('');
        $('#after_end').html('');
        $('#result').html('');
    }

    $("input[name=start_time]").change(function() {
        return caculate();
    })

    $("input[name=end_time]").change(function() {
        return caculate();
    });

    function caculate(checkOverride = 0) {
        resetForm();
        let disable = true;
        let totalTime = 0;
        
        
        $(document).click(function(e){
            let disable = true;
            let totalTime = 0;

            let startTime = $(`input[name=start_time]`).val();
            let startTimeWorking = $(`input[name=start_time_working]`).val();
            let endTime = $(`input[name=end_time]`).val();
            let endTimeWorking = $(`input[name=end_time_working]`).val();

            if (startTime != '') {
                let timeCheckStart=new Date("01/01/2007 " + "{{Auth::user()->start_time_working}}");
                let hourCheckStart=timeCheckStart.getHours();

                let timeInputStart = new Date('01/01/2007 ' + startTime);

                if(startTime > startTimeWorking) {
                    timeInputStart = timeCheckStart;
                    startTime = timeInputStart.getHours() + ':' + timeInputStart.getMinutes();
                    $(`input[name=start_time]`).val((timeInputStart.getHours() >= 10 ? timeInputStart.getHours() : '0' + timeInputStart.getHours()) + ':' + (timeInputStart.getMinutes() >=10 ? timeInputStart.getMinutes() : '0' + timeInputStart.getMinutes()));
                }

                date1 = new Date("01/01/2007 " + startTime);
                date2 = new Date("01/01/2007 " + startTimeWorking);
                let hours = Math.abs(date2 - date1);
                hours = hours / (1000 * 60);
                totalTime = +hours;
                $('#before_start').html(hours);
            } 

            if (endTime != '') {
                let timeCheck=new Date("01/01/2007 " + "{{Auth::user()->end_time_working}}");
                let hourCheck=timeCheck.getHours();

                let timeInput = new Date('01/01/2007 ' + endTime);
                let hourInput=timeInput.getHours();
                let minuteInput=timeInput.getMinutes();

                if(endTime < endTimeWorking) {
                    timeInput = timeCheck;
                    endTime = timeInput.getHours() + ':' + timeInput.getMinutes();
                    $(`input[name=end_time]`).val((timeInput.getHours() >= 10 ? timeInput.getHours() : '0' + timeInput.getHours()) + ':' + (timeInput.getMinutes() >=10 ? timeInput.getMinutes() : '0' + timeInput.getMinutes()));
                }
                date1 = new Date("01/01/2007 " + endTime);
                date2 = new Date("01/01/2007 " + endTimeWorking);
                let hours = Math.abs(date2 - date1);
                hours = hours / (1000 * 60);
                totalTime = +hours;
                $('#after_end').html(hours);
            }

            let date_input = $('input[name=date]').val();
            let date=moment(new Date(date_input)).format('YYYY-MM-DD');
            if (date >= formDateCheck && date <= toDateCheck && $('.form-button').html() != '承認済み')
                disable = false;
            $('#notiDanger').html('');
            if (disable || checkOverride == 1) makeDangerAlert($('#message').val(), 'notiDanger');

            $('.form-button').prop('disabled', disable);
            var input_1=parseInt($('#before_start').html());
            var input_2=parseInt($('#after_end').html());
            $('#result').html((input_1 ? input_1 : 0) + (input_2 ? input_2 : 0));
		});
    }

    // function setSelectTime (data) {
    //             $('input[name=start_time]').empty();
    //             $('select[name=start_time]').append($('<option>').attr('value', '')
    //                 .text(''));
    //             $('input[name=start_time]').append($('<option>').attr('value', '0')
    //                 .text('\u00A0'));

    //             $.each(data.start, function(key, item) {
    //                 let time = item['hour'] + ':' + item['minutes']['00'];
    //                 $('input[name=start_time]').append($('<option>').attr('value', time)
    //                     .text(time))

    //                 if (item['minutes']['30']) {
    //                     let time = item['hour'] + ':' + item['minutes']['30'];
    //                     $('input[name=start_time]').append($('<option>').attr('value',
    //                         time).text(time))
    //                 }
    //             });

    //             $('input[name=start_time]').trigger('change');

    //             $(`input[name=start_time]`).select2({
    //                 placeholder: '07:00',
    //                 allowClear: true,
    //             });

    //             //end time
    //             $('input[name=end_time]').empty();
    //             $('select[name=end_time]').append($('<option>').attr('value', '')
    //                 .text(''));

    //             $('select[name=end_time]').append($('<option>').attr('value', '0')
    //                 .text('\u00A0'));

    //             $.each(data.end, function(key, item) {
    //                 if (item['minutes']['00']) {
    //                     let time = item['hour'] + ':' + item['minutes']['00'];
    //                     $('select[name=end_time]').append($('<option>').attr('value', time)
    //                         .text(time))
    //                 }

    //                 let time = item['hour'] + ':' + item['minutes']['30'];
    //                 $('select[name=end_time]').append($('<option>').attr('value', time)
    //                     .text(time))
    //             });

    //             $('select[name=end_time]').trigger('change');

    //             $(`select[name=end_time]`).select2({
    //                 placeholder: '17:30',
    //                 allowClear: true,
    //             });
    //             $('.select-time .select2-selection__arrow').html('<i class="icofont-clock-time"></i>');
    // }
    $('.input-date').datetimepicker({
        format: "YYYY/MM/DD (dd)",
        locale: "ja",
        useCurrent: false,
        disabledDates: [
            @foreach($listCalendar as $item)
            moment("{{ $item->date }}"),
            @endforeach
        ],
        daysOfWeekDisabled: [0, 6],
    });
</script>
@endpush