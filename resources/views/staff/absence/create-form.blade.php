@push('styles')
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .datepicker-days .weekend {
            background: #FFD1D1 !important;

        }

        .form-group {
            margin-bottom: 0;
        }

        .mt-30 {
            margin-top: 30px;
        }

        label {
            font-weight: 500;
            font-size: 16px;
        }

        input,
        select {
            height: 46px !important;
        }

        label {
            margin-bottom: 6px !important;
        }

        .form-button {
            margin-top: 70px;
            height: 46px;
            font-size: 18px;
            font-weight: 700;
        }

        .tab-content1 {
            padding: 60px 30px 80px 30px;
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

        .fa-calendar-alt {
            width: 56px;
            font-size: 20px
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

        .input-group-text {
            border-radius: 0 0.25rem 0.25rem 0;
            padding: 0;
        }

    </style>
@endpush

<div class="row tab-content1 ">
    <div class="col-md-3">
        <form
            action="{{ isset($infoAbsence->id) ? route('staff.absence.update', $infoAbsence->id) : route('staff.absence.store') }}"
            method="POST">
            @if (isset($infoAbsence->id))
                <input type="hidden" name="_method" value="PUT">
            @endif
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">日付</label>
                        <div class="input-group date input-date" id="date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#date" name="date"
                                placeholder="年-月-日" required data-toggle="datetimepicker"
                                value="{{ isset($infoAbsence->date) ? $infoAbsence->date : '' }}" />
                            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-30">
                    <div class="form-group select-time">
                        <label for="">欠勤時間</label>
                        <select class="chosen-select" name="option">
                            @foreach (\App\Enums\AbsenceOption::asArray() as $item)
                                <option value="{{ $item }}"
                                    {{ isset($infoAbsence->option) && $infoAbsence->option == $item ? 'selected' : '' }}>
                                    {{ \App\Enums\AbsenceOption::getDescription($item) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-30">
                    <div class="form-group">
                        <label for="">理由</label>
                        <textarea class="form-control" name="reason" id="reason" rows="5"
                            required>{{ isset($infoAbsence->reason) ? $infoAbsence->reason : '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    @if (isset($infoAbsence->approver))
                        <button class="btn btn-danger w-100 font-weight-bold" disabled>承認済み</button>
                    @else
                        <button class="btn btn-primary w-100 form-button font-weight-bold">申請(登録) </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';

        $('#date').datetimepicker({
            useCurrent: false,
            format: "YYYY-MM-DD",
            locale: "ja",
            daysOfWeekDisabled: [0, 6],
        });

        $('.chosen-select').select2();

        $("#date").on("change.datetimepicker", function(e) {
            let date = new Date(e.date);
            date = date.toLocaleDateString('fr-CA');

            checkDate(dateNow, date);
        });

        function checkDate(date, dateCheck) {
            $('.form-button').prop('disabled', false);

            if (date > dateCheck)
                $('.form-button').prop('disabled', true);
        }
    </script>
@endpush
