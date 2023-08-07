$(document).ready(function () {   
    $("#preloader").hide();
    function showPreloader() {
      $("#preloader").show();
    }
    // Function to hide preloader
    function hidePreloader() {
      $("#preloader").hide();
    }
    var isVisible = true;
    var ids = 2;
    $(document).on('click', '.pbtn', async function (e) {
      e.preventDefault();
      var elmId = $(this).parent().parent().parent().attr("id");

      var html = `<div id="` + "pform" + ids + `" class="appendChild ghyt" method="post">
    <div class=" container mb-4 justify-content-center d-flex justify-content-between flex-wrap border border-dark rounded-1 position-relative"
    id="reform" style="width: 95%;">
            <div class="mb-3">
              <label for="" class="form-label">Name</label>
              <input type="text" class="form-control username" name =data[`+ids+`][name] id="" aria-describedby="emailHelp"
                placeholder="Enter Your Name" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="email" name =data[`+ids+`][email] class="form-control useremail" id="" placeholder="Enter Your Email" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Mobile</label>
              <input type="tel" name =data[`+ids+`][mobile] class="form-control vmobile userphone" pattern="[0-9]{10}" id="" placeholder="Enter Mobile Number" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Address</label>
              <input type="text" name =data[`+ids+`][address] class="form-control address"  id=""
                placeholder="Enter Address" required>
            </div
          <!-- Plus Button -->
            <div class="position-absolute" style="right: -15px;bottom: 0;" id="`+ "ppform" + ids + `">
              <label for="" id="`+ "pp2form" + ids + `" class="pbtn"><i class="fa-sharp fa-solid fa-plus border border-dark rounded-circle p-2 bg-success"
                  style="color: #eaeaea;"></i></label>
            </div>
            <div class="position-absolute" style="right: -15px;" id="minusbtn">
              <label for=""><i class="fa-sharp fa-solid fa-minus border border-dark rounded-circle p-2 bg-danger"
                  style="color: #eaeaea;"></i></label>
            </div>
    </div>
    <!-- Form End -->
</div>`;
      $(html).insertAfter('#' + elmId);
      ids++;
    //   await updateDivIds();
    });

    $(document).on('click', '#minusbtn', function (e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    //   updateDivIds();
    });
  });
 

  // form submit
  $(document).ready(function () {
  $('#subform').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: '/submit-form',
      method: 'post',
      data: $(this).serialize(),
      success: function (response) {
        var successResponse = {
          success: true,
          message: 'Operation successful!'
        };
        var errorResponse = {
          success: false,
          message: 'Something went wrong!'
        };  
        if (response.status == 200) {
          showAlert(successResponse,'success');
        } else {
          showAlert(errorResponse,'error'); 
        }
        $("#subform")[0].reset();
        $(".appendChild").remove();   
        console.log(response);
      }
    });
  });

  function showAlert(response,iconc) {
    if (response.success) {
      Swal.fire({
        showConfirmButton: false,
        text: response.message,
        icon: iconc,
        timer: 3000
      });
    } else {
      Swal.fire({
        icon: iconc,
        title: 'Oops...',
        text: 'Something went wrong!',
      });
    }
  }
});

  