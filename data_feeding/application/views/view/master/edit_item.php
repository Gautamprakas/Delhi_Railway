<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <!-- Create Form -->
                    <small></small>
                </h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                <?php echo "Item List"." <span></span>"; ?>
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">Sno</th>
                                                
                                                <th class="font-12" style="background: #2196f3;">Item Name</th>
                                                <th class="font-12" style="background: #2196f3;">Unit Of Measurement</th>
                                                <th class="font-12" style="background: #2196f3;">Action</th>
                                                <th class="font-12" style="background: #2196f3;">Status</th>
                                               
                                            </tr>
                                        
                                    </thead>
                                    <tbody>

                                        <?php if(count($data)>0){ ?>
                                            <?php $i=0; foreach($data as $row){ ?>
                                                <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><?php echo ++$i; ?></td>
                                                    <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;"><?php echo $row['item_name'] ; ?></td>
                                                    <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;"><?php echo $row['uom_value'] ; ?></td>
                                                    <td>
                                                    <select id="trainStatus<?php echo $i; ?>" class="form-control input_type show-tick" name="" data-size="5" data-properties="<?php echo $row['item_name'] ; ?>" required >
                                                            <option value="">--Select Input Type--</option>
                                                            <option value="0">Block Item</option>
                                                            <option value="1">Active Item</option>
                                                            <option value="Delete Item">Delete Item</option>
                                                    </select>
                                                    
                                                    </td>
                                                    <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;">
                                                        <button type="submit" id="updateStatus" onclick="submitData()" class="btn btn-success" name="submit">
                                                            Update
                                                            </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php }?>
                                        
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>









        </div>
    </section>
