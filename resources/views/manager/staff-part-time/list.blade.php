@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <style>
        /* width */

    </style>
@endpush


<div class="tab-content2">
    <div class="row ">
        <div class="col-md-12">
            <div class="form-group d-search">
                <span class="search pr-2" data-date="{{ $dates['prev'] }}"><i class="fas fa-caret-left"></i></span>
                <span>{{ $dates['current_text'] }} - {{ $dates['next_text'] }} </span>
                <span class="search pl-2" data-date="{{ $dates['next'] }}"><i class="fas fa-caret-right"></i></span>
                <!-- /.input group -->
            </div>
        </div>
        <div class="col-md-12 overflow-auto scroll-table">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th class="w-150">日付</th>
                        <th>開始1</th>
                        <th>終了1</th>
                        <th>開始2</th>
                        <th>終了2</th>
                        <th>開始3</th>
                        <th>終了3</th>
                        <th>時間外計(分)</th>
                        <th>承認日時</th>
                        <th class="w-150">承認者</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody id="bodyParttime">

                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- loading --}}

@push('scripts')
    <script>
        $(document).on("click", ".search", function() {
            loading();
            let date = $(this).attr('data-date');

            $.ajax({
                url: "{{ route('manager.staff-part-time.show', 'list-part-time') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(res) {
                    let body = '';
                    let redirect = "{{ route('manager.staff-part-time.index') }}";

                    //render table
                    $.each(res.data, function(key, item) {
                        let icon = item.disable ? '<i class="icofont-lock"></i>' :
                            `<a  href="${redirect}?register=${item.id}&date=${key}" ><i class="icofont-pencil-alt-1"></i></a>`

                        body += (`<tr>
                                <td >${item.date}</td>
                                <td>${item.start_time1}</td>
                                <td>${item.end_time1}</td>
                                <td>${item.start_time2}</td>
                                <td>${item.end_time2}</td>
                                <td>${item.start_time3}</td>
                                <td>${item.end_time3}</td>
                                <td>${item.time}</td>
                                <td>${item.approval_date}</td>
                                <td >${item.approver}</td>
                                <td>${icon}</td>
                            </tr>`);

                    })

                    if (res.data.length <= 0)
                        body += (`<tr>
                                <td colspan="11" class="text-center">{{ __('common.data.error') }}</td>
                            </tr>`);

                    $('body #bodyParttime').html('');
                    $('body #bodyParttime').append(body);


                    //render search
                    let search = (
                        `<span class="search pr-2" data-date="${ res.dates.prev }"><i class="fas fa-caret-left"></i></span>
                        <span >${ res.dates.current_text } <span class="ml-2 mr-2">-</span> ${ res.dates.next_text }</span>
                        <span class="search pl-2" data-date="${ res.dates.next }"><i class="fas fa-caret-right"></i></span>`
                    );

                    $('.d-search').html(search);

                    unLoading();
                    // $(document).off('click', '#list-tab');

                    $('body').css({
                        'height': '100vh !important',
                        'overflow': 'auto',
                        'padding': 0,
                    });
                    //scrollbar
                    $('.scroll-table').floatingScrollbar();
                }
            })
        });
    </script>
@endpush
