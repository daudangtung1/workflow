@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <style>
        

    </style>
@endpush

<div class="row pl-5 pr-5 pt-3">
    <div class="col-md-12">
        <div class="form-group d-search">
            <span class="search pr-2" data-date="{{ $dates['prev'] }}"><i class="fas fa-caret-left"></i></span>
            <span>{{ $dates['current_text'] }} - {{ $dates['next_text'] }} </span>
            <span class="search pl-2" data-date="{{ $dates['next'] }}"><i class="fas fa-caret-right"></i></span>
            <!-- /.input group -->
        </div>
    </div>
</div>
<div class="row pl-5 pr-5 pt-3">
    <div class="col-md-12 overflow-auto">
        <table class="table table-bordered table-hover">
            <thead>
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
    <script>
        $(document).on("click", ".search", function() {
            loading();
            let date = $(this).attr('data-date');

            $.ajax({
                url: "{{ route('staff.over-time.show', 'list-over-time') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(res) {
                    let body = '';
                    let redirect = "{{ route('staff.over-time.index') }}";
                    res.data.forEach((item) => {
                        let icon = item.disable ? '<i class="fas fa-lock"></i>' :
                            `<a href="${redirect}?register=${item.id}" ><i class="fas fa-pencil-alt"></i></a>`

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

                    if (res.data.length <= 0)
                        body += (`<tr>
                                <td colspan="7" class="text-center">{{ __('common.data.error') }}</td>
                            </tr>`);

                    $('#bodyOvertime').html(body);

                    //render search
                    let search = (
                        `<span class="search pr-2" data-date="${ res.dates.prev }"><i class="fas fa-caret-left"></i></span>
                        <span>${ res.dates.current_text } - ${ res.dates.next_text }</span>
                        <span class="search pl-2" data-date="${ res.dates.next }"><i class="fas fa-caret-right"></i></span>`
                    );

                    $('.d-search').html(search);

                    unLoading();
                }
            })
        });
    </script>
@endpush
