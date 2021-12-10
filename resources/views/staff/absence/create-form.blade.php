@push('styles')
    <style>
       
    </style>
@endpush


        <div class="tab-content1">
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
                                <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                    name="date" placeholder="年-月-日" required data-toggle="datetimepicker"
                                    value="{{ isset($infoAbsence->date) ? $infoAbsence->date : '' }}" />
                                <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="icofont-calendar"></i></div>
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
                    <div class="col-md-12 mt-30">
                        <div class=" form-group">
                            @if (isset($infoAbsence->approver))
                                <button class="btn btn-danger w-100" disabled>承認済み</button>
                            @else
                                <button class="btn btn-primary w-100 form-button">申請(登録) </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
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
