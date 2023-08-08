<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fetch Excel Data and insert in database</title>
    @include('header')
</head>

<body>
    <div class="container mt-5">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if(session('arr'))
            <div class="alert alert-danger">
                <strong>Already Exits!!&nbsp;</strong>
                @foreach (session('arr') as $a)
                    {{ $a }}<br>
                @endforeach
            </div>
        @endif

        @if(session('errorarr'))
            <div class="alert alert-danger">
                <strong>Error!!</strong>
                @foreach (session('errorarr') as $earr)
                    {{ $earr }}<br>
                @endforeach
            </div>
        @endif


        {{-- <pre>
        @php
            print_r($errors->all());
        @endphp
        </pre> --}}
        <div class="fs-5 display-2">Here You Can Upload your excel file and directly insert data into database</div>
        <div class="card">
            <form action="{{ url('import-data') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <label for="" class="fs-5">Upload Xlsx File</label>
                </div>
                @error('excelFile')
                    <h6 class="text-center text-danger"> {{ $message }} </h6>
                @enderror
                <div class="card-body">
                    <label for="">Upload File</label>
                    <input type="file" class="form-control" name="excelFile" value="">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn rounded-3 btn-primary">Import Data</button>
                </div>
            </form>
        </div>
    </div>
    @include('footer')
</body>

</html>
