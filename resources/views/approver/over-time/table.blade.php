<table class="table table-bordered table-hover mb-0" id="table_data">
    <thead>
        <tr>
            <th class="w-150">日付</th>
            <th class="w-150">開始時刻</th>
            <th class="w-150">終了時刻</th>
            <th class="w-150">時間外計(分)</th>
            <th class="w-230">申請者(社員ID)</th>
            <th class="w-230">Branch</th>
            <th class="w-220">Time</th>
            <th class="w-160">承認</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataRegister as $key => $item)
        @if(in_array($item['date'], $listCalendarData))
        <tr data-id={{$item['id']}} class="vacation">
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['start_time'] }}</td>
            <td>{{ $item['end_time'] }}</td>
            <td>{{ $item['time'] }}</td>
            <td>{{ $item['user'] }}</td>
            <td>{{ $item['branch'] }}</td>
            <td>{{ $item['approval_date'] }}</td>
            <td>@if($item['approver'] != '-')
                <p>đã phê duyệt <a href="javascript:void(0)" class="cancel_approve">(hủy)</a></p>
                @else
                <label class="custom-check">
                    <input type="checkbox" name="id" class="check-one" value="{{ $item['id'] }}">
                    <span class="checkmark"></span>
                </label>
                @endif
            </td>
        </tr>
        @unset($item['date'])
        @else
        <tr data-id={{$item['id']}}>
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['start_time'] }}</td>
            <td>{{ $item['end_time'] }}</td>
            <td>{{ $item['time'] }}</td>
            <td>{{ $item['user'] }}</td>
            <td>{{ $item['branch'] }}</td>
            <td>{{ $item['approval_date'] }}</td>
            <td>@if($item['approver'] != '-')
                <p>đã phê duyệt <a href="javascript:void(0)" class="cancel_approve">(hủy)</a></p>
                @else
                <label class="custom-check">
                    <input type="checkbox" name="id" class="check-one" value="{{ $item['id'] }}">
                    <span class="checkmark"></span>
                </label>
                @endif
            </td>
        </tr>
        @endif
        @empty
        <tr>
            <td colspan="6" class="text-center">{{ __('common.data.error') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>