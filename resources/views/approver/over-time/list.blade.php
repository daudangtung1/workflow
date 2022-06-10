@push('styles')
<style>
    .note {
        font-size: 16px;
        line-height: 28px;
        color: #4B545C;
        margin-top: 30px;
    }

    .check-all {
        font-size: 14px;
        line-height: 20px;
        color: #3B89CF;
    }

    .form-button {
        height: 46px;
        font-size: 18px;
        font-weight: 700;
        margin: 116px 0 50px 0;
        width: 410px !important;
        min-width: 320px;
    }

    .w-230 {
        width: 230px !important;
    }

    .w-318 {
        width: 318px !important;
    }

    .w-291 {
        width: 291px !important;
    }

    .w-276 {
        width: 276px !important;
    }

    .w-150 {
        width: 150px !important;
    }

    .w-220 {
        width: 220px !important;
    }

    .w-160 {
        width: 160px !important;
    }

    @media only screen and (max-width: 1165px) {
        .form-button {
            margin: 30px 0 50px 0px !important;
            width: 100% !important;
        }

    }

    @media only screen and (max-width: 600px) {
        .button-right {
            width: 100% !important;
        }

        .button-right button {
            min-width: 100% !important;
        }
    }

    .vacation {
        background: #ffebeb;
    }

    #table_data tr td p {
        margin-bottom: 0;
    }
</style>
@endpush
<div class="card">
    <div class="card-body">
        {{--<form id="ot_manager">--}}
        {{--@csrf--}}
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3 text-right">
                        <a class="check-all pr-5" href="javascript:void(0)">全てチェック</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 overflow-auto">
                @include('approver.over-time.table')
            </div>
            <div class="col-md-12">
                <div class="note float-left">
                    ※承認したデータは編集不可となります。<br>
                    ※承認期限は、締め日(毎月10日)+1営業日後です。
                </div>
                <div class="float-right button-right">
                    <button class="btn btn-primary w-100 form-button font-weight-bold" disabled id="update">承認</button>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
        {{--</form>--}}
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/bootbox.min.js')}}"></script>
    <script>
        $('.check-all').click(function() {
            if ($('.check-one').length == $('.check-one:checked').length) {
                $('.check-one').prop('checked', false)
            } else {
                $('.check-one').prop('checked', true)
            }

            checkSubmit();
        });

        $('.check-one').click(function() {
            checkSubmit();
        })

        function checkSubmit() {
            if ($('.check-one:checked').length > 0) {
                $('.form-button').prop('disabled', false);
            } else {
                $('.form-button').prop('disabled', true);
            }
        }

        $("#update").click(function(){
            bootbox.confirm({
                // title: "",
                message: "承認を取り消します。よろしいですか？",
                buttons: {
                cancel: {
                    label: "いいえ",
                },
                confirm: {
                    label: "はい",
                }
            },
            callback: function(result) {
                if (result) {
                    var id = [];
                    $('.custom-check input:checkbox[name=id]:checked').each(function() {
                        id.push($(this).val());
                    })
                    var url = "{{route('approver.overtime.store')}}";
                    console.log(url);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        method: "POST",
                        datatype: 'html',
                        async: false,
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            start_date: "{{Request::get('start_date')}}",
                            end_date: "{{Request::get('end_date')}}",
                            staff: "{{Request::get('staff')}}",
                            branch_id: "{{Request::get('branch_id')}}",
                            approver_status: "{{Request::get('approver_status')}}"
                        },
                        cache: false,

                        success: function(res) {
                            if (res.statusCode === 200) {
                                $('#table_data').html(res.html);
                                bootbox.alert({
                                    message: "成功!",
                                    buttons: {
                                        ok: {
                                            label: '近い'
                                        }
                                    }
                                });
                                checkSubmit();
                            } else console.log('not found!');
                        },
                        error: function(res) {
                            console.log('fail');
                        }
                    });
                }
            }
        });
    });

    $(document).on("click", ".cancel_approve", function() {
        var data_id = $(this).parents('tr').data('id');
        bootbox.confirm({
            // title: "",
            message: "承認を取り消します。よろしいですか？",
            buttons: {
                cancel: {
                    label: "いいえ",
                },
                confirm: {
                    label: "はい",
                }
            },
            callback: function(result) {
                if (result) {
                    var url_cancel = "{{route('approver.overtime.update', '')}}" + "/" + data_id;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url_cancel,
                        method: "PUT",
                        datatype: 'html',
                        async: false,
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: data_id,
                            start_date: "{{Request::get('start_date')}}",
                            end_date: "{{Request::get('end_date')}}",
                            staff: "{{Request::get('staff')}}",
                            branch_id: "{{Request::get('branch_id')}}",
                            approver_status: "{{Request::get('approver_status')}}"
                        },
                        success: function(res) {
                            if (res.statusCode === 200) {
                                $('#table_data').html(res.html);
                                bootbox.alert({
                                    message: "成功!",
                                    buttons: {
                                        ok: {
                                            label: '近い'
                                        }
                                    },
                                });
                            } else console.log('not found!')
                        },
                        error: function() {
                            console.log('fail!');
                        }
                    });
                }
            }
        });
    });
</script>
@endpush