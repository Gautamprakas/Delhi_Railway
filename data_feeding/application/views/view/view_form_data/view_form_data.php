<script>
    document.title = '<?php echo $form_title; ?>';
</script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <!-- Create Form -->
                    <small></small>
                </h2>
            </div>


             <!-- <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php //echo BG_BLUE_GREY; ?>">
                            <h2>
                                <?php //echo "Summary <span>(Up To $last_date)</span>"; ?>
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead class="<?php //echo BG_BLUE_GREY; ?>">
                                        <tr>
                                            <th class=" font-12" style="background: #2196f3;">ब्लॉक /  नगर पालिका</th>
                                            <th class=" font-12" style="background: #ef5350;">Today Normal</th>
                                            <th class=" font-12" style="background: #f44336;">Today Warning</th>
                                            <th class=" font-12" style="background: #ef5350;">Today Arogay Setu Installed</th>
                                            <th class=" font-12" style="background: #ef5350;">Today Arogay Setu Not Installed</th>
                                            <th class=" font-12" style="background: #ef5350;">Today Home Quarantine Follow</th>
                                            <th class=" font-12" style="background: #ef5350;">Today Home Quarantine Not Follow</th>
                                            <th class=" font-12" style="background: #26a69a;">Total Normal</th>
                                            <th class=" font-12" style="background: #009688;">Total Warning</th>
                                            <th class=" font-12" style="background: #26a69a;">Total Arogay Setu Installed</th>
                                            <th class=" font-12" style="background: #26a69a;">Total Arogay Setu Not Installed</th>
                                            <th class=" font-12" style="background: #26a69a;">Total Home Quarantine Follow</th>
                                            <th class=" font-12" style="background: #26a69a;">Total Home Quarantine Not Follow</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php //foreach($summary as $block => $row){ ?>
                                            <tr>
                                                <td class=" font-12" style="background: #e3f2fd;"><?php //echo $block; ?></td>

                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-today_normal'; ?>"  class="view-filter-data font-12" style="background: #ffebee;">
                                                    <?php //echo $row["today_normal"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-today_warning'; ?>"  class="view-filter-data font-12" style="background: #ffcdd2;">
                                                    <?php //echo $row["today_warning"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-today_arogay_setu_installed'; ?>"  class="view-filter-data font-12" style="background: #ffebee;">
                                                    <?php //echo $row["today_arogay_setu_installed"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-today_arogay_setu_not_installed'; ?>"  class="view-filter-data font-12" style="background: #ffebee;">
                                                    <?php //echo $row["today_arogay_setu_not_installed"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-today_home_quarantine_follow'; ?>"  class="view-filter-data font-12" style="background: #ffebee;">
                                                    <?php //echo $row["today_home_quarantine_follow"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-today_home_quarantine_not_follow'; ?>"  class="view-filter-data font-12" style="background: #ffebee;">
                                                    <?php //echo $row["today_home_quarantine_not_follow"]; ?>
                                                </td>

                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-total_normal'; ?>"  class="view-filter-data font-12" style="background: #e0f2f1;">
                                                    <?php //echo $row["total_normal"]; ?></td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-total_warning'; ?>"  class="view-filter-data font-12" style="background: #b2dfdb;">
                                                    <?php //echo $row["total_warning"]; ?></td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-total_arogay_setu_installed'; ?>"  class="view-filter-data font-12" style="background: #e0f2f1;">
                                                    <?php //echo $row["total_arogay_setu_installed"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-total_arogay_setu_not_installed'; ?>"  class="view-filter-data font-12" style="background: #e0f2f1;">
                                                    <?php //echo $row["total_arogay_setu_not_installed"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-total_home_quarantine_follow'; ?>"  class="view-filter-data font-12" style="background: #e0f2f1;">
                                                    <?php //echo $row["total_home_quarantine_follow"]; ?>
                                                </td>
                                                <td data-class="<?php //echo str_replace(" ", "_", $block).'-total_home_quarantine_not_follow'; ?>"  class="view-filter-data font-12" style="background: #e0f2f1;">
                                                    <?php //echo $row["total_home_quarantine_not_follow"]; ?>
                                                </td>
                                                
                                            </tr>
                                        <?php //} ?>
                                        
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->


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
                                        <?php //if(count($data)>0){ $keys = array_keys(current($data)); ?>
                                        <?php if(count($data)>0){ //$keys = array_keys(current($data)); ?>
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">Sno</th>
                                                <?php foreach( $keys as $key){ if(isset($key_label[$key])){ ?>
                                                    <th class="font-12" style="background: #2196f3;"><?php echo $key_label[$key]; ?></th>
                                                <?php }} ?>
                                            </tr>
                                        <?php }?>
                                    </thead>
                                    <tbody>

                                        <?php if(count($data)>0){ ?>
                                            <?php $i=0; foreach($data as $req_id => $row){ ?>
                                                <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><?php echo ++$i; ?></td>
                                                    <?php foreach( $keys as $key){ ?>
                                                        <?php 
                                                                $edit = array("1589285939267_1");
                                                                if( array_search($key, $edit) !== FALSE ){
                                                         ?>
                                                            <td class="font-12" style="background: #e3f2fd;text-transform: capitalize;"><a href="<?php echo base_url("view/CreateForm/update_form_ui/".$req_id); ?>" target="_blank"><?php echo isset($row[$key])?$row[$key]:''; ?></a></td>
                                                        <?php }else{ ?>
                                                            <td class="font-12" style="/*background: #e3f2fd;*/text-transform: capitalize;"><?php echo isset($row[$key])?$row[$key]:''; ?></td>
                                                        <?php }?>
                                                        
                                                    <?php }?>
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