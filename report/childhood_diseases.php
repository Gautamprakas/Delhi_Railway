<div style="margin-top: 5%">
  <div class="container">
    <div class="row justify-content-center text-center mb-5 section-2-title">
      <div class="col-md-5">
        <h1><span class="" style="color: #1c2d37;font-weight: bold;text-decoration: underline;">CHILDHOOD DISEASES</span></h1><br/>
      </div>
    </div>
    <div class="row align-items-stretch">
      <?php
      include('dbconn.php');
        $query = "SELECT disease_img,disease_name,disease_img_new FROM `disease_desc` WHERE disease_type='childhood_diseases'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)){
        ?>
        <div class="col-lg-3 pointer col-md-6 mb-5 d3_records">
          <input type="hidden" class="img_val3" value="<?php echo $row[1];?>">
          <div class="post-entry-1 h-100">
            <div class="polaroid section-2" style="border-radius: 10px;padding-bottom: 2px;padding-top: 7px;">
              <span><img src="images/<?php echo $row[2]; ?>" height="80px" width="80px" style="border-radius: 50px"></span>
              <h2 style="color: #F9E79F;text-transform: uppercase;font-size: 10px;letter-spacing: 1px;"><?php echo $row[1]; ?></h2>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>