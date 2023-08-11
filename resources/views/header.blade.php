<!-- Bootstrap Css Link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Bootstrap Css Link -->

<!-- Favicon Link -->
<link rel="icon" href="{{asset('favicon.ico') }}" type="image/x-icon">

<link rel="stylesheet" href="../css/index.css" />
<!-- Favicon Link -->

<!-- Ajax Link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- Ajax Link -->

<!-- Datatable Css Link -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<!-- Datatable Css Link -->

<!-- Swal Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Swal Alert -->

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark position-sticky top-0" style="background: #1f2940">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">SentientGeeks</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/studentview')}}">View Student</a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>

