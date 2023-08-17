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
        <form action="{{ url('/forgot-password-page') }}" method="post" class="col-4">
            @csrf
            <h4 class="">Forgot Password</h4>
            @if (Session::has('notmailsend'))
                <div class="alert alert-danger alert-dismissible">{{ Session::get('notmailsend') }}</div>
            @endif
            <label for="" class="">Email</label>
            <input type="email" placeholder="Enter Registration Email" name='email' class="form-control">
            <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
        </form>
    </div>
    @include('footer')
</body>

</html>
