@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker/daterangepicker.css') }}">
    <style>
        .date_now{
            /* font-size: 0.85rem; */
            font-size: 15px;
            font-weight: bold;
        }
        .vacation{
            background: #ffebeb;
        }

        /*----*/
        .flex-between{
            display: flex; justify-content: space-between;align-items: center;
        }
        .box_total{
            border: 1px solid #000;
            padding: 2px 10px;font-weight: bold;
        }
        .box_total_title{
            padding-right: 10px;
            border-right: 1px solid #000;
        }
        #get_total{
            padding-left: 10px;
        }
    </style>
@endpush

        <div class="tab-content2">
            <div class="row ">
                <div class="col-md-12">
                <div class="flex-between">
                    <div class="form-group d-search">
                        <span class="search pr-2" data-date="{{ $dates['prev'] }}"><i
                                class="fas fa-caret-left"></i></span>
                        <span>{{$dates['current_text']}} 分 ({{$dates['prev_text_2']}}~{{$dates['next_text_2']}}) </span>
                        <span class="search pl-2" data-date="{{ $dates['next'] }}"><i
                                class="fas fa-caret-right"></i></span>
                        <!-- /.input group -->
                    </div>
                    <div class="flex-between box_total">
                    <span class="box_total_title">時間合計(月間)</span>
                    <span id="get_total"></span>
                </div>
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
<script src="{{ asset('js/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/moment/moment-with-locales.min.js') }}"></script>
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
                    let total=0, total_int='';
                    // let total_1='', total_2='';
                     //render table
                    $.each(res.data, function(key, item) {
                        moment.locale('ja');
                        let icon = item.disable ? '<i class="icofont-lock"></i>' :
                            `<a href="${redirect}?register=${item.id}&date=${key}" ><i class="icofont-pencil-alt-1"></i></a>`

                        body += (`<tr id=${item.date_id}>
                                <td>${moment(new Date(item.date)).format('YYYY/MM/DD (dd)')}</td>
                                <td>${item.start_time}</td>
                                <td>${item.end_time}</td>
                                <td>${item.time}</td>
                                <td>${item.approval_date}</td>
                                <td>${item.approver}</td>
                                <td>${icon}</td>
                            </tr>`);
                            if(item.time !='') total+=item.time;
                            // total_hour=Math.floor(total / 60);
                            //     total_minute=total - total_hour * 60;
                            //     th_f=total_hour < 10 ? '0' + total_hour : total_hour;
                            //     tm_f=total_minute < 10 ? '0' + total_minute : total_minute;
                            //     total_get =(th_f + ':' + tm_f);
                    });
                    if (res.data.length <= 0)
                        body += (`<tr>
                                <td colspan="7" class="text-center">{{ __('common.data.error') }}</td>
                            </tr>`);

                    $('#bodyOvertime').html(body);
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
