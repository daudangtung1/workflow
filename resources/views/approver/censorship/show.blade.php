<div class="tab-pane fade  {{ $active == 'show' ? 'active show' : '' }}" id="show" role="tabpanel"
     aria-labelledby="list-tab">
    <div class="card mt-0">
        <div class="card-body pb-4 pl-0 pr-0 pd-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group d-search">
                        @if(!empty($user))
                            <span
                                class="d-inline-block mr-3"><b>{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</b></span>
                        @endif
                        <span class="search pr-2"
                              data-model="{{request()->get('model')}}"
                              data-user_id="{{request()->get('user_id')}}"
                              data-date="{{$dateData['prevMonth']->format('Y-m')}}">
                                <i class="fas fa-caret-left"></i>
                            </span>
                        <span>{{$dateData['prevMonth']->format('Y')}}年{{$dateData['prevMonth']->format('m')}}月 <span
                                class="ml-2 mr-2">-</span>
                                        {{$dateData['nextMonth']->format('Y')}}年{{$dateData['nextMonth']->format('m')}}月</span>
                        <span class="search pl-2"
                              data-model="{{request()->get('model')}}"
                              data-user_id="{{request()->get('user_id')}}"
                              data-date="{{$dateData['nextMonth']->format('Y-m')}}">
                                        <i class="fas fa-caret-right"></i></span>
                    </div>
                </div>
                <div class="col-md-12 overflow-auto">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
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
                        @forelse ($dateData['dateRange'] as $date)
                            @if(!empty($data[$date->format('Y-m-d')]))
                                @foreach($data[$date->format('Y-m-d')] as $value)
                                    @php
                                        $totalMinutes = 0;
                                    @endphp
                                    @if($value->date == $date->format('Y-m-d'))
                                        @php
                                            if (!empty($value->end_time) && !empty($value->start_time)){
                                                $endTime = \Carbon\Carbon::parse( $value->end_time);
                                                $startTime = \Carbon\Carbon::parse($value->start_time);
                                                $totalMinutes = $endTime->diffInMinutes($startTime);
                                             }

                                            $userStartTimeWorking = $value->user->start_time_working ?? '';
                                            $userEndTimeWorking = $value->user->end_time_working ?? '';
                                        @endphp
                                        <tr>
                                            <td>
                                                <span style="@if(in_array($date->format('Y-m-d'), $calendars)) color: #e77b77 !important;  @endif">
                                                    {{ $date->format('Y-m-d') ?? '-' }}
                                                    ({{ucfirst(substr($date->format('l'), 0, 3))}})
                                                </span>
                                            </td>
                                            <td>
                                                @if(class_basename($value) == 'OvertimeRegister')
                                                    {{ $value->start_time ?? '' }}
                                                @else
                                                    <span
                                                        class="@if($userStartTimeWorking != $value->start_time_first) text-danger @endif">{{ $value->start_time_first ?? '' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(class_basename($value) == 'OvertimeRegister')
                                                    {{ $value->end_time ?? '' }}
                                                @else
                                                    <span
                                                        class="@if($userStartTimeWorking != $value->end_time_second) text-danger @endif">{{ $value->end_time_second ?? '' }}</span>
                                                @endif
                                            </td>
                                            <td>{{ ($totalMinutes) ? $totalMinutes : '-' }}</td>
                                            <td>{{ $value->approval_date ?? '-' }}</td>
                                            <td>
                                                @if(!empty($value->approval_date))
                                                    承認済み
                                                @else
                                                    未承認
                                                @endif
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <span style="@if(in_array($date->format('Y-m-d'), $calendars)) color: #e77b77 !important;  @endif">
                                            {{ $date->format('Y-m-d') ?? '-' }}
                                            ({{ucfirst(substr($date->format('l'), 0, 3))}})
                                        </span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('common.data.error') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('approver.censorship.show') }}" method="GET" class="form-show">
                        @csrf
                        <input type="hidden" name="model" value="">
                        <input type="hidden" name="date" value="">
                        <input type="hidden" name="user_id" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
