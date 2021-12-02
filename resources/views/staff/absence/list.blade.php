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

        .tab-content2 {
            margin: 47px 30px 59px;
        }

    </style>
@endpush


<div class="row">
    <div class="col-md-12">
        <div class="overflow-auto tab-content2">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>日付(開始)</th>
                        <th>欠勤時間</th>
                        <th>理由</th>
                        <th>承認日時</th>
                        <th>承認者</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listAbsence as $item)
                        <tr>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['option'] }}</td>
                            <td>{{ $item['reason'] }}</td>
                            <td>{{ $item['approval_date'] }}</td>
                            <td>{{ $item['approver'] }}</td>
                            <td>
                                @if ($item['disable'])
                                    <i class="fas fa-lock"></i>
                                @else
                                    <a href="{{ route('staff.absence.edit', $item['id']) }}"><i
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
</div>

{{-- loading --}}

@push('scripts')

@endpush
