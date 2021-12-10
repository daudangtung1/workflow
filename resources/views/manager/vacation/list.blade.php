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

        .w-150 {
            width: 150px !important;
        }

        .w-160 {
            width: 160px !important;
        }

        #list table thead th .w-280 {
            width: 480px !important;
        }

        #list table thead .w-140 {
            width: 120px !important;
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


    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/buttons.bootstrap4.min.css') }}">
@endpush

        <div class="content3">
            <form action="{{ route('manager.vacation.update', 'all') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 overflow-auto">
                        <table class="table table-bordered table-hover" id="example">
                            <thead>
                                <tr>
                                    <th class="w-160">日付(開始)</th>
                                    <th class="w-160">日付(終了)</th>
                                    <th class="w-150">申請者</th>
                                    <th class="w-150">所属事業所</th>
                                    <th class="w-160">種別</th>
                                    <th style="width: 410px !important">理由</th>
                                    <th class="w-160">承認日時</th>
                                    <th class="w-160">承認者</th>
                                    <th class="w-160">総務承認</th>
                                    <th class="w-160">編集</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataVacation as $item)
                                    <tr>
                                        <td>{{ $item['start_date'] }}</td>
                                        <td>{{ $item['end_date'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>{{ $item['branch'] }}</td>
                                        <td>{{ $item['type_name'] }}</td>
                                        <td>{{ $item['reason'] }}</td>
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
                                                data-id="{{ $item['id'] }}" data-user-id="{{ $item['user_id'] }}"
                                                data-start-date="{{ $item['start_date_register'] }}"
                                                data-end-date="{{ $item['end_date_register'] }}"
                                                data-type="{{ $item['type'] }}"
                                                data-reason="{{ $item['reason'] }}"
                                                data-manager="{{ $item['manager_confirm'] }}"
                                                data-approver="{{ $item['approver_id'] }}"
                                                data-approval-date="{{ $item['approval_date'] }}">
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
            </form>
        </div>


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
                "responsive": false,
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
                    '<a class="back" href="{{ route('manager.vacation.index') }}"><i class="right fas fa-caret-left "></i> <span class="ml-2 mr-40 back">戻る</span></a>'
                );

            $('#example_wrapper').children().find(divCsv[0]).css('margin-bottom', '20px');

            $('#example_wrapper').children().find(divCsv[1])
                .addClass('text-right').html(
                    '<a class="check-all pr-5 font-weight-bold" style="position: relative; top: 45px" href="javascript:void(0)">全てチェック</a>');

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
            $('.form-button').prop('disabled', false);

            $('#edit-tab').click();

            let date = $(this).data('date');
            let startDate = $(this).data('start-date');
            let endDate = $(this).data('end-date');
            let manager = $(this).data('manager');
            let approvalDate = $(this).data('approval-date');
            let approver = $(this).data('approver');
            let userId = $(this).data('user-id');
            let id = $(this).data('id');
            let type = $(this).data('type');
            let reason = $(this).data('reason');

            $(`input.radio[value=${type}]`).prop('checked', true);
            $('input[name=start_date_register]').val(startDate);
            $('input[name=end_date_register]').val(endDate);
            $('select[name=approver]').val(approver).trigger('change');
            $('input[name=approval_date]').val(approvalDate);
            $('select[name=user_register]').val(userId).trigger('change');
            $(`select[name=manager_status_edit]`).val(manager).trigger('change');
            $('input[name=id]').val(id);
            $('textarea[name=reason]').val(reason);

            if (!manager)
                $(`select[name=manager_status_edit]`).val('{{ \App\Enums\ManagerStatus::PENDING }}').trigger(
                    'change');
            //getData(id);
        })
    </script>
@endpush
