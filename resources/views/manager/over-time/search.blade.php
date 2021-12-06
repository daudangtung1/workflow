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

        input {
            cursor: unset !important;
        }

        .content3 {
            padding: 60px 30px 83px;
        }

    </style>
@endpush

<form action="{{ route('manager.over-time.show', 'search') }}" method="GET">
    <div class="row">
        <div class="col-md-12">
            <div class="w-410 content3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">日付</label>
                            <div class="row">
                                <div class="col input-group date input-date" id="start_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#start_date" name="start_date" placeholder="年-月-日"
                                        data-toggle="datetimepicker" value="{{ request()->start_date }}" />
                                    <div class="input-group-append" data-target="#start_date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">~</div>
                                <div class="col input-group date input-date" id="end_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#end_date"
                                        name="end_date" placeholder="年-月-日" data-toggle="datetimepicker"
                                        value="{{ request()->end_date }}" />
                                    <div class="input-group-append" data-target="#end_date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-md-12">
                        <div class="form-group select-time select-search select-100">
                            <label for="">申請者ID</label>
                            <select class="chosen-select" name="staff">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach ($staffs as $item)
                                    <option value="{{ $item->id }}" data-name="{{ $item->fullName }}"
                                        {{ request()->staff == $item->id ? 'selected' : '' }}>
                                        {{ $item->id . ' - ' . $item->fullName }}
                                    </option>
                                @endforeach
                            </select>
                            <small></small>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">名前</label>
                            <input type="text" name="name" class="form-control" value="{{ request()->name }}">
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-md-12">
                        <div class="form-group select-time select-100">
                            <label for="">所属営ID</label>
                            <select class="chosen-select" name="branch_id">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach ($branchs as $item)
                                    <option value="{{ $item->id }}" data-name="{{ $item->name }}"
                                        {{ request()->branch_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->id . '-' . $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small></small>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-md-12">
                        <div class="form-group select-time select-100">
                            <label for="">承認状態</label>
                            <select class="chosen-select" name="approver_status">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach (\App\Enums\ApproverStatus::asArray() as $item)
                                    <option value="{{ $item }}"
                                        {{ request()->approver_status == $item ? 'selected' : '' }}>
                                        {{ \App\Enums\ApproverStatus::getDescription($item) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-md-12">
                        <div class="form-group select-time select-100">
                            <label for="">総務確認</label>
                            <select class="chosen-select" name="manager_status">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach (\App\Enums\ManagerStatus::asArray() as $item)
                                    <option value="{{ $item }}"
                                        {{ request()->manager_status == $item ? 'selected' : '' }}>
                                        {{ \App\Enums\ManagerStatus::getDescription($item) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary w-100 form-button">検索</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

@push('scripts')
    <script>
        $('.chosen-select').select2();
        $('.select-search .select2-selection__arrow').html(
            '<span class="icofont-search-2" style="color: #888888"> </span>');

        $('select[name=branch_id]').change(function() {
            let name = $('select[name=branch_id] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('.select2-selection__rendered').html(value);
            $(this).parent().find('small').html(name);
        });

        $('select[name=staff]').change(function() {
            let name = $('select[name=staff] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('.select2-selection__rendered').html(value);
            $(this).parent().find('small').html(name);
        });

        $('select').change();
    </script>
@endpush
