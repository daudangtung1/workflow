@push('styles')
    <!-- daterange picker -->
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .invalid-feedback {
            display: unset;
        }

    </style>
@endpush

<div class="row">
    <div class="col-md-7">
        <form
            action="{{ route('manager.staff.store') }}"
            method="POST">
            @csrf
            
            {{-- user id - staff type --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">社員ID</label>
                        <input type="text" name="user_id" class="form-control" value="{{ old('user_id') }}" required>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group select-time">
                        <label for="">社員区分</label>
                        <select class="chosen-select" name="type">
                            <option value="">&nbsp;</option>
                            @foreach (\App\Enums\UserType::asArray() as $item)
                                <option value="{{ $item }}"
                                    {{ old('type') == $item ? 'selected' : '' }}>
                                    {{ \App\Enums\UserType::getDescription($item) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- firname lastname --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">名前(姓)</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">名前(名)</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                    </div>
                </div>
            </div>
            {{-- date on date off --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">入社日</label>
                        <div class="input-group date input-date" id="join_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#join_date"
                                name="join_date" placeholder="年-月-日"  data-toggle="datetimepicker" value="{{ old('join_date') }}" />
                            <div class="input-group-append" data-target="#join_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                        <small>入社日前はログインできません。</small>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">退職日</label>
                        <div class="input-group date input-date" id="off_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#off_date"
                                name="off_date" placeholder="年-月-日"  data-toggle="datetimepicker" value="{{ old('off_date') }}" />
                            <div class="input-group-append" data-target="#off_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                        退職日以降はログインできません。
                    </div>
                </div>
            </div>
            {{-- working part - branch --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group select-time">
                        <label for="">事業所ID</label>
                        <select class="chosen-select" name="branch_id">
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($branchs as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}"
                                    {{ (old('branch_id') == $item->id) ? 'selected' : '' }}>
                                    {{ $item->id . '-' . $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <small></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group select-time">
                        <label for="">部署ID</label>
                        <select class="chosen-select" name="working_part_id" >
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($workingParts as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}"
                                    {{ (old('working_part_id') == $item->id) ? 'selected' : '' }}>
                                    {{ $item->id . ' - ' . $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <small></small>

                    </div>
                </div>
            </div>
            {{-- approver 1 - approver 2 --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group select-time select-search">
                        <label for="">承認者1社員ID</label>
                        <select class="chosen-select" name="approver_first" >
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($approvers as $item)
                                <option value="{{ $item->id }}"
                                    data-name="{{ $item->fullName }}"
                                    {{ old('approver_first') == $item->id ? 'selected' : '' }}>
                                    {{ $item->id . ' - ' . $item->fullName }}
                                </option>
                            @endforeach
                            
                        </select>
                        <small></small>
                        @error('approver_first')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group select-time select-search">
                        <label for="">承認者2社員ID</label>
                        <select class="chosen-select" name="approver_second" >
                            <option value="" data-name="">&nbsp;</option>
                            @foreach ($managers as $item)
                            <option value="{{ $item->id }}" 
                                data-name="{{ $item->fullName }}"
                                {{ old('approver_second') == $item->id ? 'selected' : '' }}>
                                {{ $item->id . ' - ' . $item->fullName }}
                            </option>
                        @endforeach
                        </select>
                        <small></small>
                        @error('approver_second')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- email - password --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">メールアドレス</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">パスワード</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- start time -end time --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group select-time select-min">
                        <label for="">始業時刻</label>
                        <select class="chosen-select" name="start_time_working" >
                            <option value="">&nbsp;</option>
                            @foreach ($times as $item)
                                <option
                                {{ (old('start_time_working') == ($item['hour'] .':'.$item['minutes']['00'])) ? 'selected' : '' }}
                                value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                <option
                                {{ (old('start_time_working') == ($item['hour'] .':'.$item['minutes']['30'])) ? 'selected' : '' }}
                                value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                            @endforeach
                        </select>
                        @error('start_time_working')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group select-time select-min">
                        <label for="">終業時刻 </label>
                        <select class="chosen-select" name="end_time_working" >
                            <option value="">&nbsp;</option>
                            @foreach ($times as $item)
                                <option
                                {{ (old('end_time_working') == ($item['hour'] .':'.$item['minutes']['00'])) ? 'selected' : '' }}
                                value="{{{ $item['hour'] .':'.$item['minutes']['00'] }}}">{{ $item['hour'] .':'.$item['minutes']['00'] }}</option>
                                <option
                                {{ (old('end_time_working') == ($item['hour'] .':'.$item['minutes']['30'])) ? 'selected' : '' }}
                                value="{{ $item['hour'] .':'.$item['minutes']['30'] }}">{{ $item['hour'] .':'.$item['minutes']['30'] }}</option>
                            @endforeach
                        </select>
                        @error('end_time_working')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- button --}}
            <div class="row">
                <div class="col-md-12 mt-4 text-center">
                    <button class="btn btn-primary w-50 form-button">申請(登録)</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $(function () {
            $('select').change();
        });
        var dateNow = '{{ \Carbon\Carbon::now()->toDateString() }}';
        $('.chosen-select').select2();
        
        $('.select-search .select2-selection__arrow').html('<span class="fas fa-search" style="color: #888888"> </span>');

        $('.select-min .select2-selection__arrow').html('<i class="far fa-clock"></i>');
        $('select[name=branch_id]').change(function (){
            let name = $('select[name=branch_id] option:selected').attr('data-name');
            let value = $(this).val();

            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('select[name=working_part_id]').change(function (){
            let name = $('select[name=working_part_id] option:selected').attr('data-name');
            let value = $(this).val();

            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('select[name=approver_first]').change(function (){
            let name = $('select[name=approver_first] option:selected').attr('data-name');
            let value = $(this).val();

            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('select[name=approver_second]').change(function (){
            let name = $('select[name=approver_second] option:selected').attr('data-name');
            let value = $(this).val();

            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });
    </script>
@endpush
