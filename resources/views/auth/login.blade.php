<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <!-- Styles -->
</head>
<body class="login-body bg-success" >
<div id="app">
    <form action="{{ route('login')  }}" method="post">
        {{ csrf_field() }}
        <div class="container-fluid" align="center" style="margin-top:100px;">

                    <div class="card  w-25 bg-s"  >
                        @if(isset($warningMessage))
                            @foreach($warningMessage as $message)
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                        <div class="card-header"><b>ARTIMETRİK</b> <br></div>
                        <div class="card-body text-left">
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <label for="email">Kullanıcı Adı</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                                       placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <label for="password">Şifre</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Şifre">
                            </div>
                            <button type="submit" class="btn btn-success">Oturum Aç</button>
                        </div>
                    </div>
        </div>
    </form>
</div>

</body>
</html>
