	<div class="modal fade" id="modalsignupForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign Up</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body mx-3">

        <label data-error="wrong" data-success="right" for="" class="error"></label>

        <div class="md-form mb-5">
          <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
          <input type="text" id="name" class="form-control validate" placeholder="Enter Name" autocomplete="off">
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label> -->
        </div>

        <div class="md-form mb-5">
          <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
          <input type="number" id="mobile" class="form-control validate" placeholder="Enter Mobile Number" autocomplete="off">
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label> -->
        </div>

        <div class="md-form mb-4">
          <!-- <i class="fas fa-lock prefix grey-text"></i> -->
          <input type="password" id="password" class="form-control validate" placeholder="Enter Password" autocomplete="off">
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label> -->
        </div>

        <div class="md-form mb-4">
          <!-- <i class="fas fa-lock prefix grey-text"></i> -->
          <textarea id="address" class="form-control validate" placeholder="Enter Address" autocomplete="off"></textarea>
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label> -->
        </div>

        <div class="md-form mb-4">
          <!-- <i class="fas fa-lock prefix grey-text"></i> -->
          <a href="<?php echo base_url(); ?>home" class="modal-user-link">Login For Existing User</a>
          <a href="<?php echo base_url(); ?>kanpurneeds.apk" class="modal-user-link" style="float: right">Download Android App</a>
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label> -->
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info signup">Sign Up</button>
      </div>
    </div>
  </div>
</div>
