<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Form</title>
    @include('header')
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <form class="col-md-4 p-3 bg-secondary  rounded-3" method="POST" action="{{url('/')}}/register">
            @csrf
            <h3>User form</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" name = 'email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
    
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Gender</label>
                <label for=""><input type="radio"  name="gender" id="exampleInputEmail1" aria-describedby="emailHelp" value="male">Male</label>
                <label for=""><input type="radio"  name="gender" id="exampleInputEmail1" aria-describedby="emailHelp" value="female">Female</label>
              </div>
    
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Address</label>
              <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>   
            <button type="submit" class="form-control btn btn-primary">Submit</button>
        </form>
    </div>
    @include('footer')
</body>
</html>