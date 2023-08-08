<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student View</title>
    @include('header')
</head>
<body>
    <div class="container text-center fs-3">Student Data</div>
    <table class="table container table-bordered table-striped">
        {{-- <pre>
            {{print_r($studentData->toArray())}}
        </pre> --}}
        <thead class="bg-dark">
          <tr>
            <th scope="col" class="text-white">Sl no</th>
            <th scope="col" class="text-white">Name</th>
            <th scope="col" class="text-white">Email</th>
            <th scope="col" class="text-white">Mobile</th>
            <th scope="col" class="text-white">Address</th>
            <th scope="col" class="text-white">Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $number = 1;
            @endphp
            @foreach ($studentData as $sdata)
            <tr>
                <td>{{$number}}</td>
                <td>{{$sdata->name}}</td>
                <td>{{$sdata->email}}</td>
                <td>{{$sdata->mobile}}</td>
                <td>{{$sdata->address}}</td>
                <td class="text-center"><button class="btn btn-success m-2">Update</button>&nbsp;<button class="btn btn-danger m-2">Delete</button></td>
            </tr>
            @php
                $number++;
            @endphp
            @endforeach  
        </tbody>
      </table>
    @include('footer')
</body>
</html>