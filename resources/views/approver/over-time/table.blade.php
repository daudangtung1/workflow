<table class="table table-bordered table-hover mb-0" id="table_data">
    <thead>
        <tr>
            <th class="w-150">日付</th>
            <th class="w-150">申請日</th>
            <th class="w-230">申請者(社員ID)</th>
            <th class="w-150">所属事業所</th>
            <th class="w-90">開始時刻</th>
            <th class="w-90">終了時刻</th>
            <th class="w-117">時間外計(分)</th>
            <th class="w-220">承認者</th>
            <th class="w-115">承認日時</th>
            <th class="w-160">承認</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataRegister as $key => $item)
        @if(in_array($item['date'], $listCalendarData))
        <tr data-id={{$item['id']}} class="vacation get-data">
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['created_at'] }}</td>
            <td>{{ $item['user'] }}</td>
            <td>{{ $item['branch'] }}</td>
            <td>{{ $item['start_time'] }}</td>
            <td>{{ $item['end_time'] }}</td>
            <td>{{ $item['time'] }}</td>
            <td>{{ $item['approver'] }}</td>
            <td>{{ $item['approval_date'] }}</td>
            <td>
                @if($item['status_month'])
                    <p>月次承認済み</p>
                @else
                    @if($item['approver'] != '-')
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
        <tr data-id={{$item['id']}} class="get-data">
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['created_at'] }}</td>
            <td>{{ $item['user'] }}</td>
            <td>{{ $item['branch'] }}</td>
            <td>{{ $item['start_time'] }}</td>
            <td>{{ $item['end_time'] }}</td>
            <td>{{ $item['time'] }}</td>
            <td>{{ $item['approver'] }}</td>
            <td>{{ $item['approval_date'] }}</td>
            <td>
                @if($item['status_month'])
                    <p>月次承認済み</p>
                @else
                    @if($item['approver'] != '-')
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
            <td colspan="6" class="text-center">{{ __('common.data.error') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>