@push('styles')
    <!-- daterange picker -->
    <style>
        .datepicker-days td.disabled {
            background: #FFD1D1 !important;
            border-radius: 50%;
        }

        .select-time .select2-selection {
            height: 46px !important;
        }

        .select-time .select2-selection__rendered {
            line-height: 40px !important;
        }

        .select-time .select2-selection__arrow {
            height: 46px !important;
            line-height: 30px !important;
            width: 56px !important;
            border-radius: 0 0.25rem 0.25rem 0 !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            right: 0px !important;
            top: 0;
            border-radius: 0 0.25rem 0.25rem 0 !important;
            border: 1px solid #ced4da !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder,
        .select2-search__field {
            font-size: 16px !important;
        }

    </style>
@endpush


<div class="tab-content1">
    <form
        action="{{ isset($infoVacation) ? route('staff.vacation.update', $infoVacation['id']) : route('staff.vacation.store') }}"
        method="POST">
        @csrf
        @if (isset($infoVacation))
            <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="row">
            <div class="col-md-12">
                <label for="">日付</label>
                <div class="form-group ">
                    <div class=" input-group date input-date d-inlin-flex col-mobile-date" id="start_date"
                        data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#start_date"
                            name="start_date" placeholder="年-月-日" required data-toggle="datetimepicker"
                            value="{{ isset($infoVacation) ? $infoVacation['start_date'] : '' }}" />
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="icofont-calendar"></i></div>
                        </div>
                    </div>
                    <div class="text-center span-date col-mobile">~</div>
                    <div class="input-group date input-date d-inlin-flex col-mobile-date" id="end_date"
                        data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#end_date"
                            name="end_date" placeholder="年-月-日" required data-toggle="datetimepicker" value="" />
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
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
                            <label class="d-block" for="">種別</label>
                            <table>
                                @php($i = 0)
                                @foreach (collect(\App\Enums\VacationType::asArray())->chunk(3)->all()
    as $chunk)
                                    @php($i++)

                                    @if ($i <= 2)
                                        </tr>
                                        @foreach ($chunk as $item)
                                            <td class="pr-4">
                                                <div class="col-radio d-radio col-mobile">
                                                    <input type="radio" id="day{{ $item }}" name="type" required
                                                        value="{{ $item }}"
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
                                            <td class="pr-4">
                                                <div class="col-radio d-radio col-mobile">
                                                    <input type="radio" id="vacation" name="type" value="vacation" required
                                                        {{ isset($infoVacation) && $infoVacation['type'] > 6 ? 'checked' : '' }}>
                                                    <label for="vacation">
                                                        欠勤
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="pr-4">
                                                <div class="form-group select-time">
                                                    <select class="chosen-select" name="option_vacation">
                                                        @foreach ($chunk as $item)
                                                            <option value="{{ $item }}"
                                                                {{ isset($infoVacation) && $infoVacation['type'] == $item ? 'selected' : '' }}>
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

            <div class="col-md-12">
                @if (isset($infoVacation) && $infoVacation['disable'])
                    <button class="btn btn-danger w-100  w-410" disabled>承認済み</button>
                @else
                    <button class="btn btn-primary w-100 form-button  w-410">申請(登録) </button>

                @endif
            </div>
        </div>
    </form>
</div>

@push('scripts')

    <script>
        $('.chosen-select').select2();
        $('.input-date').datetimepicker({
            format: "YYYY-MM-DD",
            locale: "ja",
            disabledDates: [
                @foreach ($listCalendar as $item)
                    moment("{{ $item->date }}"),
                @endforeach
            ],
            daysOfWeekDisabled: [0, 6],
        });
        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';

        $("#start_date").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            if (date != 'Invalid Date' && date != '1970-01-01') {
                $('input[name=end_date]').val(date);
            } else {
                $('input[name=end_date]').val('');
            }

            $('.form-button').prop('disabled', false);

            checkDate(dateNow, date);
        });

        $("#end_date").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            let startDate = $('input[name=start_date]').val();

            $('.form-button').prop('disabled', false);

            checkDate(startDate, date);
        });

        function checkDate(date, dateCheck) {
            $('.form-button').prop('disabled', false);

            if (date > dateCheck)
                $('.form-button').prop('disabled', true);
        }

        @if (isset($infoVacation))
            setTimeout(() => {
            $('input[name=end_date]').val(`{{ $infoVacation['end_date'] }}`);
            }, 1000);
        @endif
    </script>
@endpush
