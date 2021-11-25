@push('styles')
    <!-- daterange picker -->
    <style>
        table a {
            color: #000 !important;
        }

        table thead {
            background: #E8EDF4;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
@endpush


<div class="row pl-5 pr-5 pt-3">
    <div class="col-md-12 overflow-auto">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>社員ID</th>
                    <th>名前</th>
                    <th>入社日</th>
                    <th>退社日</th>
                    <th>社員区分</th>
                    <th>事業所名</th>
                    <th>メールアドレス</th>
                    <th>編集</th>
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
                                    class="fas fa-pencil-alt"></i></a>
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
    </script>
@endpush
