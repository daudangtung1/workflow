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
                                placeholder="年-月-日" required data-toggle="datetimepicker" value="" />
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
                                <div class="input-group date input-time col" id="start_time_first"
                                    data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="start_time_first"
                                        placeholder="09:00" data-target="#start_time_first" data-toggle="datetimepicker"
                                        value="">
                                    <div class="input-group-append" data-target="#start_time_first"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="input-group date input-time col" id="end_time_first"
                                    data-target-input="nearest">

                                    <input type="text" class="form-control datetimepicker-input" name="end_time_first"
                                        placeholder="12:00" data-target="#end_time_first" data-toggle="datetimepicker"
                                        value="">
                                    <div class="input-group-append" data-target="#end_time_first"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
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
                                <div class="input-group date input-time col" id="start_time_second"
                                    data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        name="start_time_second" placeholder="13:00" data-target="#start_time_second"
                                        data-toggle="datetimepicker" value="">
                                    <div class="input-group-append" data-target="#start_time_second"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="input-group date input-time col" id="end_time_second"
                                    data-target-input="nearest">

                                    <input type="text" class="form-control datetimepicker-input" name="end_time_second"
                                        placeholder="16:00" data-target="#end_time_second" data-toggle="datetimepicker"
                                        value="">
                                    <div class="input-group-append" data-target="#end_time_second"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>


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
                                <div class="input-group date input-time col" id="start_time_third"
                                    data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="start_time_third"
                                        placeholder="16:00" data-target="#start_time_third" data-toggle="datetimepicker"
                                        value="">
                                    <div class="input-group-append" data-target="#start_time_third"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="input-group date input-time col" id="end_time_third"
                                    data-target-input="nearest">

                                    <input type="text" class="form-control datetimepicker-input" name="end_time_third"
                                        placeholder="17:00" data-target="#end_time_third" data-toggle="datetimepicker"
                                        value="">
                                    <div class="input-group-append" data-target="#end_time_third"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <button class="btn btn-primary w-100 text-center">申請(登録) </button>
                </div>
            </div>
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

            if (dateNow > date)
                $('button').prop('disabled', true);
        });

        //first time
        $("#start_time_first").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');

            //add 30 minute
            if ($(`input[name=start_time_first]`).val() != '') {
                if (time == 'Invalid Date') {
                    time = $(`input[name=start_time_first]`).val();
                } else {
                    $("#end_time_first").datetimepicker('minDate', date);
                }

                $(`input[name=start_time_first]`).val(add30Min(time));
            }

            return caculate();
        });

        $("#end_time_first").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');

            //add 30 minute
            if ($(`input[name=end_time_first]`).val() != '') {
                if (time == 'Invalid Date') {
                    time = $(`input[name=end_time_first]`).val();
                } else {
                    $("#start_time_first").datetimepicker('maxDate', date);
                    $("#start_time_second").datetimepicker('minDate', date);
                }

                $(`input[name=end_time_first]`).val(add30Min(time));

                return caculate();
            }
        });

        //second time
        $("#start_time_second").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');

            //add 30 minute
            if ($(`input[name=start_time_second]`).val() != '') {
                if (time == 'Invalid Date') {
                    time = $(`input[name=start_time_second]`).val();
                } else {
                    $("#end_time_second").datetimepicker('minDate', date);
                    $("#end_time_first").datetimepicker('maxDate', date);
                }

                $(`input[name=start_time_second]`).val(add30Min(time));
            }

            return caculate();
        });

        $("#end_time_second").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');

            //add 30 minute
            if ($(`input[name=end_time_second]`).val() != '') {
                if (time == 'Invalid Date') {
                    time = $(`input[name=end_time_second]`).val();
                } else {
                    $("#start_time_second").datetimepicker('maxDate', date);
                    $("#start_time_third").datetimepicker('minDate', date);
                }

                $(`input[name=end_time_second]`).val(add30Min(time));
            }

            return caculate();
        });

        //third time
        $("#start_time_third").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');

            //add 30 minute
            if ($(`input[name=start_time_third]`).val() != '') {
                if (time == 'Invalid Date') {
                    time = $(`input[name=start_time_third]`).val();
                } else {
                    $("#end_time_third").datetimepicker('minDate', date);
                    $("#end_time_second").datetimepicker('maxDate', date);
                }

                $(`input[name=start_time_third]`).val(add30Min(time));
            }

            return caculate();
        });

        $("#end_time_third").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');

            //add 30 minute
            if ($(`input[name=end_time_third]`).val() != '') {
                if (time == 'Invalid Date') {
                    time = $(`input[name=end_time_third]`).val();
                } else {
                    $("#start_time_third").datetimepicker('maxDate', date);
                }

                $(`input[name=end_time_third]`).val(add30Min(time));
            }

            return caculate();
        });

        function caculate() {
            resetForm();
            let startTime = $(`input[name=start_time_first]`).val();
            let endTime = $(`input[name=end_time_first]`).val();

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
                    hours = hours / (1000 * 60 * 60);
                    total += hours;

                    $(`#${item.id}`).html(hours);
                }
            })

            $('#result').html(total);
        }

        function add30Min(oldTime) {
            var time = oldTime.split(":"); //split hours an minutes
            var hours = time[0]; // get hours
            var minutes = time[1]; // get minutes

            if (minutes != 0 && minutes != 30) {
                if (+minutes > 30) { // when minutes over 30
                    minutes = '30';
                } else {
                    minutes = '00';
                }
            }

            return `${hours}:${minutes}`;
        }
    </script>

@endpush
