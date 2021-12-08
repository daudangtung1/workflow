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
            }

            .select-100 .select2-container {
                width: 100% !important;
            }
        }

        small {
            position: absolute;
            margin-left: 5px;
            line-height: 35px;
            width: 100%;
        }

        .mr-280 {
            margin-right: 280px;
        }

    </style>
@endpush
<div class="row ">
    <div class="col-md-12">
        <div class="tab-content1">
            <form class="formSm" method="POST">
                @csrf
                <div class="row ">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">申請者ID</label>
                            <div class="select-time select-search select-100">

                                <select class="chosen-select" name="user_register">
                                    <option value="" data-name="">&nbsp;</option>
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
                            <div class=" input-group date input-date d-inlin-flex col-mobile-date" id="start_date_register"
                                data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#start_date_register"
                                    name="start_date_register" placeholder="年-月-日" required data-toggle="datetimepicker"
                                     />
                                <div class="input-group-append" data-target="#start_date_register" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="icofont-calendar"></i></div>
                                </div>
                            </div>
                            <div class="text-center span-date ">~</div>
                            <div class="input-group date input-date d-inlin-flex col-mobile-date" id="end_date_register"
                                data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#end_date_register"
                                    name="end_date_register" placeholder="年-月-日" required data-toggle="datetimepicker"
                                    value="" />
                                <div class="input-group-append" data-target="#end_date_register" data-toggle="datetimepicker">
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
                                <div class="w-410">
                                    <label class="d-block" for="">種別</label>
                                    <div class="col-radio d-radio col-mobile">
                                        <input type="radio" id="fullday" name="type"
                                            {{ !isset($infoVacation) ? 'checked' : '' }}
                                            {{ isset($infoVacation) && $infoVacation['type'] == \App\Enums\VacationType::FULL_DAY ? 'checked' : '' }}
                                            value="{{ \App\Enums\VacationType::FULL_DAY }}">
                                        <label
                                            for="fullday">{{ \App\Enums\VacationType::getDescription(\App\Enums\VacationType::FULL_DAY) }}</label>
                                    </div>
                                    <div class="col-radio   d-radio col-mobile">
                                        <input type="radio" id="morning" name="type"
                                            {{ isset($infoVacation) && $infoVacation['type'] == \App\Enums\VacationType::MORNING ? 'checked' : '' }}
                                            value="{{ \App\Enums\VacationType::MORNING }}">
                                        <label for="morning">
                                            {{ \App\Enums\VacationType::getDescription(\App\Enums\VacationType::MORNING) }}
                                        </label>
                                    </div>
                                    <div class="col-radio d-radio col-mobile">
                                        <input type="radio" id="afternoon" name="type"
                                            {{ isset($infoVacation) && $infoVacation['type'] == \App\Enums\VacationType::AFTERNOON ? 'checked' : '' }}
                                            value="{{ \App\Enums\VacationType::AFTERNOON }}">
                                        <label for="afternoon">
                                            {{ \App\Enums\VacationType::getDescription(\App\Enums\VacationType::AFTERNOON) }}
                                    </div>
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
                        <button disabled class="btn btn-primary w-410 form-button form-button-edit mr-280"><b>更新</b></button>
                        <button class="btn btn-primary w-410 form-button form-button-delete" disabled><b>削除</b></button>

                    </div>
                </div>
                <input type="hidden" name="id">

            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.form-button-edit').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.vacation.update_vacation', 'update') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
            $('.formSm').submit();
        });

        $('.form-button-delete').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.vacation.destroy', 'delete') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
            $('.formSm').submit();
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
