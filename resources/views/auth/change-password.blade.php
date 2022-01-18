<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            padding: 20px;
            height: 75vh;
        }

        .card {
            box-shadow: none;
            border: none
        }

        .wrapper1 {
            width: 100%;
        }

        .card {
            margin: auto;
            width: 470px;
            height: auto;
            color: #1F232E !important;
            padding-bottom: 30px;
        }

        .title1 {
            margin: 206px 0 53px 0;
            font-size: 32px;
            line-height: 46px;
            font-weight: 700;
            color: #343A40;
        }

        .sub-title {
            font-weight: bold;
            font-size: 24px;
            line-height: 35px;
            margin: 30px 0 0 0;
            color: #000;
        }

        .form-group {
            padding: 0 30px;
            margin: 0;
        }

        .form-m-t {
            margin: 30px 0 0 0;
        }

        input {
            font-size: 16px;
            height: 46px !important;
        }



        input[type="old_password"]::placeholder, input[type="confirm_password"]::placeholder, input[type="password"]::placeholder {
            font-size: 13px;
            line-height: 18px;
            font-weight: 500;
        }

        button {
            height: 46px;
            font-size: 18px !important;
            line-height: 26px !important;
            font-weight: bold !important;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            position: absolute;
        }

        label[for="remember"] {
            font-weight: 600 !important;
            font-size: 16px !important;
            line-height: 23px !important;
            margin-left: 27px;
        }

        label[for=""] {
            font-size: 16px !important;
            line-height: 18px !important;
            font-weight: 500 !important;
        }

        @media only screen and (max-width: 600px) {
            .card {
                width: 100% !important;
            }

            .title1 {
                font-size: 24px;
            }
        }

    </style>
</head>

<body class="antialiased">

    <div class="wrapper text-center">
        <form action="{{ route('change_password') }}" method="POST">
            @csrf
            <p class="title1">ワークフローシステムへようこそ</h2>
            <div class="card">
                <p class="sub-title"><b>パスワードを変更する</b></h3>
                   
                        
                <div class="form-group text-left form-m-t">
                    <label for="">以前のパスワード</label>
                    <input type="password" class="form-control" name="old_password" placeholder="●●●●●●●●" required >
                    @error('old_password')
                    <div class="alert alert-danger alert-dismissible fade show " role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                </div>

                <div class="form-group text-left form-m-t">
                    <label for="">新しいパスワード</label>
                    <input type="password" class="form-control" name="password" placeholder="●●●●●●●●" required >
                    @error('password')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                </div>

                <div class="form-group text-left form-m-t">
                    <label for="">パスワードを再設定</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="●●●●●●●●" required >
                    @error('confirm_password')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                </div>

                <div class="form-group form-m-t">
                    <button class="btn btn-primary w-100">変化する</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>
