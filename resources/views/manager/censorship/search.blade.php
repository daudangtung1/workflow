@push('styles')
    <!-- daterange picker -->
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .invalid-feedback {
            display: unset;
        }

        input {
            cursor: unset !important;
        }

        .content3 {
            padding: 60px 30px 83px;
        }

        .w-185 {
            width: 185px;
        }

        .span-date {
            display: initial;
            padding-left: 10px;
            padding-right: 11px;
        }

        .inline-flex {
            display: inline-flex
        }


        @media screen and (max-width: 1023px) {
            .span-date {
                display: block;
                padding-left: 0;
                padding-right: 0;
            }

            .w-185 {
                width: 100% !important;
            }

        }

        .mb-83 {
            margin-bottom: 83px !important;
        }

        .mt-50 {
            margin-top: 50px !important;
        }

        .select-100 .select2-container {
            width: 100% !important;
        }

        .icofont-search-2 {
            color: #4B545C !important;
        }

        #home .span-date {
            margin-left: 0px !important;
            margin-right: 0px !important;
        }

        .content-wrapper .content3 .select2-container {
            width: 100% !important;
        }

        .datepicker-days td.disabled2,
        .datepicker-days td.weekend {
            background: #FFD1D1 !important;
            border-radius: 50%;
        }

        .datepicker-days td.active {
            background: #007bff !important;
            border-radius: 0.25rem;
        }

    </style>
@endpush

<form action="{{ route('manager.censorship.search') }}" method="GET">
    <div class="content3">
        <div class="w-410">
            <div class="row">
                <div class="col-md-12">
                    <label for="">日付</label>
                    <div class="form-group">
                        <div class="w-185 inline-flex input-group date input-date" id="date"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input"
                                   data-target="#date" name="date" placeholder="年-月"
                                   data-toggle="datetimepicker" value="{{ request()->date }}"/>
                            <div class="input-group-append" data-target="#date"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="icofont-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.form group -->
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-md-12">
                    <div class="form-group select-time select-100">
                        <label for="">承認状況</label>
                        <select class="chosen-select" name="status_approval">
                            @foreach(\App\Models\OvertimeRegister::$approvalStatus as $key => $status)
                                <option value="{{$key}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary w-100 form-button mb-83 mt-50">検索</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        var d = new Date();
        var month = d.getMonth();
        if (d.getDay() < 10) {
            month = d.getMonth() - 1;
        }
        d.setMonth(month);

        $('#date').datetimepicker({
            changeYear: true,
            changeMonth: true,
            defaultDate: d,
            useCurrent: false,
            format: "YYYY-MM",
            locale: "ja",
            daysOfWeekDisabled: [0, 6],
        });
        $('.chosen-select').select2();
    </script>
@endpush


