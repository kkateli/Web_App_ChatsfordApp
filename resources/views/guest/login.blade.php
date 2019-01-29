<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <title>Chatsford Retirement Village</title>
    </head>


    <body>
    <center>
        <img src="{{ asset('assets/images/banner.png') }}" class="img-fluid mb-2">
    </center>
    
    <p></p>
    
<h1 class="h2 mb-3 font-weight-normal text-center">Welcome to Chatsford - The Lifestyle Choice</h1>

    <div class="container mt-5">

        <form class="form-signin" action="{{ route('login.post') }}" method="post">
            @if(session()->has('success'))
            <div class="alert alert-success mb-3">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Email address or Username" autofocus="">
                @if($errors->has('username'))
                <div class="error mt-1">
                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('username') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">

                @if($errors->has('password'))
                <div class="error mt-1">
                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('password') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="error mt-1">
                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ session()->get('error') }}
                </div>
                @endif
            </div>

            {{ csrf_field() }}
            <button class="btn btn-lg btn-primary btn-block btn-outline-dark" type="submit">Sign in</button>
        </form>
    </div>
    <p>

    </p>
</body>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>