@push('styles')
    <!-- daterange picker -->
    <style>
        
    </style>
@endpush

        <div class="tab-content1 d-flex2">
            <div class="w-410 left-content">
                <form action="{{ route('manager.staff-over-time.store') }}" class="frmSubmit" method="POST">
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
                                    <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                        placeholder="年-月-日" required data-toggle="datetimepicker"
                                        value="{{ isset($infoRegister) ? $infoRegister['date'] : '' }}" />
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
                                        <div class="select-time">
                                            <select class="chosen-select" name="start_time">
                                                <option value=""></option>
                                                @foreach ($times['start'] as $item)
                                                    <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                    @if ($item['minutes']['30'])
                                                        <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
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
                                            <div class="select-time">
                                                <select class="chosen-select" name="end_time">
                                                    <option value=""></option>
                                                    @foreach ($times['end'] as $item)
                                                        @if ($item['minutes']['00'])
                                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                            @endif
                                                            <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                        @endforeach
                                                </select>
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
                            <button class="btn btn-primary w-100 text-center form-button">申請(登録) </button>
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
                            <div >
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
                            <div >
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

@push('scripts')
    <script>
        $('.form-button').click(e => {
            e.preventDefault();
            let time = $(`#result`).html();
            let date = $('input[name=date]').val();

            if(time*1 <= 0 || !date) {
                $('#notiDanger').html('');
                return makeDangerAlert('期間が無効になっている', 'notiDanger');
            }

            $('.frmSubmit').submit();
        })
        var arrName = {
            start_time: '07:00',
            end_time: '17:30',
        };
        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
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
            let oldId = `{{ isset($infoRegister) ? $infoRegister['id'] : '' }}`;

            if(date == 'Invalid Date')
                date = $('input[name=date]').val();

            if($('.form-button').html() == '承認済み') {
                $('.form-button').removeClass('btn-danger');
                $('.form-button').addClass('btn-primary');
                $('.form-button').html('申請(登録)');
            }

            let startTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}";
            let endTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}";

            $.ajax({
                url: "{{ route('manager.staff-over-time.edit', 'info-register') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(data) {
                    setSelectTime(data.time);
                    
                    if(data.start_time_working)
                        startTimeWorking = data.start_time_working;

                    if(data.end_time_working)
                        endTimeWorking = data.end_time_working;


                    $(`select[name=start_time]`).val(data.start_time).trigger('change');
                    $(`select[name=end_time]`).val(data.end_time).trigger('change');
                    $('.select-time select').prop('disabled', false);  

                    $(`input[name=start_time_working]`).val(startTimeWorking);
                    $(`input[name=end_time_working]`).val(endTimeWorking);

                    $('#start_time_working').html(startTimeWorking);
                    $('#end_time_working').html(endTimeWorking);
                    
                    if (data.disable) {
                        $('.form-button').removeClass('btn-primary');
                        $('.form-button').addClass('btn-danger');
                        $('.form-button').html('承認済み');
                        $('.form-button, .select-time select').prop('disabled', true);  
                    }

                    caculate();
                }
            })
        });

        function resetForm() {
            $('#before_start').html('');
            $('#after_end').html('');
            $('#result').html('');
        }

        $("select[name=start_time]").change(function () {
            return caculate();
        })

        $("select[name=end_time]").change(function () {
            return caculate();
        })



        function caculate() {
            resetForm();
            let disable = true; 
            let startTime = $(`select[name=start_time]`).val();
            let endTime = $(`select[name=end_time]`).val();
            let startTimeWorking = $(`input[name=start_time_working]`).val();
            let endTimeWorking = $(`input[name=end_time_working]`).val();

            let totalTime = 0;

            if (startTime != '' && startTime <= startTimeWorking) {
                date1 = new Date("01/01/2007 " + startTime);
                date2 = new Date("01/01/2007 " + startTimeWorking);
                let hours = Math.abs(date2 - date1);
                hours = hours / (1000 * 60);
                totalTime = +hours;
                $('#before_start').html(hours);
            }

            if (endTime != '' && endTime >= endTimeWorking) {
                date1 = new Date("01/01/2007 " + endTime);
                date2 = new Date("01/01/2007 " + endTimeWorking);
                let hours = Math.abs(date2 - date1);
                hours = hours / (1000 * 60);
                totalTime = +totalTime + hours;
                $('#after_end').html(hours);
            }

            let dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
            let date = $('input[name=date]').val();

            if (date >= dateNow && $('.form-button').html() != '承認済み')
                disable = false;

            $('#notiDanger').html('');
            
            if(disable && $('.form-button').html() != '承認済み')
               makeDangerAlert('期間が無効になっている', 'notiDanger');

            $('.form-button').prop('disabled', disable);  
            $('#result').html(totalTime);
        }

        function setSelectTime (data) {
                    $('select[name=start_time]').empty();
                    $('select[name=start_time]').append($('<option>').attr('value', '')
                        .text(''))

                    $.each(data.start, function(key, item) {
                        let time = item['hour'] + ':' + item['minutes']['00'];
                        $('select[name=start_time]').append($('<option>').attr('value', time)
                            .text(time))

                        if (item['minutes']['30']) {
                            let time = item['hour'] + ':' + item['minutes']['30'];
                            $('select[name=start_time]').append($('<option>').attr('value',
                                time).text(time))
                        }
                    });

                    $('select[name=start_time]').trigger('change');

                    $(`select[name=start_time]`).select2({
                        placeholder: '07:00',
                        allowClear: true,
                    });

                    //end time
                    $('select[name=end_time]').empty();
                    $('select[name=end_time]').append($('<option>').attr('value', '')
                        .text(''));

                    $.each(data.end, function(key, item) {
                        if (item['minutes']['00']) {
                            let time = item['hour'] + ':' + item['minutes']['00'];
                            $('select[name=end_time]').append($('<option>').attr('value', time)
                                .text(time))
                        }

                        let time = item['hour'] + ':' + item['minutes']['30'];
                        $('select[name=end_time]').append($('<option>').attr('value', time)
                            .text(time))
                    });

                    $('select[name=end_time]').trigger('change');

                    $(`select[name=end_time]`).select2({
                        placeholder: '17:30',
                        allowClear: true,
                    });
                    $('.select-time .select2-selection__arrow').html('<i class="icofont-clock-time"></i>');
        }

    </script>

@endpush