@push('styles')
    <!-- daterange picker -->
    <style>
        table a {
            color: #000 !important;
        }

        table thead {
            background: #E8EDF4;
            font-weight: 700;
            font-size: 14px;
        }

        .d-search span {
            font-weight: 700;

        }

        .search {
            cursor: pointer;
        }

        table body {
            font-weight: 400;
            color: #4B545C;
            font-size: 14px;
        }

    </style>
@endpush


<div class="row pl-5 pr-5 pt-5">
    <div class="col-md-12 overflow-auto">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>日付(開始)</th>
                    <th>日付(終了)</th>
                    <th>種別</th>
                    <th>理由</th>
                    <th>承認日時</th>
                    <th>承認者</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listVacation as $item)
                    <tr>
                        <td>{{ $item['start_date'] }}</td>
                        <td>{{ $item['end_date'] }}</td>
                        <td>{{ $item['type'] }}</td>
                        <td>{{ $item['reason'] }}</td>
                        <td>{{ $item['approval_date'] }}</td>
                        <td>{{ $item['approver'] }}</td>
                        <td>
                            @if ($item['disable'])
                                <i class="fas fa-lock"></i>
                            @else
                                <a href="{{ route('staff.vacation.edit', $item['id']) }}"><i
                                        class="fas fa-pencil-alt"></i></a>
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

{{-- loading --}}

@push('scripts')

@endpush
