<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
    
    </style>
    @include('loginheader')
</head>
<body>
    <div class=" contain container col-9 d-flex flex-column justify-content-center align-items-center min-vh-100">
       
        <h4 class="">Login</h4>
        @if(Session::has('fail'))
        <div class="alert col-4 alert-danger alert-dismissible">{{Session::get('fail')}}</div>
        @endif

        @if(Session::has('mailsend'))
        <div class="alert col-4 alert-success alert-dismissible">{{Session::get('mailsend')}}</div>
        @endif

        @if(Session::has('mail'))
        <div class="alert col-4 alert-success alert-dismissible">{{Session::get('mail')}}</div>
        @endif

        @if(Session::has('success'))
        <div class="alert col-4 alert-success alert-dismissible">{{Session::get('success')}}</div>
        @endif

        <form action="{{url('/euser-login')}}" method="POST" class="col-4">
            @csrf
            <label for="">Username(Email)</label>
            <input type="email" class="form-control" name="email">
            <span>
                @error('email')
                    <div class="text-danger">{{$message}}</div>                    
                @enderror
            </span>
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
            <span>
                @error('password')
                    <div class="text-danger">{{$message}}</div>                    
                @enderror
            </span>
            <div class="container d-flex justify-content-end">
                <a href="{{url('/forgot-password')}}" class="text-decoration-none">Forgot password</a>
            </div>
            <button type="submit" class="w-100 mt-2 btn btn-info">Login</button>
        </form>    
        <div class="mt-3">Don't have account?&nbsp;<a href="{{url('signup')}}">Signup</a></div>
    </div>
    
    @include('footer')
</body>
</html>