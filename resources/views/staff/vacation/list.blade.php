@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<!-- daterange picker -->
<style>
    #list .w-content {
        width: 285px !important;
    }

    #list .w-140 {
        width: 120px !important;
    }

    #list_table tr th:last-child {
        width: 30px !important;
    }

    #list .w-content {
        width: 223px !important;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        height: unset !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        outline: none;

    }

    .staff_vacation_header{
        display: flex;
        justify-content: space-between;
    }
</style>
@endpush


<div class="row ">
    <div class="col-md-12 ">
        <div class="overflow-auto tab-content2">
            <div class="staff_vacation_header">
                <p>過去申請一覧（申請日降順/過去1年分）</p>
                <div class="tk-search-btn tk-timesheet">
                    <select class="tk-select" name="year">
                        @foreach ($listYear as $item)
                        <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>
                            {{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="table table-bordered table-hover mb-0" id="list_table">
                <thead>
                    <tr>
                        <th class="w-140">日付(開始)</th>
                        <th class="w-140">日付(終了)</th>
                        <th class="w-140">種別</th>
                        <th class="w-140">時問</th>
                        <th class="w-content">理由</th>
                        <th class="w-140">承認日時</th>
                        <th class="w-140">承認者</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listVacation as $item)
                    <tr>
                        <td>{{ $item['start_date'] }}</td>
                        <td>{{ $item['end_date'] }}</td>
                        <td>{{ $item['type_id'] > 6 ? '欠勤' : $item['type'] }}</td>
                        {{-- $item['type_id'] > 6 ? $item['type'] : '-' --}}
                        <td>{{ $item['total_time'] ? $item['total_time'] : ''}}</td>
                        <td>{{ $item['reason'] }}</td>
                        <td>{{ $item['approval_date'] }}</td>
                        <td>{{ $item['approver'] }}</td>
                        <td>
                            @if ($item['disable'])
                            <i class="icofont-lock"></i>
                            @else
                            <a href="{{ route('staff-vacation.edit', $item['id']) }}"><i class="icofont-pencil-alt-1"></i></a>
                            @endif
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('common.data.error') }}</td>
                    </tr>
                    @endforelse
                </tbody>


            </table>
        </div>
    </div>
</div>

{{-- loading --}}

@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $('#list_table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/ja.json"
        },
        "ordering": false
    });

    $('.tk-timesheet').change(function() {
        let year = $('select[name=year]').val();
        location.assign(`{{ route('staff-vacation.index') }}?year=${year}`)
    });
</script>
@endpush