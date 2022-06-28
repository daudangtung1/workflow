@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- daterange picker -->
    <style>
        .form-button-delete {
            margin-top: 173px !important;
        }

        @media only screen and (max-width: 1023px) {
            small {
                position: unset !important;
                display: block;
                margin-left: 0 !important;
                line-height: 23px !important;
            }
        }

        @media only screen and (max-width: 600px) {
           

            #div-null {
                display: none;
            }

            .form-button-delete {
                margin-top: 50px !important;
            }
        }

        small {
            position: absolute;
            font-size: 14px;
            margin-left: 15px;
            line-height: 46px;
            width: 100%;
            color: #1F232E !important;
        }

        .select-search .select2-container,
        .select-100 .select2-container {
            width: 100% !important;
        }

        .mt-63 {
            margin-top: 63px !important;
        }



        .left-content {
            margin-right: 290px !important;
        }


        @media screen and (max-width: 1494px) {
            .select-time1 .select2-container {
                width: 70% !important;
            }
        }

        @media only screen and (max-width: 1330px) {
            .manager .left-content {
                margin-right: 150px !important;
            }
        }

        @media only screen and (max-width: 1023px) {
            small {
                position: unset;
                margin-left: 0px !important;
            }
        }

        .span-aprrover {}

        .select-time1 .select2-container {
            width: 100% !important;
        }

        .content-wrapper .tab-content1 .select2-container {
            width: 100% !important;
        }

        .relative{
            position: relative;
        }
        
        .relative .input-group-append{
            position: absolute;
            top: 0;
            right:  0;
            height: 46px;
            pointer-events: none;
        }
        .select-time .form-control[readonly]{
            background: #fff;
        }
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
    </style>
@endpush

<div class="tab-content1 d-flex2 manager">
    <div class="w-410 left-content">
        <form class="formSm" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group select-time select-search">
                        <label for="">申請者ID</label>

                        <select class="chosen-select" name="user_register">
                            @foreach ($staffs as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->fullName }}"
                                    data-start-time="{{ \Carbon\Carbon::parse($item->start_time_working)->format('H:i') }}"
                                    data-end-time="{{ \Carbon\Carbon::parse($item->end_time_working)->format('H:i') }}">
                                    {{ $item->id . ' - ' . $item->fullName }}
                                </option>
                            @endforeach
                        </select>
                        <small></small>

                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>
                        <div class="input-group date input-date" id="date" data-target-input="nearest"> 
                            <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                placeholder="年/月/日" required data-toggle="datetimepicker" value=""/>
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
                            <div class="select-time select-time1 select-min relative">
                                    <input type="text" class="form-control" name="start_time" id="start_time">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                    </div>
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
                                <div class="select-time select-time1 select-min relative">
                                    <input type="text" class="form-control" name="end_time" id="end_time">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                    </div>
                                </div> 
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group select-time select-search">
                        <label for="">承認者ID</label>
                        <select class="chosen-select" name="approver">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($approvers as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
                                    {{ $item->id . ' - ' . $item->fullName }}
                                </option>
                            @endforeach
                        </select>
                        <small class="span-aprrover"></small>

                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="">承認時間</label>

                        <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#approval_date"
                                name="approval_date" placeholder="年-月-日" data-toggle="datetimepicker" value=""/>
                            <div class="input-group-append" data-target="#approval_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="start_time_working">
            <input type="hidden" name="end_time_working">
            <input type="hidden" name="id">

            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary w-100 text-center form-button-edit form-button"
                        disabled>更新 </button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-410">
        <div class="row hide-mobile" style="height: 262px">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group border-bot min-text">
                    <div>
                        <span
                            class="min-text">業前作業時間（~<span id="span_start"></span>）</span>
                        <span class="float-right"><span id="before_start" class="result-text"></span>
                            分</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group border-bot mt-63 min-text">
                    <div>
                        <span
                            class="min-text">業後作業時間（<span id="span_end"></span>~）</span>
                        <span class="float-right"><span id="after_end" class="result-text"></span>
                            分</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group  mt-63 ">
                    <div>
                        <span class="min-text">時間外勤務計</span>
                        <span class="float-right"><span id="result" class="result-text"></span>
                            分</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary w-100 text-center form-button-delete  form-button" disabled>削除
                </button>
            </div>
        </div>
    </div>

    <div style="clear: both"></div>
</div>

@push('scripts')
    <script src="{{ asset('js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/moment/moment-with-locales.min.js') }}"></script>
    <script>
        $('.form-button-edit').click(function(e) {
            let formData = new FormData($('.formSm')[0]);

            if (confirm('すでに”登録されたデータがあります。上書き更新してもよろしいですか？')) {
                $('.formSm').attr({
                    method: 'POST',
                    action: '{{ route('manager.over-time.store') }}'
                });
                // $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
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
                    action: '{{ route('manager.over-time.destroy', 'delete') }}'
                });
                $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
                $('.formSm').submit();
            } else {
                e.preventDefault();
            }
        })

        var arrName = {
            start_time: '07:00',
            end_time: '17:30',
        };
        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
        $('#approval_date').datetimepicker({
            format: false,
            pickTime: false,
            locale: 'ja',
            icons: {
                time: 'far fa-clock',
            },

        });

        //config
        $(document).ready(function() {
            for (const [index, item] of Object.entries(arrName)) {
                $(`select[name=${index}]`).select2({
                    placeholder: item,
                    allowClear: true,
                });
            }
            $('.select-min .select2-selection__arrow').html('<i class="icofont-clock-time"></i>');

            $('.select-search .select2-selection__arrow').html(
                '<i class="icofont-search-2"></i>');
        });

        //convert name select
        $('select[name=user_register]').change(function() {
            let name = $('select[name=user_register] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);

            

            //getData();
        });

        $('select[name=approver]').change(function() {
            let name = $('select[name=approver] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        //change date
        $("#date").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');
            let oldId = `{{ isset($infoRegister) ? $infoRegister['id'] : '' }}`;

            if (date == 'Invalid Date')
                date = $('input[name=date]').val();
                
            //getData();
        });

        function getData(id) {
            let user = $('select[name=user_register]').val();

            if (date && user) {
                $.ajax({
                    url: "{{ route('manager.over-time.edit', 'info-register') }}",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        id: id,
                        user: user,
                    },
                    success: function(data) {
                        moment.locale('ja');
                        $(`input[name=start_time]`).val(data.start_time).trigger('change');
                        $(`input[name=end_time]`).val(data.end_time).trigger('change');
                        $(`select[name=approver]`).val(data.approver).trigger('change');
                        $(`input[name=approval_date]`).val(data.approval_date ? moment(data.approval_date).format("YYYY/MM/DD (dd)") : '');
                        $(`input[name=date]`).val(data.date ? moment(data.date).format("YYYY/MM/DD (dd)") : '');
                        $(`select[name=manager_status_edit]`).val(data.manager_confirm).trigger('change');

                        if (!data.manager_confirm)
                            $(`select[name=manager_status_edit]`).val(
                                '{{ \App\Enums\ManagerStatus::PENDING }}').trigger('change');

                        return caculate();
                    }
                });
            }
        }

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
        })

        function caculate() {
            resetForm();
            let disable = true;
            let startTime = $(`input[name=start_time]`).val();
            let endTime = $(`input[name=end_time]`).val();
            let startTimeWorking = $('input[name=start_time_working]').val();
            let endTimeWorking = $('input[name=end_time_working]').val();

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

            // if (totalTime > 0 && date >= dateNow)
            let id = $('input[name=id]').val();

            if (totalTime > 0 && id)
                disable = false;

            $('.form-button-edit').prop('disabled', disable);
            $('.form-button-delete').prop('disabled', disable);

            $('#result').html(totalTime);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
         $('#start_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 1,
            defaultHour: '00',
            defaultMinute: '00',
            minTime: '00:00',
            maxTime: '08:00'
        });

        $('#end_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            minuteIncrement: 1,
            defaultHour: '00',
            defaultMinute: '00',
            minTime: '18:00',
            maxTime: '23:59'
        });
    </script>
@endpush
