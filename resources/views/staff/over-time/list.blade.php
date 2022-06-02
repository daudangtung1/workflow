@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <style>
        .date_now{
            font-size: 0.85rem;
            font-weight: bold;
        }
        .vacation{
            background: #ffebeb;
        }
    </style>
@endpush

        <div class="tab-content2">
            <div class="row ">
                <div class="col-md-12">
                    <div class="form-group d-search">
                        <span class="search pr-2" data-date="{{ $dates['prev'] }}"><i
                                class="fas fa-caret-left"></i></span>
                        <span>{{ $dates['current_text_full'] }} - {{ $dates['next_text_full'] }} </span>
                        <span class="search pl-2" data-date="{{ $dates['next'] }}"><i
                                class="fas fa-caret-right"></i></span>
                        <!-- /.input group -->
                    </div>
                </div>

                <div class="col-md-12 overflow-auto">
                    <table class="table table-bordered table-hover m-0">
                        <thead>
                            <tr>
                                <th class="w-150">日付</th>
                                <th class="w-120">開始時刻</th>
                                <th class="w-120">終了時刻</th>
                                <th class="w-120">時間外計(分)</th>
                                <th class="w-150">承認日時</th>
                                <th class="w-150">承認者</th>
                                <th class="w-150">編集</th>
                            </tr>
                        </thead>
                        <tbody id="bodyOvertime">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<input type="hidden" value="{{(\Carbon\Carbon::now()->format('Y-m-d'))}}" id="date_check_now">
<input type="hidden" value="{{URL::current()}}" id="url_check">
@push('scripts')
    <script>
        $(document).on("click", ".search", function() {
            loading();
            let date = $(this).attr('data-date');
            
            $.ajax({
                url: "{{ route('staff-over-time.show', 'list-over-time') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    date: date,
                },
                success: function(res) {
                    let body = '';
                    let redirect = "{{ route('staff-over-time.index') }}";
                     //render table
                    $.each(res.data, function(key, item) {
                        let icon = item.disable ? '<i class="icofont-lock"></i>' :
                            `<a href="${redirect}?register=${item.id}&date=${key}" ><i class="icofont-pencil-alt-1"></i></a>`

                        body += (`<tr data-date=${item.date}>
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
                        <span>${ res.dates.current_text_full } <span class="ml-2 mr-2">-</span> ${ res.dates.next_text_full }</span>
                        <span class="search pl-2" data-date="${ res.dates.next }"><i class="fas fa-caret-right"></i></span>`
                    );

                    $('.d-search').html(search);
                    $('body').css({
                        'overflow': 'auto',
                        'padding': 0,
                    });

                    unLoading();
                    var date_check=$('#date_check_now').val();
                    $('#bodyOvertime > tr').each(function(index){
                        if($(this).data('date') === date_check) {
                            $(this).addClass('date_now');
                        };
                        var data_1=$(this).data('date');
                        var listCalendar = @json($listCalendar);
                        $.each(listCalendar, function(key, data){
                            if(data_1===data.date){
                                $('#bodyOvertime').find(`[data-date='${data.date}']`).addClass('vacation');
                            }
                        })
                    });
                }
            })
        });
        let url_check=$('#url_check').val();
        if(window.location.href === url_check) $('#myTab .search').trigger('click');
        else $('#myTab .nav-item:last-child a').trigger('click');
    </script>
@endpush
