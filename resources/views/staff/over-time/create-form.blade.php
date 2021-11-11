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

        #before_start,
        #after_end {
            font-weight: bold
        }

        .border-bot {
            border-bottom: 1px solid #dbdbdb;
        }

    </style>
@endpush

<div class="row">
    <div class="col-md-4">
        <form action="{{ route('staff.over-time.store') }}" method="POST">
            @csrf
            <div class="row ">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>

                        <div class="input-group date input-date" id="date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                placeholder="年-月-日" required data-toggle="datetimepicker"
                                value="{{ isset($infoRegister) ? $infoRegister['date'] : '' }}" />
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
                            <label>開始時刻</label>

                            <div class="input-group date input-time" id="start_time" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="start_time"
                                    placeholder="07:00" data-target="#start_time" data-toggle="datetimepicker" value="">
                                <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                                <span class="ml-2 mt-1">30分単位</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>終了時刻</label>

                            <div class="input-group date input-time" id="end_time" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="end_time"
                                    data-target="#end_time" data-toggle="datetimepicker" placeholder="17:30" value="">
                                <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                                <span class="ml-2 mt-1">30分単位</span>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <input type="hidden" name="id">
            <div class="row mt-4">
                <div class="col-md-12">
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
                            <span>業前作業時間（~{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}）</span>
                            <span class="float-right"><span id="before_start" class="h4"></span>
                                分</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group border-bot">
                    <label for="">&nbsp</label><br>
                    <div style="height: calc(1.6em + 0.75rem + 2px)">
                        <span class="ml-2 mt-1">
                            <span>業後作業時間（{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}~）</span>
                            <span class="float-right"><span id="after_end" class="h4"></span>
                                分</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="form-group border-bot">
                    <div style="height: calc(1.6em + 0.75rem + 2px)">
                        <span class="ml-2 mt-1">
                            <span>時間外勤務計</span>
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
        $("#date").on("change.datetimepicker", function(e) {
            // $("#date").datetimepicker('minDate', new Date('{{ \Carbon\Carbon::now()->toDateString() }}'));
            let dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');
            let oldId = `{{ isset($infoRegister) ? $infoRegister['id'] : '' }}`;
            $('button').prop('disabled', false);
            resetForm();
            $.ajax({
                url: "{{ route('staff.over-time.edit', 'info-register') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(data) {
                    $(`input[name=start_time]`).val(data.start_time);
                    $(`input[name=end_time]`).val(data.end_time);
                    $('#before_start').html(data.before_start);
                    $('#after_end').html(data.after_end);
                    $('#result').html(data.total);
                    $('input[name=id]').val(data.id);

                    if (oldId != '' && !data.id)
                        $('input[name=id]').val(oldId);

                    if (data.disable || dateNow > date)
                        $('button').prop('disabled', true);
                }
            })
        });

        function resetForm() {
            $('#before_start').html('');
            $('#after_end').html('');
            $('#result').html('');
        }

        $("#start_time").on("change.datetimepicker", function(e) {
            let startTimeWorking =
                "{{ \Carbon\Carbon::now()->toDateString() . ' ' . auth()->user()->start_time_working }}";
            // \Carbon\Carbon::now()->toDateString()
            $("#start_time").datetimepicker('maxDate', new Date(startTimeWorking));
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');
            let key = e.target.id;

            if (time == 'Invalid Date')
                time = $(`input[name=start_time]`).val();

            if ($(`input[name=start_time]`).val() != '') {
                $(`input[name=start_time]`).val(add30Min(time));

                return caculate();
            }

            $('#before_start').html(0)
            $(`input[name=start_time]`).val("{{ auth()->user()->start_time_working }}")

            return caculate();
        });


        $("#end_time").on("change.datetimepicker", function(e) {
            var endTimeWorking =
                "{{ \Carbon\Carbon::now()->toDateString() . ' ' . auth()->user()->end_time_working }}";
            $("#end_time").datetimepicker('minDate', new Date(endTimeWorking));
            let date = new Date(e.date);
            let time = date.toLocaleTimeString('it-IT');
            let key = e.target.id;

            if (time == 'Invalid Date')
                time = $(`input[name=end_time]`).val();

            if ($(`input[name=end_time]`).val() != '') {
                $(`input[name=end_time]`).val(add30Min(time))

                return caculate();
            }

            $(`input[name=end_time]`).val("{{ auth()->user()->end_time_working }}");
            $('#after_end').html(0);

            return caculate();
        });



        function caculate() {
            let startTime = $(`input[name=start_time]`).val();
            let endTime = $(`input[name=end_time]`).val();
            let startTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->start_time_working)->format('H:i') }}";
            let endTimeWorking = "{{ \Carbon\Carbon::parse(auth()->user()->end_time_working)->format('H:i') }}";

            let totalTime = 0;

            if (startTime != '' && startTime <= startTimeWorking) {
                date1 = new Date("01/01/2007 " + startTime);
                date2 = new Date("01/01/2007 " + startTimeWorking);
                let hours = Math.abs(date2 - date1);
                hours = hours / (1000 * 60 * 60);
                totalTime = +hours;
                $('#before_start').html(hours);
            }

            if (endTime != '' && endTime >= endTimeWorking) {
                date1 = new Date("01/01/2007 " + endTime);
                date2 = new Date("01/01/2007 " + endTimeWorking);
                let hours = Math.abs(date2 - date1);
                hours = hours / (1000 * 60 * 60);
                totalTime = +totalTime + hours;
                $('#after_end').html(hours);
            }
            // $('button').prop('disabled', true);

            // if (+totalTime > 0)
            //     $('button').prop('disabled', false);

            $('#result').html(totalTime);
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
