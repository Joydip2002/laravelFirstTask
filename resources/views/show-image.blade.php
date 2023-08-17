<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show all Image</title>
    @include('header')
</head>

<body>
    @php
        $number = 1;
    @endphp
    <div class="container col-5">
      <table class="table" >
        <thead>
            <tr>
                <th scope="col">Sl&nbsp;No</th>
                <th scope="col">Images</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $idata)
                <td class="co2">{{ $number }}</td>
                @php
                    $id = $idata->id;
                    $image = DB::table('mulitimageupload')
                        ->where('id', $id)
                        ->first();
                    $images = explode('|', $image->image);
                @endphp
                <td>
                    @foreach ($images as $image)
                        <img src="{{ URL::to($image) }}" height="40px" width="40px" alt="">
                    @endforeach
                </td>
                </tr>
                @php
                    $number++;
                @endphp
            @endforeach
        </tbody>
    </table>
    </div>
    @include('footer')
</body>

</html>
