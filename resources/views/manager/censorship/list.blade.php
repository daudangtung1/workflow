<div class="tab-pane fade  {{ $active == 'list' ? 'active list show' : '' }}" id="list" role="tabpanel"
     aria-labelledby="list-tab">
    <div class="card mt-0">
        <div class="card-body pb-4 pl-0 pr-0 pd-0">
            <div class="row">
                <form action="{{route('manager.censorship.approval_by_month')}}" method="POST">
                    @csrf
                    <div class="col-md-12 overflow-auto">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                            <tr>
                                <th>検索条件</th>
                                <th colspan="4">
                                    時間: {{request()->get('date')}},
                                    承認状況: {{\App\Models\OvertimeRegister::$approvalStatus[request()->get('status_approval')]}}
                                </th>
                                <th>
                                    <label class="custom-check custom-check-all">
                                        <input type="checkbox" name="all"
                                               class="check-all"
                                               value="all">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                            </tr>
                            <tr>
                                <th class="w-150">日付</th>
                                <th class="w-150">開始時刻</th>
                                <th class="w-150">終了時刻</th>
                                <th class="w-150">時間外計（分）</th>
                                <th class="w-230">承認日時</th>
                                <th class="w-150">承認者</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php  $countApproved = 0; @endphp
                            @forelse ($items as $key => $item)
                                @php
                                    $infoArray = explode('_', $key);
                                    $date = $infoArray[0] ?? '';
                                    $classModel = $infoArray[1] ?? '';
                                @endphp
                                @foreach($item as $value)
                                    @php
                                        $approvedCreatedAt = '';
                                        if (!empty($value[0]->approvalByMonth->created_at)) {
                                            $approvedCreatedAt = $value[0]->approvalByMonth->created_at;
                                        }
                                        $user = $value[0]->user;

                                        $checkApproved = checkApproved($value);
                                        $totalMinutes = getTotalMinutes($value);
                                        $ids = getRecordIds($value);
                                    @endphp
                                    <tr class="censorship-item" data-date="{{$date}}"
                                        data-model="{{$classModel}}" data-user="{{$user->id}}">
                                        <td>{{ $date ?? '-' }}</td>
                                        <td>{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</td>
                                        <td>
                                            @if($classModel == 'OvertimeRegister')
                                                時間外申請
                                            @else
                                                パート出勤簿
                                            @endif
                                        </td>
                                        <td>{{ ($totalMinutes) ? $totalMinutes : '-' }}</td>
                                        <td>{{ $approvedCreatedAt ?? '-' }}</td>
                                        <td class="action">
                                            @if($approvedCreatedAt)
                                                承認済み
                                            @elseif($checkApproved)
                                                <label class="custom-check">
                                                    <input type="checkbox" name="data_input[{{$classModel}}][]"
                                                           class="check-one"
                                                           value="{{json_encode($ids)}}">
                                                    <span class="checkmark"></span>
                                                </label>
                                                @php
                                                    $countApproved += + 1;
                                                @endphp
                                            @else
                                                未承認
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center">{{ __('common.data.error') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <style>
                        @if($countApproved == 0)
                            .custom-check-all {
                            display: none;
                        }
                        @endif
                    </style>
                    @if(!empty($items))
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-primary d-none form-button-list form-button" type="submit"
                                    value="approval_by_month">毎月の承認
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            <form action="{{ route('manager.censorship.show') }}" method="GET" class="form-table">
                @csrf
                <input type="hidden" name="model" value="">
                <input type="hidden" name="date" value="">
                <input type="hidden" name="user_id" value="">
            </form>
        </div>
    </div>
</div>
