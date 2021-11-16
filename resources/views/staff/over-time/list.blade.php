@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <style>
        table a {
            color: #000 !important;
        }
        table thead {
            background: #E8EDF4;
        }
    </style>
@endpush

<div class="row pl-5 pr-5 pt-3">
    <div class="col-md-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="text" class="form-control float-right" id="reservation" value="">
            </div>
            <!-- /.input group -->
        </div>
    </div>
</div>
<div class="row pl-5 pr-5 pt-3">
    <div class="col-md-12 overflow-auto">
        <table class="table table-bordered table-hover">
            <thead >
                <tr>
                    <th>日付</th>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                    <th>時間外計(分)</th>
                    <th>承認日時</th>
                    <th>承認者</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody id="bodyOvertime">

            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        //Date range picker
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'YYYY/MM/DD',
            }
        });
        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            let from = picker.startDate.format('YYYY-MM-DD');
            let to = picker.endDate.format('YYYY-MM-DD');
            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));

            $.ajax({
                url: "{{ route('staff.over-time.show', 'list-over-time') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    from: from,
                    to: to,
                },
                success: function(data) {
                    let body = '';
                    let redirect = "{{ route('staff.over-time.index') }}";
                    data.forEach((item) => {
                        let icon = item.disable ? '<i class="fas fa-lock"></i>' :
                            `<a target="_blank" href="${redirect}?register=${item.id}" ><i class="fas fa-pencil-alt"></i></a>`

                        body += (`<tr>
                                <td>${item.date}</td>
                                <td>${item.start_time}</td>
                                <td>${item.end_time}</td>
                                <td>${item.time}</td>
                                <td>${item.approval_date}</td>
                                <td>${item.approver}</td>
                                <td>${icon}</td>
                            </tr>`);
                    });

                    $('#bodyOvertime').html(body);
                }
            })
        });
    </script>
@endpush
