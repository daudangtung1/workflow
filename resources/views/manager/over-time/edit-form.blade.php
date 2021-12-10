@push('styles')
    <!-- daterange picker -->
    <style>
        .form-button-delete {
            margin-top: 279px !important;
        }

        @media only screen and (max-width: 600px) {
            small {
                position: unset !important;
                display: block;
                margin-left: 0 !important;
            }

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
                            <option value="" data-name="">&nbsp;</option>
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

            <div class="row  mt-30">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>

                        <div class="input-group date input-date" id="date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                placeholder="年-月-日" required data-toggle="datetimepicker" value="" />
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
                                <div class="select-time select-time1 select-min">
                                    <select class="chosen-select" name="start_time">
                                        <option value=""></option>

                                    </select>
                                    <small>
                                        30分単位
                                    </small>
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
                                <div class="select-time select-time1 select-min">
                                    <select class="chosen-select" name="end_time">
                                        <option value=""></option>

                                    </select>
                                    <small>
                                        30分単位
                                    </small>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group select-time select-search">
                        <label for="">所属営ID</label>
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
                        <label for="">承認状態</label>

                        <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#approval_date"
                                name="approval_date" placeholder="年-月-日" data-toggle="datetimepicker" value="" />
                            <div class="input-group-append" data-target="#approval_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group select-time select-100">
                        <label for="">総務確認</label>
                        <select class="chosen-select" name="manager_status_edit">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach (\App\Enums\ManagerStatus::asArray() as $item)
                                <option value="{{ $item }}">
                                    {{ \App\Enums\ManagerStatus::getDescription($item) }}
                                </option>
                            @endforeach
                        </select>

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
    <script>
        $('.form-button-edit').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.over-time.store') }}'
            });
            // $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
            $('.formSm').submit();
        });

        $('.form-button-delete').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.over-time.destroy', 'delete') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
            $('.formSm').submit();
        })

        var arrName = {
            start_time: '07:00',
            end_time: '17:30',
        };
        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
        $('#approval_date').datetimepicker({
            format: false,
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
            $('.select-min .select2-selection__arrow').html('<i class="far fa-clock"></i>');

            $('.select-search .select2-selection__arrow').html(
                '<i class="icofont-search-2"></i>');
        });

        //convert name select
        $('select[name=user_register]').change(function() {
            let name = $('select[name=user_register] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);

            let startTime = $('select[name=user_register] option:selected').data('start-time');
            let endTime = $('select[name=user_register] option:selected').data('end-time');

            //set value input
            $('input[name=start_time_working]').val(startTime);
            $('input[name=end_time_working]').val(endTime);
            $('#span_start').html(startTime);
            $('#span_end').html(endTime);

            $.ajax({
                url: "{{ route('manager.over-time.edit', 'getTime') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    user: $(this).val(),
                    start_time_working: startTime,
                    end_time_working: endTime,
                },
                success: function(data) {
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
                        placeholder: '07:30',
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
                        placeholder: '07:30',
                        allowClear: true,
                    });
                    $('.select-min .select2-selection__arrow').html('<i class="far fa-clock"></i>');

                }
            });


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
                        $(`select[name=start_time]`).val(data.start_time).trigger('change');
                        $(`select[name=end_time]`).val(data.end_time).trigger('change');
                        $(`select[name=approver]`).val(data.approver).trigger('change');
                        $(`input[name=approval_date]`).val(data.approval_date);
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

        $("select[name=start_time]").change(function() {
            return caculate();
        })

        $("select[name=end_time]").change(function() {
            return caculate();
        })



        function caculate() {
            resetForm();
            let disable = true;
            let startTime = $(`select[name=start_time]`).val();
            let endTime = $(`select[name=end_time]`).val();
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

@endpush
