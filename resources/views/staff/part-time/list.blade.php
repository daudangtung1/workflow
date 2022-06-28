@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <style>
        /* width */
        .date_now {
            /* font-size: 0.85rem; */
            font-size: 15px;
            font-weight: bold;
        }

        .vacation {
            background: #ffebeb;
        }

        /*----*/
        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .box_total {
            border: 1px solid #000;
            padding: 2px 10px;
            font-weight: bold;
        }

        .box_total_title {
            padding-right: 10px;
            border-right: 1px solid #000;
        }

        #get_total {
            padding-left: 10px;
        }
    </style>
@endpush


<div class="tab-content2">
    <div class="row ">
        <div class="col-md-12">
            <div class="flex-between">
                <div class="form-group d-search">
                    <span class="search pr-2" data-date="{{ $dates['prev'] }}"><i class="fas fa-caret-left"></i></span>
                    <span>{{$dates['current_text']}} 分 ({{$dates['prev_text_2']}}~{{$dates['next_text_2']}}) </span>
                    <span class="search pl-2" data-date="{{ $dates['next'] }}"><i class="fas fa-caret-right"></i></span>
                    <!-- /.input group -->
                </div>
                <div class="flex-between box_total">
                    <span class="box_total_title">時間合計(月間)</span>
                    <span id="get_total"></span>
                </div>
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
<input type="hidden" value="{{(\Carbon\Carbon::now()->format('Y-m-d'))}}" id="date_check_now">
<input type="hidden" value="{{URL::current()}}" id="url_check">
{{-- loading --}}

@push('scripts')
<script src="{{ asset('js/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/moment/moment-with-locales.min.js') }}"></script>
<script>
    $(document).on("click", ".search", function() {
        loading();
        let date = $(this).attr('data-date');

        $.ajax({
            url: "{{ route('staff-part-time.show', 'list-part-time') }}",
            type: 'get',
            dataType: 'json',
            data: {
                date: date,
            },
            success: function(res) {
                let body = '';
                let total = 0,
                    total_1 = 0,
                    total_2 = 0,
                    total_3 = 0;
                let total_get = '';
                let redirect = "{{ route('staff-part-time.index') }}";

                //render table
                $.each(res.data, function(key, item) {
                    moment.locale('ja');
                    let icon = item.disable ? '<i class="icofont-lock"></i>' :
                        `<a href="${redirect}?register=${item.id}&date=${key}" class="edit_data"><i class="icofont-pencil-alt-1"></i></a>`
                    body += (`<tr id=${item.date_id}>
                                <td>${moment(new Date(item.date)).format('YYYY/MM/DD (dd)')}</td>
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
                           
                    total_1 = new Date(item.date + item.end_time1) - new Date(item.date + item.start_time1);
                    total_2 = new Date(item.date + item.end_time2) - new Date(item.date + item.start_time2);
                    total_3 = new Date(item.date + item.end_time3) - new Date(item.date + item.start_time3);

                    if (item.end_time1 === '-' || item.start_time1 === '-') total_1 = 0;
                    if (item.end_time2 === '-' || item.start_time2 === '-') total_2 = 0;
                    if (item.end_time3 === '-' || item.start_time3 === '-') total_3 = 0;

                    total += (total_1 + total_2 + total_3) / 60 / 1000;
                    // total_hour=Math.floor(total / 60);
                    // total_minute=total - total_hour * 60;
                    // th_f=total_hour < 10 ? '0' + total_hour : total_hour;
                    // tm_f=total_minute < 10 ? '0' + total_minute : total_minute;
                    // total_get =(th_f + ':' + tm_f);

                });

                if (res.data.length <= 0)
                    body += (`<tr>
                                <td colspan="11" class="text-center">{{ __('common.data.error') }}</td>
                            </tr>`);

                $('body #bodyParttime').html('');
                $('body #bodyParttime').append(body);
                $('body #get_total').html('');
                $('body #get_total').append(total.toLocaleString());

                //render search
                let search = (
                    `<span class="search pr-2" data-date="${ res.dates.prev }"><i class="fas fa-caret-left"></i></span>
                    <span>${res.dates.current_text}</span>
                    <span>分</span>
                    <span class="ml-2">(</span>
                    <span>${res.dates.prev_text_2}</span>
                    <span>~</span>
                    <span>${res.dates.next_text_2}</span>
                    <span>)</span>
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

                $('#bodyParttime > tr').each(function(index) {
                    var date_check = $('#date_check_now').val();
                    if ($(this).data('date') === date_check) {
                        $(this).addClass('date_now');
                    };
                    $(this).on('click', ".edit_data ", function() {
                        // console.log(1);
                    });
                    var data_1 = $(this).data('date');
                    var listCalendar = @json($listCalendar);
                    $.each(listCalendar, function(key, data) {
                        if (data_1 === data.date) {
                            $('#bodyParttime').find(`[data-date='${data.date}']`).addClass('vacation');
                        }
                    })
                });
            }

        });

    });
    let url_check = $('#url_check').val();
    if (window.location.href === url_check) $('#myTab .search').trigger('click');
    else $('#myTab .nav-item:last-child a').trigger('click');

</script>
<script>
    $(document).ajaxComplete(function(){
        var url = $(location).attr('href');
        parts = url.split("/");
        if(parts[parts.length-2]=='data'){
            last_part = parts[parts.length-1];
            var last_part_id= "#" + last_part;
            $('html, body').animate({
                scrollTop:$(last_part_id).offset().top
            }, 200);
        }
    });
</script>
@endpush