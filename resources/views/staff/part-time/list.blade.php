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

        .d-search span {
            font-weight: 700;

        }

        .search {
            cursor: pointer;
        }

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
                    <th>開始1</th>
                    <th>終了1</th>
                    <th>開始2</th>
                    <th>終了2</th>
                    <th>開始3</th>
                    <th>終了3</th>
                    <th>時間外計(分)</th>
                    <th>承認日時</th>
                    <th>承認者</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody id="bodyParttime">

            </tbody>
        </table>
    </div>
</div>

{{-- loading --}}

@push('scripts')
    <script>
        $(document).on("click", ".search", function() {
            loading();
            let date = $(this).attr('data-date');

            $.ajax({
                url: "{{ route('staff.part-time.show', 'list-part-time') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(res) {
                    let body = '';
                    let redirect = "{{ route('staff.part-time.index') }}";

                    //render table
                    res.data.forEach((item) => {
                        let icon = item.disable ? '<i class="fas fa-lock"></i>' :
                            `<a  href="${redirect}?register=${item.id}" ><i class="fas fa-pencil-alt"></i></a>`

                        body += (`<tr>
                                <td>${item.date}</td>
                                <td>${item.start_time1}</td>
                                <td>${item.end_time1}</td>
                                <td>${item.start_time2}</td>
                                <td>${item.end_time2}</td>
                                <td>${item.start_time3}</td>
                                <td>${item.end_time3}</td>
                                <td>${item.time}</td>
                                <td>${item.approval_date}</td>
                                <td>${item.approver}</td>
                                <td>${icon}</td>
                            </tr>`);
                    });

                    if (res.data.length <= 0)
                        body += (`<tr>
                                <td colspan="11" class="text-center">{{ __("common.data.error") }}</td>
                            </tr>`);

                    $('#bodyParttime').html(body);

                    //render search
                    let search = (
                        `<span class="search pr-2" data-date="${ res.dates.prev }"><i class="fas fa-caret-left"></i></span>
                        <span>${ res.dates.current_text } - ${ res.dates.next_text }</span>
                        <span class="search pl-2" data-date="${ res.dates.next }"><i class="fas fa-caret-right"></i></span>`
                    );

                    $('.d-search').html(search);

                    unLoading();
                    // $(document).off('click', '#list-tab');
                }
            })
        });
    </script>
@endpush
