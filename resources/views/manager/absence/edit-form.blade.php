@push('styles')
    <!-- daterange picker -->
    <style>
        .tab-content {
            background: #ffffff !important;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff !important;
        }

        .font-weight-normal {
            padding-top: 2px !important;
        }

        

        small {
            position: absolute;
            font-size: 14px;
            line-height: 46px;
            font-weight: 400;
            color: #1F232E;
            width: 100%;
            margin-left: 15px;
        }

        .datepicker-days .weekend {
            background: #FFD1D1 !important;

        }

        .mr-280 {
            margin-right: 280px;
        }

        @media only screen and (max-width: 1490px) {
            .mr-280 {
                margin-right: 100px !important; 
            }
        }

        @media only screen and (max-width: 1310px) {
            .mr-280 {
                margin-right: 10px !important; 
            }
        }

        @media only screen and (max-width: 1023px) {
            .mr-280 {
                margin-right: 0 !important; 
            }
            .form-button {
                width: 410px !important;
            }
            small {
                position: unset !important;
                display: block;
                margin-left: 0px !important;
                line-height: 24px !important;
            }
        }

        @media only screen and (max-width: 600px) {
            
            .form-button {
                width: 100% !important;
            }

            .tab-content1 .form-group {
                max-width: 100% !important;
            }
        }

    </style>
@endpush
<form class="formSm" method="POST">
    @csrf
   
            <div class="tab-content1 pb-71">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group select-time select-search">
                            <label for="">申請者ID</label>
                            <select class="chosen-select" name="user_register">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach ($staffs as $item)
                                    <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
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
                        <div class="form-group w-410">
                            <label for="">日付</label>
                            <div class="input-group date input-date" id="date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#date"
                                    name="date" placeholder="年-月-日" required data-toggle="datetimepicker" value="" />
                                <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="icofont-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-30">
                        <div class="form-group select-time">
                            <label for="">欠勤時間</label>
                            <select class="chosen-select" name="option">
                                @foreach (\App\Enums\AbsenceOption::asArray() as $item)
                                    <option value="{{ $item }}">
                                        {{ \App\Enums\AbsenceOption::getDescription($item) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-30">
                        <div class="form-group">
                            <label for="">理由</label>
                            <textarea class="form-control w-410" name="reason" id="reason" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-30">
                        <div class="form-group select-time select-search ">
                            <label for="">所属営ID</label>
                            <select class="chosen-select" name="approver">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach ($approvers as $item)
                                    <option value="{{ $item->id }}" data-name="{{ $item->fullName }}">
                                        {{ $item->id . ' - ' . $item->fullName }}
                                    </option>
                                @endforeach
                            </select>
                            <small></small>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 mt-30">
                        <div class="form-group w-410">
                            <label for="">承認状態</label>

                            <div class="input-group date input-date" id="approval_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#approval_date" name="approval_date" placeholder="年-月-日"
                                    data-toggle="datetimepicker" value="" />
                                <div class="input-group-append" data-target="#approval_date"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="icofont-calendar"></i></div>
                                </div>
                            </div>

                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                    <div class="col-md-12">
                        <div class="form-group select-time mt-30">
                            <label for="">総務確認</label>
                            <select class="chosen-select" name="manager_status_edit">
                                <option value="" data-name="">&nbsp;</option>
                                @foreach (\App\Enums\ManagerStatus::asArray() as $item)
                                    <option value="{{ $item }}">
                                        {{ \App\Enums\ManagerStatus::getDescription($item) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button disabled class="btn btn-primary w-410 form-button form-button-edit mr-280"><b>更新</b></button>
                        <button class="btn btn-primary w-410 form-button form-button-delete" disabled><b>削除</b>
                    </div>
                </div>
            </div>
    
    <input type="hidden" name="id">

</form>

@push('scripts')
    <script>
        $('.form-button-edit').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.absence.update_info', 'update') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="PUT">');
            $('.formSm').submit();
        });

        $('.form-button-delete').click(function() {
            let formData = new FormData($('.formSm')[0]);
            $('.formSm').attr({
                method: 'POST',
                action: '{{ route('manager.absence.destroy', 'delete') }}'
            });
            $('.formSm').append('<input type="hidden" name="_method" value="DELETE">');
            $('.formSm').submit();
        })

        $('select[name=user_register]').change(function() {
            let name = $('select[name=user_register] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('select[name=approver]').change(function() {
            let name = $('select[name=approver] option:selected').attr('data-name');
            let value = $(this).val();
            $(this).parent().find('small').html(name);
            $(this).parent().find('.select2-selection__rendered').html(value);
        });

        $('#approval_date').datetimepicker({
            format: false,
            locale: 'ja',
            icons: {
                time: 'far fa-clock',
            },
        });

        $('#date').datetimepicker({
            useCurrent: false,
            format: "YYYY-MM-DD",
            locale: "ja",
            daysOfWeekDisabled: [0, 6],
        });
    </script>
@endpush
