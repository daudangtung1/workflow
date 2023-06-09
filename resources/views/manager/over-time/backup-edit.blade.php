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

            small {
                position: unset !important;
                display: block;
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

        .d-contents {
            display: contents;
        }

        small {
            position: absolute;
            margin-left: 5px;
            line-height: 35px;
            width: 100%;
        }

    </style>
@endpush

<div class="row pl-5 pt-3 pr-5">
    <div class="col-md-4">
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
                    <div class="form-group">
                        <label>開始時刻</label>
                        <div class="row">
                            <div class="col">
                                <div class="select-time select-min">
                                    <select class="chosen-select" name="start_time">
                                        <option value=""></option>
                                        {{-- @foreach ($times['start'] as $item)
                                            <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                            @if ($item['minutes']['30'])
                                                <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                            @endif
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col d-contents">
                                <span class="mt-1">30分単位</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>終了時刻</label>
                        <div class="row">
                            <div class="col">
                                <div class="select-time select-min">
                                    <select class="chosen-select" name="end_time">
                                        <option value=""></option>
                                        {{-- @foreach ($times['end'] as $item)
                                                @if ($item['minutes']['00'])
                                                    <option value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                                    @endif
                                                    <option value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                                                @endforeach --}}
                                    </select>

                                </div>
                            </div>
                            <div class="col d-contents">
                                <span class="mt-1">30分単位</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group select-time select-search">
                        <label for="">申請者ID</label>
                        <select class="chosen-select" name="approver">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($approvers as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
                                    {{ $item->id . ' - ' . $item->fullName }}
                                </option>
                            @endforeach
                        </select>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="">日付</label>

                        <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#approval_date"
                                name="approval_date" placeholder="年-月-日" data-toggle="datetimepicker" value="" />
                            <div class="input-group-append" data-target="#approval_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>

                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group select-time">
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

            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary w-100 text-center form-button-edit font-weight-bold"
                        disabled>更新 </button>
                </div>
            </div>
        </form>
    </div>

    {{-- right --}}
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
        <div class="row" id="div-null">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">&nbsp;</label>
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
                            <span>業前作業時間（~<span id="span_start"></span>）</span>
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
                            <span>業後作業時間（<span id="span_end"></span>~）</span>
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
        <div class="row" id="div-null">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <div style="height: calc(1.6em + 0.75rem + 2px)"></div>
                </div>
            </div>
        </div>
        <div class="row" id="div-null">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <div style="height: calc(1.6em + 0.75rem + 2px)"></div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 mt-1">
                <button class="btn btn-primary w-100 text-center form-button-delete font-weight-bold" disabled>削除
                </button>
            </div>
        </div>
    </div>
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
                '<span class="fas fa-search" style="color: #888888"> </span>');
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
