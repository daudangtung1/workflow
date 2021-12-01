@push('styles')
    <!-- daterange picker -->
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .input-group-text {
            border-radius: 0 0.25rem 0.25rem 0;
        }

        input {
            cursor: unset !important;
        }

        @media only screen and (max-width: 600px) {
            #div-null {
                display: none;
            }
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

<div class="row">
    <div class="col-md-4">
        <form action="{{ route('staff.part-time.store') }}" method="POST">
            @csrf
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
                <div class="col-md-12 mt-4">
                    <button class="btn btn-primary w-100 text-center form-button font-weight-bold">申請(登録) </button>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ (isset($infoRegister) && !$infoRegister['disable']) ? $infoRegister['id'] : '' }}">
        </form>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
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
@push('scripts')
    <script>
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

        //check register old date
        $("#date").on("change.datetimepicker", function(e) {
            let dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
            let date = new Date(e.date);

            date = date.toLocaleDateString('fr-CA');

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
                url: "{{ route('staff.part-time.edit', 'info-register') }}",
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

                    if (data.disable) {
                        $('.form-button').removeClass('btn-primary');
                        $('.form-button').addClass('btn-danger');
                        $('.form-button').html('承認済み');
                        $('.form-button').prop('disabled', true);  
                    }
                }
            })
        });

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
                    hours = hours / (1000 * 60);
                    total += hours;

                    $(`#${item.id}`).html(hours);
                }

            });

            let dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
            let date = $('input[name=date]').val();

            if (total > 0 && date >= dateNow && $('.form-button').html() != '承認済み')
                disable = false;

            $('button').prop('disabled', disable);  

            $('#result').html(total);
        }

    </script>

@endpush
