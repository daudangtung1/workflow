<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="antialiased">
    <div class="row">
        <div class="col-md-3 text-center m-auto p-3">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="mt-5"><b>ワークフローシステムへようこそ</b></h2>
                <h3 class="mt-5"><b>ログイン</b></h3>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                <div class="form-group text-left">
                    <label for="">パスワード</label>
                    <input type="password" class="form-control" name="password" placeholder="********">

                </div>
                <div class="form-group text-left">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> 自動ログイン</label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" style="width: 100%"><b>ログイン</b></button>
                </div>
            </form>
        </div>

    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>
