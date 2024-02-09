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
                                <?php echo "Edit Warranty"." <span></span>"; ?>
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">Sno</th>
                                                
                                                <th class="font-12" style="background: #2196f3;">Warranty In Days</th>
                                                <th class="font-12" style="background: #2196f3;">Action</th>
                                                <th class="font-12" style="background: #2196f3;">Status</th>
                                               
                                            </tr>
                                        
                                    </thead>
                                    <tbody>

                                        <?php if(count($data)>0){ ?>
                                            <?php $i=0; foreach($data as $row){ ?>
                                                <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><?php echo ++$i; ?></td>
                                                   
                                                    <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;"><?php echo $row['days'];?></td>
                                                    <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;">
                                                    <select id="warrantyStatus_<?php echo $i; ?>" class="form-control input_type show-tick" name="" data-size="5" data-properties="<?php echo $row['days'] ; ?>" required >
                                                            <option value="">--Select Input Type--</option>
                                                            <option value="Delete">Delete</option>
                                                    </select>
                                                    
                                                    </td>
                                                    <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;">
                                                        <button type="submit" id="updateStatus_<?php echo $i; ?>" onclick="submitData(this)" class="btn btn-success" name="submit">
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
