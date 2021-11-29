@push('styles')
    <!-- daterange picker -->
    <style>
        table a {
            color: #000 !important;
        }

        table thead {
            background: #E8EDF4;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px
        }

        a {
            color: #000000
        }

        #example_wrapper button {
            background-color: #3490dc;
            border-color: #3490dc;
            width: 250px;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/buttons.bootstrap4.min.css') }}">
@endpush
<div class="row pb-3">
    <div class="col-md-12 pr-5 mt-5">
        <form action="{{ route('manager.vacation.update', 'all') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row pl-5 pt-3">
                <div class="col-md-12 overflow-auto">
                    <table class="table table-bordered table-hover" id="example">
                        <thead>
                            <tr>
                                <th>日付(開始)</th>
                                <th>日付(終了)</th>
                                <th>申請者</th>
                                <th>所属事業所</th>
                                <th>種別</th>
                                <th>理由</th>
                                <th>承認日時</th>
                                <th>承認者</th>
                                <th>総務承認</th>
                                <th>編集</th>
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
                                            <input type="checkbox" name="id[]" class="check-one"
                                                value="{{ $item['id'] }}">
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
                                            <i class="fas fa-pencil-alt"></i></a></td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">{{ __('common.data.error') }}</td>
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
            </div>
            <div class="row pl-5">
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4 "><button
                                class="btn btn-primary w-100 form-button-list font-weight-bold" disabled>承認</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
                    '<a href="{{ route('manager.vacation.index') }}"><i class="right fas fa-caret-left "></i> <span class="ml-2 mr-5 font-weight-bold">戻る</span></a>'
                );

            $('#example_wrapper').children().find(divCsv[1])
                .addClass('text-right').html(
                    '<a class="check-all pr-5 font-weight-bold" href="javascript:void(0)">全てチェック</a>')
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
                $(`select[name=manager_status_edit]`).val('{{ \App\Enums\ManagerStatus::PENDING }}').trigger('change');
            //getData(id);
        })
    </script>
@endpush
