@push('styles')
    <!-- daterange picker -->
    <style>
        
        #list table {
            table-layout: unset !important;
        }
        
        #list table a {
            color: #000 !important;
        }

        #list table thead {
            background: #E8EDF4;
            font-weight: 700;
            font-size: 14px;

        }

        #list th {
            padding: 10px 15px 9px !important;
        }

        #list td {
            padding: 10px 15px 9px !important;
            width: 140px !important;
        }


        input[type="checkbox"] {
            width: 22px;
            height: 22px !important;
        }

        a {
            color: #000000
        }

        #example_wrapper button {
            background-color: #3490dc;
            border-color: #3490dc;
            width: 250px;
        }

        .w-150 {
            width: 150px !important;
        }

        .w-140 {
            width: 140px !important;
        }

        .w-279 {
            width: 270px !important;
        }

        .content3 {
            padding: 20px 30px 200px;
        }

        .form-button-list {
            width: 289px;
            margin-top: 30px !important;
            margin-bottom: 0 !important
        }

        .buttons-csv {
            height: 46px !important;
            width: 200px !important;
            font-size: 18px;
        }

        .mr-40 {
            margin-right: 40px !important;
        }

        .back {
            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            color: #1F232E;
        }

        .w-150 {
            width: 150px !important;
        }

        .w-160 {
            width: 160px !important;
        }

        #list table thead .w-auto {
            width: auto !important;
        }

        .check-all {
            text-decoration: underline;
        }
        
        @media only screen and (max-width: 600px) {
            .check-all {
                top: 0px !important;
            }
            .form-button {
                width: 100% !important;
            }

            
        }

        .back:hover {
            color: #1F232E;
        }

        .check-all:hover {
            text-decoration: underline;
            color: #1F232E;
        }

        .buttons-csv:hover {
            background-color: #227dc7 !important;
            border-color: #2176bd !important;
        }

        .content3 .text-right{
            display: flex;
            align-items: flex-end;
            flex-direction: column;
        }
        .content3 .text-right button{
            width: 263px !important;
            background-color: #3490dc;
            border-color: #3490dc;
        }

        .vacation{
            background: #ffebeb;
        }

        .color-red{
            color: red;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/buttons.bootstrap4.min.css') }}">
@endpush

        <form action="{{ route('manager.part_time.update', 'all') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="content3">
                <div class="row">
                    <div class="col-md-12 ">
                        <table class="table table-bordered table-hover" id="example">
                            <thead>
                                <tr>
                                    <th class="w-auto">日付(開始)</th>
                                    <th class="w-auto">申請者</th>
                                    <th class="w-auto">所属事業所</th>

                                    <th class="w-auto">開始1</th>
                                    <th class="w-auto">終了1</th>
                                    <th class="w-auto">開始2</th>
                                    <th class="w-auto">終了2</th>
                                    <th class="w-auto">開始3</th>
                                    <th class="w-auto">終了3</th>
                                    <th class="w-auto">時間外計(分)</th>
                                    <th class="w-auto">承認者</th>
                                    <th class="w-auto">総務承認</th>
                                    <th class="w-auto">修正</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataPartTime as $key=> $item)
                                @if(in_array($item['date'], $listCalendarData))
                                    <tr class="vacation">
                                        <td>{{ $item['date'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>{{ $item['branch'] }}</td>

                                        @if($item['start_time1'] == $item['start_time_working'])
                                            <td>{{ $item['start_time1'] }}</td>
                                        @else
                                            @if($item['start_time1'] == '-')
                                                <td>{{ $item['start_time1'] }}</td>
                                            @else
                                                <td class="color-red">{{ $item['start_time1'] }}</td>
                                            @endif
                                        @endif

                                        <td>{{ $item['end_time1'] }}</td>
                                        <td>{{ $item['start_time2'] }}</td>

                                        @if($item['end_time2'] == $item['end_time_working'])
                                            <td>{{ $item['end_time2'] }}</td>
                                        @else
                                            @if($item['end_time2'] == '-')
                                                <td>{{ $item['end_time2'] }}</td>
                                            @else
                                                <td class="color-red">{{ $item['end_time2'] }}</td>
                                            @endif
                                        @endif
                                        
                                        <td>{{ $item['start_time3'] }}</td>
                                        <td>{{ $item['end_time3'] }}</td>
                                        <td>{{ $item['time'] }}</td>

                                        <td>{{ $item['approver'] }}</td>
                                        <td>{{ $item['approval_date'] }}</td>
                                        {{--<td>
                                            @if (!$item['manager_confirm'])
                                            <label class="custom-check">
                                            <input type="checkbox" name="id[]" class="check-one"
                                            value="{{ $item['id'] }}">
                                            <span class="checkmark"></span>
                                            @endif
                                        </td>--}}
                                        <td> <a href="javascript:void(0)" class="btnEdit"
                                                data-id="{{ $item['id'] }}" data-user-id="{{ $item['user_id'] }}"
                                                    data-date="{{ $item['date_register'] }}"
                                                    data-start-time1="{{ $item['start_time1'] != '-' ? $item['start_time1'] : '' }}"
                                                    data-end-time1="{{ $item['end_time1'] != '-' ? $item['end_time1'] : '' }}"
                                                    data-start-time2="{{ $item['start_time2'] != '-' ? $item['start_time2'] : '' }}"
                                                    data-end-time2="{{ $item['end_time2'] != '-' ? $item['end_time2'] : '' }}"
                                                    data-start-time3="{{ $item['start_time3'] != '-' ? $item['start_time3'] : '' }}"
                                                    data-end-time3="{{ $item['end_time3'] != '-' ? $item['end_time3'] : '' }}"
                                                    data-manager="{{ $item['manager_confirm'] }}"
                                                    data-approver="{{ $item['approver_id'] }}"
                                                    data-approval-date="{{ $item['approval_date'] }}">
                                                    <i class="icofont-pencil-alt-1"></i></a>
                                        </td>
                                    </tr>
                                    @unset($item['date'])
                                @else
                                    <tr>
                                        <td>{{ $item['date'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>{{ $item['branch'] }}</td>

                                        @if($item['start_time1'] == $item['start_time_working'])
                                            <td>{{ $item['start_time1'] }}</td>
                                        @else
                                            @if($item['start_time1'] == '-')
                                                <td>{{ $item['start_time1'] }}</td>
                                            @else
                                                <td class="color-red">{{ $item['start_time1'] }}</td>
                                            @endif
                                        @endif

                                        <td>{{ $item['end_time1'] }}</td>
                                        <td>{{ $item['start_time2'] }}</td>

                                        @if($item['end_time2'] == $item['end_time_working'])
                                            <td>{{ $item['end_time2'] }}</td>
                                        @else
                                            @if($item['end_time2'] == '-')
                                                <td>{{ $item['end_time2'] }}</td>
                                            @else
                                                <td class="color-red">{{ $item['end_time2'] }}</td>
                                            @endif
                                        @endif

                                        <td>{{ $item['start_time3'] }}</td>
                                        <td>{{ $item['end_time3'] }}</td>
                                        <td>{{ $item['time'] }}</td>

                                        <td>{{ $item['approver'] }}</td>
                                        <td>{{ $item['approval_date'] }}</td>
                                        <td> <a href="javascript:void(0)" class="btnEdit"
                                                data-id="{{ $item['id'] }}" data-user-id="{{ $item['user_id'] }}"
                                                    data-date="{{ $item['date_register'] }}"
                                                    data-start-time1="{{ $item['start_time1'] != '-' ? $item['start_time1'] : '' }}"
                                                    data-end-time1="{{ $item['end_time1'] != '-' ? $item['end_time1'] : '' }}"
                                                    data-start-time2="{{ $item['start_time2'] != '-' ? $item['start_time2'] : '' }}"
                                                    data-end-time2="{{ $item['end_time2'] != '-' ? $item['end_time2'] : '' }}"
                                                    data-start-time3="{{ $item['start_time3'] != '-' ? $item['start_time3'] : '' }}"
                                                    data-end-time3="{{ $item['end_time3'] != '-' ? $item['end_time3'] : '' }}"
                                                    data-manager="{{ $item['manager_confirm'] }}"
                                                    data-approver="{{ $item['approver_id'] }}"
                                                    data-approval-date="{{ $item['approval_date'] }}">
                                                    <i class="icofont-pencil-alt-1"></i></a>
                                        </td>
                                    </tr>
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="14" class="text-center">{{ __('common.data.error') }}</td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                        <td class="d-none"></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mt-30 text-right">
                        <!-- <button class="btn btn-primary  form-button-list form-button" disabled>承認</button> -->
                </div>
                </div>
            </div>
        </form>
  

{{-- loading --}}

@push('scripts')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/datatables/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var d={{\Carbon\Carbon::now()->format('Ymd')}};
            var table = $('#example').DataTable({
                lengthChange: false,
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": false,
                buttons: [{
                    extend: 'csv',
                    text: '<b>CSVダウンロード</b>',
                    title: '時間外申請明細_'+d,
                }]
            });

            table.buttons().container().appendTo('.content3 .col-md-12.mt-30.text-right:eq(0)');

            let divCsv = $('#example_wrapper').children().children();
            $('#example_wrapper').children().find(divCsv[0])
                .prepend(
                    '<a class="back" href="{{ route('manager.part_time.index') }}"><i class="right fas fa-caret-left "></i> <span class="ml-2 mr-40 back">戻る</span></a>'
                );

                $('#example_wrapper').children().find(divCsv[0]).css('margin-bottom', '20px');

            $('#example_wrapper').children().find(divCsv[1])
                // .addClass('text-right').html(
                //     '<a class="check-all pr-5 font-weight-bold" style="position: relative; top: 45px" href="javascript:void(0)">全てチェック</a>');

                    $('.dataTable').parent().addClass('overflow-auto');
        });

        $(document).on('click', '.check-all', function() {
            if ($('.check-one').length == $('.check-one:checked').length) {
                $('.check-one').prop('checked', false)
            } else {
                $('.check-one').prop('checked', true)
            }

            checkSubmit();
        })

        $('.check-one').click(function() {
            checkSubmit();
        })

        // function checkSubmit() {
        //     if ($('.check-one:checked').length > 0) {
        //         $('.form-button-list').prop('disabled', false);
        //     } else {
        //         $('.form-button-list').prop('disabled', true);
        //     }
        // }

        $('.btnEdit').click(function() {
            $('.form-button').prop('disabled', false);
            $('#edit-tab').parent().removeClass('d-none');
            $('#edit-tab').click();

            let date = moment($(this).data('date')).format('YYYY/MM/DD');
            let manager = $(this).data('manager');
            let approvalDate = moment($(this).data('approval-date').split(' ')[0]).format('YYYY/MM/DD');
            let approver = $(this).data('approver');
            let userId = $(this).data('user-id');
            let id = $(this).data('id');
            let startTime1 = $(this).data('start-time1');
            let endTime1 = $(this).data('end-time1');
            let startTime2 = $(this).data('start-time2');
            let endTime2 = $(this).data('end-time2');
            let startTime3 = $(this).data('start-time3');
            let endTime3 = $(this).data('end-time3');

            $('input[name=date]').val(date);
            $('select[name=approver]').val(approver).trigger('change');
            $('input[name=approval_date]').val(approvalDate);
            $('select[name=user_register]').val(userId).trigger('change');
            $(`select[name=manager_status_edit]`).val(manager).trigger('change');
            $('input[name=id]').val(id);

            $(`input[name=start_time_first]`).val(startTime1).trigger('change');
            $(`input[name=end_time_first]`).val(endTime1).trigger('change');

            $(`input[name=start_time_second]`).val(startTime2).trigger('change');
            $(`input[name=end_time_second]`).val(endTime2).trigger('change');

            $(`input[name=start_time_third]`).val(startTime3).trigger('change');
            $(`input[name=end_time_third]`).val(endTime3).trigger('change');

            if (!manager)
                $(`select[name=manager_status_edit]`).val('{{ \App\Enums\ManagerStatus::PENDING }}').trigger(
                    'change');
            //getData(id);

            $('#date input').trigger('click');
            $('#date input').trigger('click');

            $('#approval_date input').trigger('click');
            $('#approval_date input').trigger('click');
        })
    </script>
@endpush
