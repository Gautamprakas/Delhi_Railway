<script>
    document.title = '<?php echo "Data Sheet"; ?>';
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
                            <option>--Select Train Number--</option>
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
                                <?php echo "Data Sheet"." <span></span>"; ?>
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table id="myTable" class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">SI.No</th>
                                               <th class="font-12" style="background: #2196f3;">Coach number</th>
                                               <th class="font-12" style="background: #2196f3;">Coach Type</th>
                                               <th class="font-12" style="background: #2196f3;">Area</th>
                                               <th class="font-12" style="background: #2196f3;">Work Category</th>
                                               <th class="font-12" style="background: #2196f3;">Work Status</th>
                                               <th class="font-12" style="background: #2196f3;">Item Name</th>
                                               <th class="font-12" style="background: #2196f3;">Qty</th>
                                               <th class="font-12" style="background: #2196f3;">UOM</th>
                                               <th class="font-12" style="background: #2196f3;">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody id="myTableBody">
                                        <tr data-class class="all odd" role="row">
                                            <td id="tableId1" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId2" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId3"  class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId4" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId5" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></span></td>
                                            <td id="tableId6" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId7" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId8" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId9" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                            <td id="tableId10" class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"></td>
                                        </tr>
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