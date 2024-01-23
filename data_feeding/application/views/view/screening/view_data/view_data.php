<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Screened / Data
                    <small></small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Screened Data
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        <tr>
                                            <th>#</th>
                                            <th>Report</th>
                                            <th>Mother Name</th>
                                            <th>Father Name</th>
                                            <th>Age (Months)</th>
                                            <th>Height (cm)</th>
                                            <th>Weight (Kg)</th>
                                            <th>Gender</th>
                                            <th>Child Name</th>
                                            <th>DateTime</th>
                                            <th>Media</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno=0; foreach($data as $row): ?>
                                        <tr>
                                            <td><?php echo ++$sno; ?></td>

                                            <?php if($row->quiz==0||$row->media_url==0||$row->media==0): ?>
                                               <td><?php echo "Pending..."; ?></td>
                                            <?php endif; ?>
                                            

                                            <?php if($row->quiz==1&&$row->media_url==1&&$row->media==1&&$row->ai_model==0): ?>
                                                <td><?php echo "Analyzing..."; ?></td>
                                            <?php endif; ?>


                                            <?php if($row->quiz==1&&$row->media_url==1&&$row->media==1&&$row->ai_model==1): ?>
                                                <td><a href="<?php echo base_url("view/screening/screening_detail/".$row->child_id); ?>" class="btn <?php if($row->diagnosis!=''){ echo "btn-danger"; }else{ echo "btn-success"; } ?>" target="_blank">View Report</a></td>
                                            <?php endif; ?>


                                            <td><?php echo $row->mother_name; ?></td>
                                            <td><?php echo $row->father_name; ?></td>
                                            <td><?php echo $row->child_age_in_months; ?></td>
                                            <td><?php echo $row->height_in_cm; ?></td>
                                            <td><?php echo $row->weight_in_kg; ?></td>
                                            <td><?php echo $row->gender; ?></td>
                                            <td><?php echo $row->child_name; ?></td>
                                            <td><?php echo $row->record_datetime; ?></td> 

                                            
                                            
                                            <td>
                                                <?php if($row->media==1): ?>
                                                <a href="<?php echo base_url("view/screening/view_media/".$row->child_id); ?>" class="btn" target="_blank">View Media</a>
                                                <?php else: ?>
                                                    Pending...
                                                <?php endif; ?>
                                            </td>

                                                                                      
                                        </tr>
                                       <?php endforeach; ?>
                                       
                                    </tbody>
                                </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>