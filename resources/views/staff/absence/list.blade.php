@push('styles')
    <!-- daterange picker -->
    <style>
        

    </style>
@endpush


<div class="row">
    <div class="col-md-12">
        <div class="overflow-auto tab-content2">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th class="w-140">日付(開始)</th>
                        <th class="w-140">欠勤時間</th>
                        <th class="w-content">理由</th>
                        <th class="w-140">承認日時</th>
                        <th class="w-140">承認者</th>
                        <th class="w-140">編集</th>
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
                                    <i class="icofont-lock"></i>
                                @else
                                    <a href="{{ route('staff.absence.edit', $item['id']) }}"><i class="icofont-pencil-alt-1"></i></a>
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
