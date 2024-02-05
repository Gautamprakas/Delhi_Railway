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
                            foreach ($railway_trains as $row) { ?>
                             
                                <option value="<?php echo $row['train_number']; ?>" data-info="<?php echo $row['username'];?>" required>
                                    <?php echo $row['train_number']; ?>
                                </option>
                            <?php } ?>
                        

                        </select>
                          </td>
                          <td colspan="1" style="text-align: right;">
                            <label for="maintenancePerson">Maintenance SEE/JEE:</label>
                            <span id="nameHere"></span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label for="date">Date:</label>
                            <input type="date" id="date" data-info="<?php echo $form_id ; ?>" size="30" required style="margin-left:20px ;">
                          </td>
                          <td colspan="1" style="text-align: right;">
                            <label for="maintenanceFrom">Maintenance Slot- From &nbsp;<input type="time" id="time1" name="maintenanceFrom" required></label>
                            <label for="maintenanceTo">&nbsp;to&nbsp;&nbsp;</label>
                            <input type="time" id="time2" name="maintenanceTo" required>
                            
                          </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" id="submitTrain" class="btn btn-success">
                                               Submit
                                            </button>
                            </td>
                            <td colspan="1" style="text-align: right;">
                            <button id="printButton" style="align-content: center;">Print</button>
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
                                               <th class="font-12" style="background: #2196f3;">Coach number</th>
                                               <th class="font-12" style="background: #2196f3;">Item Code/Activity Code</th>
                                               <th class="font-12" style="background: #2196f3;">Seat block/Area (C)</th>
                                               <th class="font-12" style="background: #2196f3;">Item Qty</th>
                                               <th class="font-12" style="background: #2196f3;">Max Rating</th>
                                               <th class="font-12" style="background: #2196f3;">Gain Rating</th>
                                               <th class="font-12" style="background: #2196f3;">Rating %</th>
                                               <th class="font-12" style="background: #2196f3;">Amt As per Tender</th>
                                               <th class="font-12" style="background: #2196f3;">Panelty Amt</th>
                                                <th class="font-12" style="background: #2196f3;">Net Pay</th>
                                            </tr>
                                    </thead>
                                    <tbody id="myTableBody">

<?php if(count($newdata)>0){ $i = 0; ?>
    <?php foreach($newdata as $data){  ?>
        <?php if(count($data) > 0){ ?>
            <?php foreach($data as $req_id => $row){ ?>
                <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                    <td class="font-12" style="/*background: #e3f2fd;*/"><?php echo ++$i; ?></td>
                    <?php foreach($newKeys as $key){ ?>
                            <?php if($key == "1690365766_5"){ 
                                $workGlobal=$row[$key];
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
                            <?php }else if($key=="amount"){
                                    if(isset($workGlobal)){
                                        $amt=explode("@", $workGlobal);
                                        if(count($amt)>1){
                                            $amt_parts=explode("$",$amt[1]);
                                            $amt=$amt_parts[0];
                                        }else{
                                            $amt="N/A";
                                        }
                                    }
                            ?>
                            <td class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"><?php echo $amt; ?></td>
                            <?php } else { ?>
                                <td class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"><?php echo isset($row[$key]) ? $row[$key] : ''; ?></td>
                        <?php } ?>
                    <?php }?>
                </tr>
            <?php } ?>
        <?php }?>
    <?php }?>
<?php }?>
                                        
                                    </tbody>
<tfoot>
    <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
        <td colspan="5" class="font-12" style="/*background: #e3f2fd;*/"><?php echo "Total Rating"; ?></td>
        <td id="totalMaxRating" class="font-12" style="/*background: #e3f2fd;*/"><?php echo $total_max_rating; ?></td>
        <td id="totalRatingGot" class="font-12" style="/*background: #e3f2fd;*/"><?php echo $totalRatingGot; ?></td>
        <td id="totalRatingPercent" class="font-12" style="/*background: #e3f2fd;*/"><?php echo $totalRatingPercent."%"; ?></td>
        <td id="totalAmount" class="font-12" style="/*background: #e3f2fd;*/"><?php echo number_format($totalAmount,2); ?></td>
        <td id="totalPenaltyAmt" class="font-12" style="/*background: #e3f2fd;*/"><?php echo $toal_penalty_amt; ?></td>
        <td id="totalRatingAmt" class="font-12" style="/*background: #e3f2fd;*/"><?php echo number_format($toalRatingAMount,2) ; ?></td>
    </tr>
                    
</tfoot>
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