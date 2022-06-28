<table class="table table-bordered table-hover" id="table_data">
    <thead>
        <tr>
            <th class="w-150">日付</th>
            <th class="w-140">開始1</th>
            <th class="w-140">終了1</th>
            <th class="w-140">開始2</th>
            <th class="w-140">終了2</th>
            <th class="w-140">開始3</th>
            <th class="w-140">終了3</th>
            <th class="w-130">時間外計(分)</th>
            <th class="w-140">申請者(社員ID)</th>
            <th class="w-160">承認</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataRegister as $item)
        @if(in_array($item['date'], $listCalendarData))
        <tr data-id={{$item['id']}} class="vacation">
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['start_time1'] }}</td>
            <td>{{ $item['end_time1'] }}</td>
            <td>{{ $item['start_time2'] }}</td>
            <td>{{ $item['end_time2'] }}</td>
            <td>{{ $item['start_time3'] }}</td>
            <td>{{ $item['end_time3'] }}</td>
            <td>{{ $item['time'] }}</td>
            <td>{{ $item['user'] }}</td>
            <td>
                @if($item['status_month'])
                    <p>月次承認済み</p>
                @else
                    @if($item['approver'] != '')
                    <p>承認済み<a href="javascript:void(0)" class="cancel_approve">（取消）</a></p>
                    @else
                    <label class="custom-check">
                        <input type="checkbox" name="id" class="check-one" value="{{ $item['id'] }}">
                        <span class="checkmark"></span>
                    </label>
                    @endif
                @endif
            </td>
        </tr>
        @unset($item['date'])
        @else
        <tr data-id={{$item['id']}}>
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['start_time1'] }}</td>
            <td>{{ $item['end_time1'] }}</td>
            <td>{{ $item['start_time2'] }}</td>
            <td>{{ $item['end_time2'] }}</td>
            <td>{{ $item['start_time3'] }}</td>
            <td>{{ $item['end_time3'] }}</td>
            <td>{{ $item['time'] }}</td>
            <td>{{ $item['user'] }}</td>
            <td>
                @if($item['status_month'])
                    <p>月次承認済み</p>
                @else
                    @if($item['approver'] != '')
                    <p>承認済み<a href="javascript:void(0)" class="cancel_approve">（取消）</a></p>
                    @else
                    <label class="custom-check">
                        <input type="checkbox" name="id" class="check-one" value="{{ $item['id'] }}">
                        <span class="checkmark"></span>
                    </label>
                    @endif
                @endif
            </td>
        </tr>
        @endif
        @empty
        <tr>
            <td colspan="10" class="text-center">{{ __('common.data.error') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>