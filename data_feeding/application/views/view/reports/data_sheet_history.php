<script>
    document.title = '<?php echo $form_title; ?>';
</script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                    <!-- Create Form -->
                    <div class="card">
                    <form class="form-group form-float">
                      <table class="custom-table" style="width: 100%;font-weight: bold;">
                        <thead>
                        <tr style="margin-top: 50px;">
                          <td>
                            <label for="trainNumber">Train Number:</label>
                          <select  id="selectTrain" required>
                            <option value="">--Select Train Number--</option>
                        <?php
                            foreach ($train_numbers_dropdown as $row) { ?>
                             
                                <option value="<?php echo $row['train_number']; ?>" required>
                                    <?php echo $row['train_number']; ?>
                                </option>
                            <?php } ?>
                        

                        </select>
                          </td>
                          <td colspan="1" style="text-align: right;">
                            <label for="maintenancePerson">Coach Number And Type:</label>
                            <select  id="selectCoach" required>
                            <option value="">--Select Coach Number--</option>
                        <?php
                            foreach ($coach_numbers as $row) { ?>
                             
                                <option value="<?php echo $row['coach_number']; ?>" required>
                                    <?php echo $row['coach_number']; ?>
                                </option>
                            <?php } ?>
                        

                        </select>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label for="selectStatus">Work Status:</label>
                          <select  id="selectStatus" required>
                            <option value="">--Select Work Status--</option>
                        <?php
                            foreach ($work_status as $row) { ?>
                             
                                <option value="<?php echo $row['status']; ?>" required>
                                    <?php echo $row['status']; ?>
                                </option>
                            <?php } ?>
                        

                        </select>
                          </td>
                          <td colspan="1" style="text-align: right;">
                            <label for="trainNumber">Work Area:</label>
                        <select  id="selectBerth" required>
                            <option value="">--Select Work Area--</option>
                            <?php
                            foreach ($berth as $row) { ?>
                             
                                <option value="<?php echo $row['berth']; ?>" required>
                                    <?php echo $row['berth']; ?>
                                </option>
                            <?php } ?>
                        </select>

                            
                          </td>
                        </tr>
                        <tr>
                         <td>
                            <label for="date">Date:</label>
                            <input type="date" id="date" data-info="<?php echo $form_id ; ?>" size="30" required style="margin-left:20px ;">
                          </td>
                            <td colspan="1" style="text-align: right;">
                            <label for="selectCategory">Work Category:</label>
                        <select  id="selectCategory" required>
                            <option value="">--Select Work Category--</option>
                            <?php
                            foreach ($work_category as $row) { ?>
                             
                                <option value="<?php echo $row['category']; ?>" required>
                                    <?php echo $row['category']; ?>
                                </option>
                            <?php } ?>
                        </select>
                          <td>
                              
                          </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" id="submitTrain" class="btn btn-success">
                                               Submit
                                            </button>
                            </td>
                        </tr>
                    </thead>
                      </table>
                    </form>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                <?php echo $form_title." <span></span>"; ?>
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">SI.No</th>
                                                <th class="font-12" style="background: #2196f3;">Train Number</th>
                                                <th class="font-12" style="background: #2196f3;">Date</th>
                                               <th class="font-12" style="background: #2196f3;">Work Category</th>
                                               <th class="font-12" style="background: #2196f3;">Item Name</th>
                                               <th class="font-12" style="background: #2196f3;">QTY</th>
                                               <th class="font-12" style="background: #2196f3;">UOM</th>
                                               <th class="font-12" style="background: #2196f3;">Work Date</th>
                                                <th class="font-12" style="background: #2196f3;">Is Six Month Done</th>
                                                <th class="font-12" style="background: #2196f3;">Work Code</th>
                                                <th class="font-12" style="background: #2196f3;">Warranty In Days</th>
                                                <th class="font-12" style="background: #2196f3;">Data Feed By</th>
                                                <th class="font-12" style="background: #2196f3;">Approved By</th>
                                            </tr>
                                    </thead>
                                    <tbody id="myTableBody">
<?php if(count($newData)>0){ $i=0; ?>
    <?php foreach($newData as $data){ ?>
        <?php if(count($data) > 0){ ?>
            <?php foreach($data as $req_id => $row){ ?>
                <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                    <td class="font-12" style="/*background: #e3f2fd;*/"><?php echo ++$i; ?></td>
                    <?php foreach($newKeys as $key){ ?>
                        <?php if($key == "1690365766_5"){ 
                            $work="work";
                            if(isset($row[$key])){ // Fixed the missing closing parenthesis here
                                $work = $row[$key];
                                $workParts = explode("|", $work);
                                if(count($workParts) > 1){
                                    $work = $workParts[0];
                                    $valueParts = explode("-", $work);
                                    if(count($valueParts) > 1){
                                        $work = $valueParts[1];
                                    }
                                }
                            }
                        ?>
                            <td class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"><?php echo $work; ?></td>
                        <?php } else { ?>
                            <td class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"><?php echo isset($row[$key]) ? $row[$key] : ''; ?></td>
                        <?php }?>
                    <?php }?>
                </tr>
            <?php } ?>
        <?php }?>
    <?php }?>
<?php } ?>
        
                                        
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>









        </div>
    </section>


<!-- Modal -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Update</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect save_changes">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>