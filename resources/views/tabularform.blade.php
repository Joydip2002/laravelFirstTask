<!-- <?php
session_start();
?> -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="" href="tabimage.png">
    <title>Tabular Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{asset('/style.css')}}">
</head>

<body class="container">
    <!-- preloader -->
    <div class="preloader pl" id="preloader">
        <!-- Add your preloader animation or image here -->
        Loading...
        <!-- <span class="s s1"> </span>
    <span class="s s2"> </span> -->
    </div>

    <!-- Modal for image functionalities -->
    <div id="imageModal" class="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="imageContainer"></div>
                    <div class="d-flex justify-content-center mt-2 gap-4">
                        <i class="icon fa-solid fa-rotate-right crotate"></i>
                        <i class="icon fa-solid fa-rotate-left antirotate"></i>
                        <i class="icon fa-solid fa-magnifying-glass-plus zoom-in-button"></i>
                        <i class="icon fa-solid fa-magnifying-glass-minus zoom-out-button"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="saveButton">Save</button> <!-- New save button -->
                    <button id="closeButton" class="bg-danger">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end image modal -->

    <!-- Navbar -->
    <div class="border border-dark ">
        <header class="mb-3 border border-dark">
            <div class=" p-2 bg-secondary text-center">
                <h4 class="text-white">Tabular Form</h4>
                <div class="iconimg">
                    <span id="view" class="v2"><i class="fa-sharp tableicon fa-solid fa-table"></i></span>
                    <span><ion-icon name="eye" id="view" class="v1"></ion-icon></span>
                </div>
            </div>
        </header>

        <!-- Form -->
        <div class="formdiv tab-content" id="nav-tabContent">
            <div class="formdiv1 content tab-pane fade show active" id="nav-form" role="tabpanel"
                aria-labelledby="home-tab" tabindex="0">
                <form name="subform" id="subform" enctype="multipart/form-data">
                    @csrf
                    <div id="pform1" class="ghyt">
                        <div class="container d-flex justify-content-center justify-content-between flex-wrap mb-4 border border-dark rounded-1 position-relative"
                            id="reform" style="width: 95%;">

                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control username" name="data[1][name]" id="namefield"
                                    aria-describedby="emailHelp" placeholder="Enter Your Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="data[1][email]" class="form-control useremail" id="emailfield"
                                    placeholder="Enter Your Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Mobile</label>
                                <input type="tel" name="data[1][mobile]" class="form-control userphone vmobile"
                                    pattern="[0-9]{10}" id="" placeholder="ex : 1234567890" required>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="data[1][address]" class="form-control address" id=""
                                    placeholder="Enter Address" required>
                            </div>

                            <!-- <input type="hidden" name="id" value="1"> -->
                            <!-- Plus Button -->
                            <div class="position-absolute" style="right: -15px;bottom: 0;" id="parent1">
                                <label for="" id="plusbtn1" class="pbtn"><i
                                        class="fa-sharp fa-solid fa-plus border border-dark rounded-circle p-2 bg-success"
                                        style="color: #eaeaea;"></i></label>
                            </div>

                            <div class="position-absolute" style="right: -15px; visibility: hidden;" id="minusbtn">
                                <label for=""><i
                                        class="fa-sharp fa-solid fa-minus border border-dark rounded-circle p-2 bg-danger"
                                        style="color: #eaeaea;"></i></label>
                            </div>
                        </div>
                    </div>
                    <!-- Form End -->
                    <div class="position-relative sbtn" style="right: 0;">
                        <input type="submit" name="submit" id="isbtn" value="Submit"
                            class="mt-2 mb-2 p-2 bg-primary">
                    </div>
                </form>
            </div>
            <div class="listdata content tab-pane fade show active" id="nav-list" role="tabpanel"
                aria-labelledby="home-tab" tabindex="0">
            </div>
            <div class="chart content tab-pane fade show active" id="nav-chart" role="tabpanel"
                aria-labelledby="home-tab" tabindex="0">
            </div>
        </div>
    </div>
    <!-- swalalert & jquery & chatjs cdn link -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
    <script src="https://kit.fontawesome.com/4cae11b526.js" crossorigin="anonymous"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/4cae11b526.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="{{asset('/script.js')}}"></script>
</body>

</html>
