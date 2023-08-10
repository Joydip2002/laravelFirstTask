<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student View</title>
    @include('header')
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body style="background:#141b2d">
    <div class="container d-flex justify-content-between mt-3 flex-wrap">
        <span class="fs-2 text-white">Student Data</span>
        <span>
            <form action="/studentview" class="d-flex">
                <input class="form-control me-2" name="startSearchDate" type="date" placeholder="Start Date"
                    aria-label="Search" value="">
                <input class="form-control me-2" name="endSearchDate" type="date" placeholder="End Date"
                    aria-label="Search" value="">
                <button class="btn btn-outline-success" type="submit">Search</button>&nbsp;
                <a href="{{ url('/studentview') }}"><button class="btn btn-outline-success"><i
                            class="fa-solid fa-rotate-right"></i></button></a>
            </form>
        </span>
        <span>
            <form action="/studentview" class="d-flex">
                <input class="form-control me-2" name="search" type="search" placeholder="Search by Name and Email"
                    aria-label="Search" value="">
                <button class="btn btn-outline-success" type="submit">Search</button>&nbsp;
                <a href="{{ url('/studentview') }}"><button class="btn btn-outline-success"><i
                            class="fa-solid fa-rotate-right"></i></button></a>
            </form>
        </span>
    </div>
    <div class="container d-flex my-1">
        <button class="btn btn-success hidden" id="selected_id">Active All Selected</button>&nbsp;
        <button class="btn btn-info" id="bulk_id">Bulk Selected</button>
        <button class="btn btn-warning mx-1 hidden" id="inactive_selected_id">Inactive Selected All</button>
        <button class="btn btn-danger hidden" id="cancel_bulk">Cancel Bulk</button>
    </div>

    @if (session()->has('success'))
        <div class="container alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="container alert alert-erroe">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <table class="table container table-bordered table-striped">
            {{-- <pre>
                {{print_r($studentData->toArray())}}
            </pre> --}}
            <thead class="bg-dark">
                <tr>
                    <th class="hidden co1"><input type="checkbox" id="select_all_ids" class="hidden scheckboxtoggle">
                    </th>
                    <th scope="col" class="text-white co2">
                        <label for="{{ str_contains(url()->current(), 'asc') ? 'desc' : 'asc' }}" id="slLabel"
                            class="toggelOrder">
                            Sl no
                        </label>
                        &nbsp;&nbsp;
                        <span>
                            <a href="{{ url('/sortById/asc') }}" class="btn btn-sm btn-info" id="slasc">
                                <i class="fa-solid fa-up-long text-light"></i>
                            </a>
                            <a href="{{ url('/sortById/desc') }}" class="btn btn-sm btn-info" id="sldesc">
                                <i class="fa-solid fa-down-long text-light"></i>
                            </a>
                        </span>
                    </th>
                    <th scope="col" class="text-white">
                        <label for="{{ str_contains(url()->current(), 'asc') ? 'desc' : 'asc' }}" id="nameLabel"
                            class="toggelOrder">
                            Name
                        </label>
                        &nbsp;&nbsp;
                        <span>
                            <a href="{{ url('/sortByName/asc') }}" class="btn btn-sm btn-info" id="asc">
                                <i class="fa-solid fa-up-long text-light"></i>
                            </a>
                            <a href="{{ url('/sortByName/desc') }}" class="btn btn-sm btn-info" id="desc">
                                <i class="fa-solid fa-down-long text-light"></i>
                            </a>
                        </span>
                    </th>
                    <th scope="col" class="text-white">
                        <label for="{{ str_contains(url()->current(), 'asc') ? 'desc' : 'asc' }}" id="emailLabel"
                            class="toggelOrder">
                            Email
                        </label>
                        &nbsp;&nbsp;
                        <span>
                            <a href="{{ url('/sortByEmail/asc') }}" class="btn btn-sm btn-info" id="emailasc">
                                <i class="fa-solid fa-up-long text-light"></i>
                            </a>
                            <a href="{{ url('/sortByEmail/desc') }}" class="btn btn-sm btn-info" id="emaildesc">
                                <i class="fa-solid fa-down-long text-light"></i>
                            </a>
                        </span>
                    </th>
                    <th scope="col" class="text-white">Mobile</th>
                    <th scope="col" class="text-white">
                        <label for="{{ str_contains(url()->current(), 'asc') ? 'desc' : 'asc' }}" id="addressLabel"
                            class="toggelOrder">
                            Address
                        </label>
                        &nbsp;&nbsp;
                        <span>
                            <a href="{{ url('/sortByAddress/asc') }}" class="btn btn-sm btn-info" id="addressasc">
                                <i class="fa-solid fa-up-long text-light"></i>
                            </a>
                            <a href="{{ url('/sortByAddress/desc') }}" class="btn btn-sm btn-info" id="addressdesc">
                                <i class="fa-solid fa-down-long text-light"></i>
                            </a>
                        </span>
                    </th>
                    <th scope="col" class="text-white">Status</th>
                    <th scope="col" class="text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach ($studentData as $sdata)
                    <tr class="text-white">
                        <td class="hidden co1"><input type="checkbox" name='id'
                                class="scheckbox scheckboxtoggle hidden" value="{{ $sdata->id }}"
                                data-status="{{ $sdata->status }}"></td>
                        <td class="co2">{{ $number }}</td>
                        <td>{{ $sdata->name }}</td>
                        <td>{{ $sdata->email }}</td>
                        <td>{{ $sdata->mobile }}</td>
                        <td>{{ $sdata->address }}</td>
                        <td>
                            @if ($sdata->status == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/studentview/status') }}/{{ $sdata->id }}">
                                @if ($sdata->status == 1)
                                    <button class="btn btn-danger m-2">
                                        Inactive
                                    </button>
                                @else
                                    <button class="btn btn-success m-2">
                                        Active
                                    </button>
                                @endif
                            </a>

                            <a href="{{ url('/studentview/edit') }}/{{ $sdata->id }}"><button
                                    class="btn btn-success m-2">Update</button>
                            </a>
                            &nbsp;
                            <a href="{{ url('/studentview/delete') }}/{{ $sdata->id }}"
                                onclick="event.preventDefault(); deleteStudent('{{ $sdata->id }}');"><button
                                    class="btn btn-danger m-2">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @php
                        $number++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container text-center">
        {{ $studentData->links('pagination::bootstrap-5') }}
    </div>

    @include('footer')
</body>

</html>

{{-- <a href="{{ route('student.delete', $student->id) }}" onclick="event.preventDefault(); deleteStudent('{{ $student->id }}');">
    Delete
</a> --}}

<script>
    $(document).ready(function() {
        $("#select_all_ids").click(function() {
            $(".scheckbox").prop('checked', $(this).prop('checked'));
        });

        $("#selected_id").click(function(e) {
            e.preventDefault();
            var idsArr = [];
            $('input:checkbox[name=id]:checked').each(function() {
                var idStatus = $(this).data('status');
                if (idStatus == '0') {
                    idsArr.push($(this).val());
                }
                console.log(idsArr);

            });
            if (idsArr.length > 0) {
                $.ajax({
                    url: '{{ route('student-active-status') }}',
                    type: 'get', // Corrected method here
                    data: {
                        idsArr: idsArr,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data, status) {
                        console.log(data);
                        if (data.status === 200) {
                            Swal.fire({
                                position: 'middle-center',
                                icon: 'success',
                                text: data.message,
                                // confirmButtonText: "OK"
                                timer: 2000
                            }).then(() => {
                                window.location.href = "{{ 'studentview' }}";
                            });
                        } else {
                            Swal.fire({
                                position: 'middle-center',
                                icon: 'error',
                                text: "something went wrong!!",
                                // confirmButtonText: "OK"
                            })
                        }
                    }
                });
            } else {
                Swal.fire({
                    position: 'middle-center',
                    icon: 'error',
                    text: "nothing to activate!!",
                    // confirmButtonText: "OK"
                })
            }

        });
    });

    // Inactive status
    $("#select_all_ids").click(function() {
        $(".scheckbox").prop('checked', $(this).prop('checked'));
    });

    $("#inactive_selected_id").click(function(e) {
        e.preventDefault();
        var idsArr2 = [];
        $('input:checkbox[name=id]:checked').each(function() {
            var idStatus = $(this).data('status');
            if (idStatus == '1') {
                idsArr2.push($(this).val());
            }
            console.log(idsArr2);
        });

        if (idsArr2.length > 0) {
            $.ajax({
                url: '{{ route('student-inactive-status') }}',
                type: 'get', // Corrected method here
                data: {
                    idsArr2: idsArr2,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data, status) {
                    console.log(data);
                    if (data.status === 200) {
                        Swal.fire({
                            position: 'middle-center',
                            icon: 'success',
                            text: data.message,
                            // confirmButtonText: "OK"
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{ 'studentview' }}";
                        });
                    } else {
                        Swal.fire({
                            position: 'middle-center',
                            icon: 'error',
                            text: "something went wrong!!",
                            // confirmButtonText: "OK"
                        })
                    }
                }
            });
        } else {
            Swal.fire({
                position: 'middle-center',
                icon: 'error',
                text: "nothing to deactivate!!",
                // confirmButtonText: "OK"
            })
        }

    });



    $("#bulk_id").click(function() {
        $("#bulk_id").hide();
        $("#selected_id").show();
        $("#cancel_bulk").show();
        $("#inactive_selected_id").show();
        $(".scheckboxtoggle").show();
        $('.co1').show();
        $('.co2').hide();
    })
    $("#cancel_bulk").click(function() {
        $("#bulk_id").show();
        $("#selected_id").hide();
        $("#cancel_bulk").hide();
        $("#inactive_selected_id").hide();
        $(".scheckboxtoggle").hide();
        $('.co1').hide();
        $('.co2').show();
    })


    function deleteStudent(studentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('student-delete', '') }}/" + studentId;
            }
        });
    }
    // label
    const slLabel = document.getElementById('slLabel');
    const slascLink = document.getElementById('slasc');
    const sldescLink = document.getElementById('sldesc');
    // static_order(slLabel, slascLink, sldescLink);

    const nameLabel = document.getElementById('nameLabel');
    const ascLink = document.getElementById('asc');
    const descLink = document.getElementById('desc');
    // static_order(nameLabel, ascLink, descLink);

    const emailLabel = document.getElementById('emailLabel');
    const emailascLink = document.getElementById('emailasc');
    const emaildescLink = document.getElementById('emaildesc');
    // static_order(emailLabel, emailascLink, emaildescLink);

    const addressLabel = document.getElementById('addressLabel');
    const addressasc = document.getElementById('addressasc');
    const addressdesc = document.getElementById('addressdesc');
    // static_order(addressLabel, addressasc, addressdesc);



    if (window.location.href.includes('sortById')) {
        var url = window.location.href.includes('sortById');
        toggleOrder(slLabel, slascLink, sldescLink, url);
    }
    if (window.location.href.includes('sortByName')) {
        var url = window.location.href.includes('sortByName');
        toggleOrder(nameLabel, ascLink, descLink, url);
    }
    if (window.location.href.includes('sortByEmail')) {
        var url = window.location.href.includes('sortByEmail');
        toggleOrder(emailLabel, emailascLink, emaildescLink, url);
    }
    if (window.location.href.includes('sortByAddress')) {
        var url = window.location.href.includes('sortByAddress');
        toggleOrder(addressLabel, addressasc, addressdesc, url);
    }


    function toggleOrder(label, asclink, desclink, url) {
        var direction = label.getAttribute('for');
        if (direction === 'asc') {
            asclink.classList.remove('hidden'); // Show ascLink
            desclink.classList.add('hidden'); // Hide descLink
        } else {
            asclink.classList.add('hidden'); // Hide ascLink
            desclink.classList.remove('hidden'); // Show descLink
        }

        label.addEventListener('click', () => {
            const currentUrl = new URL(window.location.href);
            const newDirection = currentUrl.href.includes('asc') ? 'desc' : 'asc';
            label.setAttribute('for', newDirection);
            window.location.href = url + newDirection;
        });
    }
</script>
