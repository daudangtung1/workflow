@push('styles')
    <!-- daterange picker -->
    <style>
       

    </style>
@endpush

<div class="row ">
    <div class="col-md-12">
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
                                    name="end_date" placeholder="年-月-日" required data-toggle="datetimepicker"
                                    value="" />
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
    </div>
</div>
@push('scripts')
    <script>
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
