<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    @include('loginheader')
</head>
<body>
    <div class="container col-9 d-flex flex-column justify-content-center align-items-center min-vh-100">
        <form action="{{url('/reset-password-page')}}/{{$id}}" method="post" class="col-4">
            @csrf
            <h4 class="">Reset Password</h4>
            @if(Session::has('success'))
            <div class="alert col-4 alert-success alert-dismissible">{{Session::get('success')}}</div>
            @endif
            <label for="" class="fs-5">New Password</label>
            <input type="password" placeholder="New Password" name='password' class="form-control">
            <span>
                @error('password')
                    <div class="text-danger">{{$message}}</div>                    
                @enderror
            </span>
            <label for="" class="fs-5">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name='cpassword' class="form-control">
            <span>
                @error('cpassword')
                    <div class="text-danger">{{$message}}</div>                    
                @enderror
            </span>

            <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
        </form>
    </div>
    @include('footer')
</body>
</html>