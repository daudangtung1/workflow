@push('styles')
    <!-- daterange picker -->
    <style>
        
    </style>
@endpush

        <div class="tab-content1 d-flex2">
            <div class="w-410 left-content">
                <form action="{{ route('staff.over-time.store') }}" method="POST">
                    @csrf
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
                            <button class="btn btn-primary w-100 text-center form-button" disabled>申請(登録) </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-410">
                <div class="row hide-mobile" style="height: 158px">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group border-bot min-text">
                            <div >
                                    <span class="min-text">業前作業時間（~{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}）</span>
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
                                    <span class="min-text">業後作業時間（{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}~）</span>
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

            $.ajax({
                url: "{{ route('staff.over-time.edit', 'info-register') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(data) {
                    $(`select[name=start_time]`).val(data.start_time).trigger('change');
                    $(`select[name=end_time]`).val(data.end_time).trigger('change');
                    
                    caculate();

                    if (data.disable) {
                        $('.form-button').removeClass('btn-primary');
                        $('.form-button').addClass('btn-danger');
                        $('.form-button').html('承認済み');
                        $('.form-button').prop('disabled', true);  
                    }
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
            let startTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}";
            let endTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}";

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

            if (totalTime > 0 && date >= dateNow && $('.form-button').html() != '承認済み')
                disable = false;

            $('.form-button').prop('disabled', disable);  
            
            $('#result').html(totalTime);
        }

    </script>

@endpush
