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

        .select-time .select2-selection {
            height: 46px !important;
        }

        .select-time .select2-selection__rendered {
            line-height: 40px !important;
        }

        .select-time .select2-selection__arrow {
            height: 46px !important;
            line-height: 30px !important;
            width: 56px !important;
            border-radius: 0 0.25rem 0.25rem 0 !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            right: 0px !important;
            top: 0;
            border-radius: 0 0.25rem 0.25rem 0 !important;
            border: 1px solid #ced4da !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder,
        .select2-search__field {
            font-size: 16px !important;
        }

        .pb-20 {
            padding-bottom: 20px;
        }

        .mt-20 {
            padding-top: 20px;
            font-size: 14px;
            color: #000000;
            font-weight: 400;
        }

        input[readonly] {
            background: #ffffff !important;
        }

        .w-140{
            /* width: unset !important; */
        }

        .relative{
            position: relative;
        }

        .relative>div{
            position: absolute;
            top: 0;
            right: 0;
            pointer-events: none;
            height: 100%;
        }
        .relative>div i{
            font-size: 20px;
        }

        .relative>div>div{
            border-radius: 0 5px 5px 0 !important;
        }

        .form_time{
            width: 205px;
        }

        .form_time:nth-child(3), .form_time:nth-child(5){
            position: relative;
            
        }

        .hidden{
            display: none;
        }

        /*----custom flatickr----*/
        .flatpickr-calendar.animate.open{
            width: 140px;
        }

        .flatpickr-time input.flatpickr-minute, .flatpickr-time input.flatpickr-hour{
            padding-left: 0 !important;
        }

        .form_time:nth-child(2) .form-group, .form_time:nth-child(4) .form-group{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form_time .w-140{
            width: 135px;
        }
        .form_time label{
            margin-bottom: 0 !important;
        }

        #start_time_1::placeholder, #end_time_1::placeholder, #start_time_2::placeholder, #end_time_2::placeholder{
            opacity: 0.5;
        }

        #start_date, #end_date{
            width: 220px;
        }

    </style>
@endpush


<div class="tab-content1">
    <form
        action="{{ isset($infoVacation) ? route('staff-vacation.update', $infoVacation['id']) : route('staff-vacation.store') }}"
        method="POST">
        @csrf
        @if (isset($infoVacation))
            <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="w-410" id="notiDanger"></div>
            </div>
            <div class="col-md-12">
                <label for="">日付</label>
                <div class="form-group ">
                    <div class=" input-group date input-date d-inlin-flex col-mobile-date" id="start_date"
                        data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#start_date"
                            name="start_date" placeholder="年-月-日" required data-toggle="datetimepicker"
                            value="{{ isset($infoVacation) ? $infoVacation['start_date'] : '' }}" />
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="icofont-calendar"></i></div>
                        </div>
                    </div>
                    <div class="text-center span-date col-mobile">~</div>
                    <div class="input-group date input-date d-inlin-flex col-mobile-date" id="end_date"
                        data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#end_date"
                            name="end_date" placeholder="年-月-日" required data-toggle="datetimepicker" value="{{ isset($infoVacation) ? $infoVacation['end_date'] : '' }}" />
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="icofont-calendar"></i></div>
                        </div>
                    </div>

                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="col-md-12 mt-30">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="w-auto1">
                            <label class="d-block" for="">休暇種別</label>
                            <table>
                                @php($i = 0)
                                @foreach (collect(\App\Enums\VacationType::asArray())->chunk(3)->all() as $chunk)
                                    @php($i++)

                                    @if ($i <= 2)
                                        </tr>
                                        @foreach ($chunk as $item)
                                            <td class="pr-4 pb-20">
                                                <div class="col-radio d-radio col-mobile">
                                                    <input type="radio" id="day{{ $item }}" name="type" required
                                                        value="{{ $item }}"
                                                        {{ !isset($infoVacation) && \App\Enums\VacationType::FULL_DAY == $item ? 'checked' : '' }}
                                                        {{ isset($infoVacation) && $infoVacation['type'] == $item ? 'checked' : '' }}>
                                                    <label for="day{{ $item }}">
                                                        {{ \App\Enums\VacationType::getDescription($item) }}
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach
                                        <tr>
                                        @else
                                        <tr>
                                        @if(Auth::user()->type==\App\Enums\UserType::FULLTIME)
                                            <td class="pr-4 ">
                                                <div class="col-radio d-radio col-mobile">
                                                    <input type="radio" id="vacation" name="type" value="vacation"
                                                        required
                                                        {{ isset($infoVacation) && $infoVacation['type'] > 6 ? 'checked' : '' }}>
                                                    <label for="vacation">
                                                        欠勤
                                                    </label>
                                                </div>
                                            </td>
                                            
                                            <td class="pr-4-fix form_time time_1 hidden">
                                                <div class="form-group">
                                                    <label>時刻1</label>
                                                    <div class="relative w-140">
                                                        <input type="time" name="start_time_1" class="form-control" value="{{ isset($infoVacation) ? $infoVacation['start_time_1'] : '' }}" id="start_time_1" placeholder="09:00" maxlength="2">  
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                        </div>
                                                    </div>
                                                    <span>~</span>
                                                </div>
                                            </td>
                                            <td class="pr-4-fix form_time time_1 hidden">
                                                <div class="form-group">
                                                    <div class="relative w-140">
                                                        <input type="time" name="end_time_1" class="form-control" value="{{ isset($infoVacation) ? $infoVacation['end_time_1'] : '' }}" id="end_time_1" placeholder="12:00" maxlength="2"> 
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                        </div>
                                                    </div>
                                                    <span> </span>
                                                </div>
                                            </td>
                                            <td class="pr-4-fix form_time time_2 hidden">
                                                <div class="form-group">
                                                    <label>時刻2</label>
                                                    <div class="relative w-140">
                                                        <input type="time" name="start_time_2" class="form-control" value="{{ isset($infoVacation) ? $infoVacation['start_time_2'] : '' }}" id="start_time_2" placeholder="13:00" maxlength="2"> 
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                        </div>
                                                    </div>
                                                    <span>~</span>
                                                </div>
                                            </td>
                                            <td class="pr-4-fix form_time time_2 hidden">
                                                <div class="form-group">
                                                    <div class="relative w-140">
                                                    <input type="time" name="end_time_2" class="form-control" value="{{ isset($infoVacation) ? $infoVacation['end_time_2'] : '' }}" id="end_time_2" placeholder="17:30" maxlength="2"> 
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                                        </div>
                                                    </div>
                                                    <span> </span>
                                                </div>
                                            </td>
                                        @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-30">
                <label class="d-block" for="">理由</label>
                <textarea class="form-control w-410" name="reason" id="reason" rows="5"
                    required>{{ isset($infoVacation) ? $infoVacation['reason'] : '' }}</textarea>
            </div>

            <div class="col-md-12">
                @if (isset($infoVacation) && $infoVacation['disable'])
                    <button class="btn btn-danger w-100  w-410" disabled>承認済み</button>
                @else
                    <button class="btn btn-primary w-100 form-sbm form-button  w-410" style="margin-right: 90px">更新(修正)</button>
                @endif
                <button type="button" class="btn btn-danger w-100 form-delete form-button  w-410">削除</button>
            </div>
        </div>
    </form>
</div>
<form
        action="{{ route('staff-vacation.destroy', $infoVacation['id']) }}" class="frmDelete"
        method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    </form>

@push('scripts')
    <script>
        $('.chosen-select').select2();
        $('.form-delete').click(() => {
            if(confirm('本当に削除しますか？')) {
                $('.frmDelete').submit();
            }
        });
        // $('input[name=end_date]').prop('readonly', true);

        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
        @php($date = \Carbon\Carbon::now()->day < 11 ? \Carbon\Carbon::now()->subMonth()->toDateString() : \Carbon\Carbon::now()->toDateString());
        var formDateCheck = '{{ \Carbon\Carbon::parse($date)->format("Y-m-11") }}';
        var toDateCheck = '{{ \Carbon\Carbon::parse($date)->addMonth()->format("Y-m-10") }}';

        $("#start_date").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            if (date != 'Invalid Date' && date != '1970-01-01') {
                let date_start_input=$('input[name=start_date]').val();
                $('input[name=end_date]').val(date_start_input);
            } else {
                $('input[name=end_date]').val('');
            }

            $('.form-sbm').prop('disabled', false);

            checkDate(dateNow, date);
        });

        $("#end_date").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            let startDate = $('input[name=start_date]').val();

            $('.form-sbm').prop('disabled', false);

            checkDate(startDate, date);
        });

        function checkDate(date, dateCheck) {
            $('.form-sbm').prop('disabled', false);
            $('#notiDanger').html('');
            var date_get = $('input[name=start_date]').val();
            date=date_get.replaceAll("/", "-").substring(date,10);
            if (date > dateCheck) {
                makeDangerAlert('期間が無効になっている', 'notiDanger');
                $('.form-sbm').prop('disabled', true);
            }
            
            if(date < formDateCheck || date > toDateCheck) {
                $('#notiDanger').html('');
                makeDangerAlert('申請可能期間外のため、登録できません', 'notiDanger');
                $('.form-sbm').prop('disabled', true);
            }
        }

        // @if (isset($infoVacation))
        //     checkDate(dateNow, "{{ $infoVacation['end_date'] }}", "指定された日付には、既に申請済みデータがあります。")
        // @endif

        $('.input-date').datetimepicker({
            format: "YYYY/MM/DD (dd)",
            locale: "ja",
            useCurrnet: false,
            disabledDates: [
                @foreach ($listCalendar as $item)
                    moment("{{ $item->date }}"),
                @endforeach
            ],
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script>
        $(document).ready(function(){

        $("#start_time_1").flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            time_24hr: true,
            maxTime: '11:30',
            defaultHour: '00',
            defaultMinute: '00',
        });
        $("#end_time_1").flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            disable: [13,14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
            maxTime: '11:30',
            defaultHour: '00',
            defaultMinute: '00',
        });
        $("#start_time_2").flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            minTime: '12:00',
            defaultHour: '12',
            defaultMinute: '00',
        });
        $("#end_time_2").flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 30,
            minTime: '12:00',
            defaultHour: '12',
            defaultMinute: '00',
        });

        $('.form-group input[type=time]').on('change', function(){
            var input_data=$('.form-group input[type=time]');
            if(input_data != "") {
                $('#day4').attr('disabled', true);
                $('#day5').attr('disabled', true);
            }
        });

        // $('.col-radio input[type=radio]').on('change',function(){
        //     console.log($(this).is(":checked"));
        //     if($(this).is(":checked") && $(this).val()==4 || $(this).val()==5){
        //         $('.form_time').hide();
        //     }
        //     else{
        //         $('.form_time').show();
        //     }
        // });

        $(document).on("submit", "form", function(e){
            var currentForm = this;
            e.preventDefault();
                    bootbox.confirm({
                    message: "変化?",
                    buttons: {
                        cancel: {
                            label: "いいえ",
                        },
                        confirm: {
                            label: "はい",
                        },
                    },
                    callback: function(result){
                        if(result){
                            var get_date_start=new Date($('#start_date input').val());
                            var get_end_date=new Date($('#end_date input').val());
                            var get_subtract_date= (get_end_date - get_date_start) /1000/60/60/24;
                            var input_data_1=$('#day1');
                            var input_data_2=$('#day2');
                            var input_data_4=$('#day4');
                            var input_data_5=$('#day5');
                            if(get_subtract_date > 1) {
                                if(input_data_1.is(':checked') || input_data_2.is(':checked') || input_data_4.is(':checked') || input_data_5.is(':checked')) {
                                    bootbox.alert({
                                        message: "期間指定の場合、0.5日の選択は出来ません。",
                                        buttons: {
                                            ok: {
                                                label: '近い'
                                            }
                                        },
                                    });
                                }
                                else{
                                    currentForm.submit();
                                }
                            }
                            else{
                                currentForm.submit();
                            }
                            
                        }
                    }
                });
                });
        });

        $("input[name=type]").on("change", function(){
            if($(this).val()==='vacation') {
                $(".time_1").removeClass('hidden');
                $(".time_2").removeClass('hidden');
            }

            else{
                $(".time_1").addClass('hidden');
                $(".time_2").addClass('hidden');
            }
        });
    </script>
@endpush
