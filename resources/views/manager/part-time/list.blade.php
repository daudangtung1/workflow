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
        <form action="{{ route('manager.part_time.update', 'all') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row pl-5 pt-3">
                <div class="col-md-12 overflow-auto">
                    <table class="table table-bordered table-hover" id="example">
                        <thead>
                            
                            <tr>
                                <th>日付(開始)</th>
                                <th>申請者</th>
                                <th>所属事業所</th>
                                
                                <th>開始1</th>
                                <th>終了1</th>
                                <th>開始2</th>
                                <th>終了2</th>
                                <th>開始3</th>
                                <th>終了3</th>
                                <th>時間外計(分)</th>
                                <th>承認日時</th>
                                <th>承認者</th>

                                <th>総務承認</th>
                                <th>編集</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataPartTime as $item)
                                <tr>
                                    <td>{{ $item['date'] }}</td>
                                    <td>{{ $item['user'] }}</td>
                                    <td>{{ $item['branch'] }}</td>

                                    <td>{{ $item['start_time1'] }}</td>
                                    <td>{{ $item['end_time1'] }}</td>
                                    <td>{{ $item['start_time2'] }}</td>
                                    <td>{{ $item['end_time2'] }}</td>
                                    <td>{{ $item['start_time3'] }}</td>
                                    <td>{{ $item['end_time3'] }}</td>
                                    <td>{{ $item['time'] }}</td>

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
                                            <i class="fas fa-pencil-alt"></i></a></td>

                                </tr>
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
                    '<a href="{{ route('manager.part_time.index') }}"><i class="right fas fa-caret-left "></i> <span class="ml-2 mr-5 font-weight-bold">戻る</span></a>'
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
            let manager = $(this).data('manager');
            let approvalDate = $(this).data('approval-date');
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

            $(`select[name=start_time_first]`).val(startTime1).trigger('change');
            $(`select[name=end_time_first]`).val(endTime1).trigger('change');

            $(`select[name=start_time_second]`).val(startTime2).trigger('change');
            $(`select[name=end_time_second]`).val(endTime2).trigger('change');

            $(`select[name=start_time_third]`).val(startTime3).trigger('change');
            $(`select[name=end_time_third]`).val(endTime3).trigger('change');

            if (!manager)
                $(`select[name=manager_status_edit]`).val('{{ \App\Enums\ManagerStatus::PENDING }}').trigger('change');
            //getData(id);
        })
    </script>
@endpush
