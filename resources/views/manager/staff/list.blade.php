@push('styles')
    <!-- daterange picker -->
    <style>
        table a {
            color: #000 !important;
        }

        table thead {
            background: #E8EDF4;
        }

        .content4 {
            padding: 20px 30px 38px;
        }

        .dataTables_filter input {
            width: 278px !important;
        }

        .dataTables_filter label {
            font-weight: bold;
            font-size: 14px;
            line-height: 20px;
            color: #4B545C;
        }

        #list table th {
            padding: 10px 16px 9px !important;
            font-weight: 700;
            font-size: 14px;
            line-height: 20px;

            color: #4B545C;
        }

        #list table td {
            padding: 10px 16px 9px !important;

            font-weight: 400;
            font-size: 14px;
            line-height: 20px;

            color: #4B545C;
        }

        .w-140 {
            width: 140px !important;
        }

        .w-130 {
            width: 130px !important;
        }

        .w-200 {
            width: 200px !important;
        }

        table {
            table-layout: fixed;
            display: table;
            width: 100%;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
@endpush



        <div class="content4 ">
            <div >
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="w-130">社員ID</th>
                            <th class="w-130">名前</th>
                            <th class="w-130">入社日</th>
                            <th class="w-130">退社日</th>
                            <th class="w-130">社員区分</th>
                            <th class="w-130">事業所名</th>
                            <th class="w-200">メールアドレス</th>
                            <th class="w-130">編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listStaff as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->fullName }}</td>
                                <td>{{ $item->join_date ?? '-' }}</td>
                                <td>{{ $item->off_date ?? '-' }}</td>
                                <td>{{ \App\Enums\UserType::getDescription($item->type) }}</td>
                                <td>{{ $item->branch->name ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('manager.staff.edit', $item->id) }}"><i
                                            class="icofont-pencil-alt-1"></i></a>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{ __('common.data.error') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


{{-- loading --}}

@push('scripts')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $('table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "<b>検索</b>"
            }
        });
        $('.dataTable').parent().addClass('overflow-auto');
    </script>
@endpush
