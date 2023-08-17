<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multiple Image Upload</title>
    @include('header')
</head>

<body>
    <div class="container card col-8 d-flex justify-content-center mt-5">
        <form action="{{ url('/multipleImageupload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header d-flex justify-content-between">
                <label for="" class="fs-5">Upload Image</label>
                <a href="{{url('/show-image')}}"><label for="" class="fs-5">Show Images</label></a>
            </div>

            @if (session('success'))
                <h6 class="text-center text-success"> {{ session('success') }} </h6>
            @endif
            @if (session('error'))
                <h6 class="text-center text-danger"> {{ session('error') }} </h6>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">
                <label for="">Upload File</label>
                <input type="file" class="form-control" name="image[]" value="" multiple>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn rounded-3 btn-primary">Import Data</button>
            </div>
        </form>
        <div class="col-9">
            @php
                $image = DB::table('mulitimageupload')
                    ->where('id', 16)
                    ->first();
                $images = explode('|', $image->image);  //help to split url
            @endphp

            @foreach ($images as $image)
                <img src="{{ URL::to($image) }}" class="w-25 h-25" alt="">
            @endforeach
        </div>
    </div>
    @include('footer')
</body>

</html>
