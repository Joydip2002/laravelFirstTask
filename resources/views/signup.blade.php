<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup Page</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
    </style>
    @include('loginheader')
</head>

<body>
    <div class="container col-9 d-flex flex-column justify-content-center align-items-center min-vh-100">
        <form action="{{ url('/signup-user') }}" method="POST" class="col-4 ">
            @csrf
            @if (session('mail'))
                <div class="alert alert-success">
                    {{ session('mail') }}
                </div>
            @endif
            <h4 class="">Register</h4>
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <span>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            <span>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>
            <div class="my-1">
                <input type="radio" name="gender" id="m" value="male"><label for="m">Male</label>
                <input type="radio" name="gender" id="f" value="female"><label
                    for="f">Female</label><br>
            </div>
            <span>
                @error('gender')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>
            <label for="">Address</label>
            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
            <span>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
            <label for="">Confirm Password</label>
            <span>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>
            <input type="password" class="form-control" name="confirmpassword">
            <span>
                @error('confirmpassword')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>
            <button type="submit" class="btn btn-info w-100 mt-3">Register</button>
        </form>
        <div class="mt-3">Already Register?&nbsp;<a href="{{ url('/') }}">Login now</a></div>
    </div>

    @include('footer')
</body>

</html>
