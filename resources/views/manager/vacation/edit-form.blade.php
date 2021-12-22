@push('styles')
    <!-- daterange picker -->
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .font-weight-normal {
            padding-top: 2px !important;
        }

        .select-100 .select2-container {
            width: 410px !important;
        }

        @media only screen and (max-width: 600px) {
            small {
                position: unset !important;
                display: block;
                line-height: 24px !important;
                margin-left: 0 !important;
            }

            .select-100 .select2-container {
                width: 100% !important;
            }
        }

        small {
            position: absolute;
            font-size: 14px;
            line-height: 46px;
            font-weight: 400;
            color: #1F232E;
            margin-left: 15px;
            width: 200px;

        }

        .mr-280 {
            margin-right: 280px;
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

        .datepicker-days td.disabled {
            background: #FFD1D1 !important;
            border-radius: 50%;
        }

    </style>
@endpush

        <div class="tab-content1">
            <form class="formSm" method="POST">
                @csrf
                <div class="row ">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">申請者ID</label>
                            <div class="select-time select-search select-100">

                                <select class="chosen-select" name="user_register">
                                    @foreach ($staffs as $item)
                                        <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
                                            {{ $item->id . ' - ' . $item->fullName }}
                                        </option>
                                    @endforeach
                                </select>
                                <small></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-md-12">
                        <label for="">日付</label>
                        <div class="form-group ">
                            <div class=" input-group date input-date d-inlin-flex col-mobile-date input-date-disable"
                                id="start_date_register" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#start_date_register" name="start_date_register" placeholder="年-月-日"
                                    required data-toggle="datetimepicker" />
                                <div class="input-group-append" data-target="#start_date_register"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="icofont-calendar"></i></div>
                                </div>
                            </div>
                            <div class="text-center span-date ">~</div>
                            <div class="input-group date input-date d-inlin-flex col-mobile-date input-date-disable"
                                id="end_date_register" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#end_date_register" name="end_date_register" placeholder="年-月-日"
                                    required data-toggle="datetimepicker" value="" />
                                <div class="input-group-append" data-target="#end_date_register"
                                    data-toggle="datetimepicker">
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
                                        @foreach (collect(\App\Enums\VacationType::asArray())->chunk(3)->all()
    as $chunk)
                                            @php($i++)

                                            @if ($i <= 2)
                                                </tr>
                                                @foreach ($chunk as $item)
                                                    <td class="pr-4 pb-20">
                                                        <div class="col-radio d-radio col-mobile">
                                                            <input type="radio" id="day{{ $item }}" name="type"
                                                                required value="{{ $item }}"
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
                                                    <td class="pr-4 ">
                                                        <div class="col-radio d-radio col-mobile">
                                                            <input type="radio" id="vacation" name="type"
                                                                value="vacation" required
                                                                {{ isset($infoVacation) && $infoVacation['type'] > 6 ? 'checked' : '' }}>
                                                            <label for="vacation">
                                                                欠勤
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="pr-4 ">
                                                        <div class="form-group select-time">
                                                            <select class="chosen-select" name="option_vacation">
                                                                @foreach ($chunk as $item)
                                                                    <option value="{{ $item }}"
                                                                        {{ isset($infoVacation) && $infoVacation['type'] == $item ? 'selected' : '' }}>
                                                                        <span
                                                                            style="color: #6A6A6A !important;">欠勤</span>
                                                                        {{ \App\Enums\VacationType::getDescription($item) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="pr-4"></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="mt-20">※欠勤は有料の無い社員のみ使用可能</td>
                                        </tr>
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
                    <div class="col-md-12 mt-30">
                        <div class="form-group">
                            <label for="">所属営ID</label>

                            <div class="select-time select-search select-100">
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
                    <div class="col-md-12 mt-30">
                        <div class="form-group  w-410">
                            <label for="">承認状態</label>

                            <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#approval_date" name="approval_date" placeholder="年-月-日"
                                    data-toggle="datetimepicker" value="" />
                                <div class="input-group-append" data-target="#approval_date"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="icofont-clock-time"></i></div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <div class="col-md-12 mt-30">
                        <div class="form-group">
                            <label for="">総務確認</label>

                            <div class="select-time select-100">
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

                    <div class="col-md-12">
                        <button disabled
                            class="btn btn-primary w-410 form-button form-button-edit mr-280"><b>更新</b></button>
                        <button class="btn btn-primary w-410 form-button form-button-delete" disabled><b>削除</b></button>

                    </div>
                </div>
                <input type="hidden" name="id">

            </form>
        </div>

@push('scripts')
    <script>
        $('.input-date-disable').datetimepicker({
            format: "YYYY-MM-DD",
            locale: "ja",
            disabledDates: [
                @foreach ($listCalendar as $item)
                    moment("{{ $item->date }}"),
                @endforeach
            ],
            daysOfWeekDisabled: [0, 6],
        });

        $('.form-button-edit').click(function(e) {
            let formData = new FormData($('.formSm')[0]);
            if (confirm('すでに”登録されたデータがあります。上書き更新してもよろしいですか？')) {
                $('.formSm').attr({
                    method: 'POST',
                    action: '{{ route('manager.vacation.update_vacation', 'update') }}'
                });
                $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
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
                    action: '{{ route('manager.vacation.destroy', 'delete') }}'
                });
                $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
                $('.formSm').submit();
            } else {
                e.preventDefault();
            }
        })

        $('select[name=user_register]').change(function() {
            let name = $('select[name=user_register] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('select[name=approver]').change(function() {
            let name = $('select[name=approver] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('#approval_date').datetimepicker({
            format: false,
            locale: 'ja',
            icons: {
                time: 'far fa-clock',
            },
        });

        $("#start_date_register").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            if (date != 'Invalid Date' && date != '1970-01-01') {
                $('input[name=end_date_register]').val(date);
            } else {
                $('input[name=end_date_register]').val('');
            }

            checkDate(date, date);
        });

        $("#end_date_register").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            let startDate = $('input[name=start_date_register]').val();


            checkDate(startDate, date);
        });

        function checkDate(date, dateCheck) {
            let id = $('input[name=id]').val();

            $('.form-button').prop('disabled', false);

            if (date > dateCheck || !id)
                $('.form-button').prop('disabled', true);
        }
    </script>
@endpush
