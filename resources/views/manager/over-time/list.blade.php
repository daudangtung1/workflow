@push('styles')
    <!-- daterange picker -->
    <style>
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


        .check-all {
            text-decoration: underline;
        }



        @media only screen and (max-width: 600px) {
            .check-all {
                top: -5px !important;
            }

            .form-button {
                width: 100% !important;
            }

            #myTab li {
                width: 120px !important;
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

    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/buttons.bootstrap4.min.css') }}">
@endpush

        <form action="{{ route('manager.over-time.update', 'all') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="content3">
                <div class="row">
                    {{-- <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 text-right">
                            <a class="check-all pr-5" href="javascript:void(0)">全てチェック</a>
                        </div>
                    </div>
                </div> --}}
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover" id="example">
                            <thead>
                                <tr>
                                    <th class="w-150">日付</th>
                                    <th class="w-140">申請者</th>
                                    <th class="w-140">所属事業所</th>
                                    <th class="w-140">開始時刻</th>
                                    <th class="w-140">終了時刻</th>
                                    <th class="w-140">時間外計(分)</th>
                                    <th class="w-140">承認者</th>
                                    <th class="w-150">承認日時</th>
                                    <th class="w-140">総務承認</th>
                                    <th class="w-140">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataRegister as $item)
                                    <tr>
                                        <td>{{ $item['date'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>{{ $item['branch'] }}</td>
                                        <td>{{ $item['start_time'] }}</td>
                                        <td>{{ $item['end_time'] }}</td>
                                        <td>{{ $item['time'] }}</td>
                                        <td>{{ $item['approver'] }}</td>
                                        <td>{{ $item['approval_date'] }}</td>
                                        <td>
                                            @if (!$item['manager_confirm'])
                                            <label class="custom-check">
                                                <input type="checkbox" name="id[]" class="check-one"
                                                    value="{{ $item['id'] }}">
                                            <span class="checkmark"></span>
                                            </label>
                                            @endif
                                        </td>
                                        <td> <a href="javascript:void(0)" class="btnEdit"
                                                data-id="{{ $item['id'] }}"
                                                data-date="{{ $item['date_register'] }}"
                                                data-start_time_working="{{ $item['start_time_working'] }}"
                                                data-end_time_working="{{ $item['end_time_working'] }}"
                                                data-user-id="{{ $item['user_id'] }}">
                                                <i class="icofont-pencil-alt-1"></i></a></td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">{{ __('common.data.error') }}</td>
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

                    <div class="col-md-12 mt-30 text-right"><button
                            class="btn btn-primary  form-button-list form-button" disabled>承認</button>
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


    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                buttons: [{
                    extend: 'csv',
                    text: '<b>CSVダウンロード</b>'
                }]
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

            let divCsv = $('#example_wrapper').children().children();
            $('#example_wrapper').children().find(divCsv[0])
                .prepend(
                    '<a class="back" href="{{ route('manager.over-time.index') }}""><i class="right fas fa-caret-left "></i> <span class="ml-2 mr-40 back">戻る</span></a>'
                );
            $('#example_wrapper').children().find(divCsv[0]).css('margin-bottom', '20px');

            $('#example_wrapper').children().find(divCsv[1])
                .addClass('text-right').html(
                    '<a class="check-all pr-5 font-weight-bold" style="position: relative; top: 37px" href="javascript:void(0)">全てチェック</a>'
                );
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

        function checkSubmit() {
            if ($('.check-one:checked').length > 0) {
                $('.form-button-list').prop('disabled', false);
            } else {
                $('.form-button-list').prop('disabled', true);
            }
        }

        $('.btnEdit').click(function() {
            $('#edit-tab').click();
            $('#edit-tab').parent().removeClass('d-none');

            let date = $(this).data('date');
            let userId = $(this).data('user-id');
            let id = $(this).data('id');
            let startTime = $(this).data('start_time_working');
            let endTime = $(this).data('end_time_working');
            
            $('input[name=date]').val(date);
            $('select[name=user_register]').val(userId).trigger('change');
            $('input[name=id]').val(id);

            setSelectTime(startTime, endTime);

            setTimeout(() => {
                getData(id);
            }, 500);
        });

        function setSelectTime (startTime, endTime) {
            // let startTime = $('select[name=user_register] option:selected').data('start-time');
            // let endTime = $('select[name=user_register] option:selected').data('end-time');

            //set value input
            $('input[name=start_time_working]').val(startTime);
            $('input[name=end_time_working]').val(endTime);
            $('#span_start').html(startTime);
            $('#span_end').html(endTime);

            $.ajax({
                url: "{{ route('manager.over-time.edit', 'getTime') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    start_time_working: startTime,
                    end_time_working: endTime,
                },
                success: function(data) {
                    $('select[name=start_time]').empty();
                    $('select[name=start_time]').append($('<option>').attr('value', '')
                        .text(''))

                    $.each(data.start, function(key, item) {
                        let time = item['hour'] + ':' + item['minutes']['00'];
                        $('select[name=start_time]').append($('<option>').attr('value', time)
                            .text(time))

                        if (item['minutes']['30']) {
                            let time = item['hour'] + ':' + item['minutes']['30'];
                            $('select[name=start_time]').append($('<option>').attr('value',
                                time).text(time))
                        }
                    });

                    $('select[name=start_time]').trigger('change');

                    $(`select[name=start_time]`).select2({
                        placeholder: '07:30',
                        allowClear: true,
                    });

                    //end time
                    $('select[name=end_time]').empty();
                    $('select[name=end_time]').append($('<option>').attr('value', '')
                        .text(''));

                    $.each(data.end, function(key, item) {
                        if (item['minutes']['00']) {
                            let time = item['hour'] + ':' + item['minutes']['00'];
                            $('select[name=end_time]').append($('<option>').attr('value', time)
                                .text(time))
                        }

                        let time = item['hour'] + ':' + item['minutes']['30'];
                        $('select[name=end_time]').append($('<option>').attr('value', time)
                            .text(time))
                    });

                    $('select[name=end_time]').trigger('change');

                    $(`select[name=end_time]`).select2({
                        placeholder: '17:30',
                        allowClear: true,
                    });
                    $('.select-min .select2-selection__arrow').html('<i class="icofont-clock-time"></i>');

                }
            });

        }
    </script>
@endpush
