<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
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
            padding-bottom: 40px;
            color: #1F232E !important;
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
            margin: 30px 0 30px 0;
            color: #000;
        }

        .form-group {
            padding: 0 30px;
            margin: 0;
        }

        .form-m-t {
            margin: 30px 0 0 0;
        }

        input[type="text"],
        input[type="password"] {
            font-size: 16px;
            height: 46px !important;
        }

        input[type="text"]::placeholder {
            font-size: 16px;
            line-height: 23px;
            font-weight: 400;
        }

        input[type="password"]::placeholder {
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

            .wrapper {
                padding: 0px;
            }

            input[type="text"]::placeholder {
                font-size: 13px;

            }

        }

    </style>
</head>

<body class="antialiased">

    <div class="wrapper text-center">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <p class="title1">ワークフローシステムへようこそ</h2>
            <div class="card">
                <p class="sub-title"><b>ログイン</b></h3>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show ml-4 mr-4" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <div class="form-group text-left">
                    <label for="">社員ID</label>
                    <input type="text" class="form-control" name="username" placeholder="社員ID又はメールアドレスをご入力ください">

                </div>
                <div class="form-group text-left form-m-t">
                    <label for="">パスワード</label>
                    <input type="password" class="form-control" name="password" placeholder="●●●●●●●●">

                </div>
                <div class="form-group text-left form-m-t">
                    <input type="checkbox" name="remember" id="remember">
                    <label class="remember" for="remember"> 自動ログイン</label>
                </div>
                <div class="form-group form-m-t">
                    <button class="btn btn-primary w-100">ログイン</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>
