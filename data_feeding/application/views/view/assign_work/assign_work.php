<script>
    document.title = '<?php echo $form_title; ?>';
</script>
<style type="text/css">
    .form-inline .bootstrap-select.btn-group .form-control{
        width : 85%;
    }
    .bootstrap-select.btn-group .dropdown-menu{
        z-index: 999;
    }
</style>
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
                                <?php echo $form_title." <span></span>"; ?>
                                &nbsp; &nbsp;
                                <button type="button" class="btn btn-success m-t-15 waves-effect save_changes">Save Changes</button>
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        <tr>
                                            <th>Sno</th>
                                            <th><?php echo $typename; ?> ID</th>
                                            <th><?php echo $typename; ?> Name</th>
                                            <th>Assigned Train Numbers</th>
                                            <th>Assign Train Numbers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno=0; foreach($users as $index => $user){ 
                                              $user_train_numbers = implode(", ", $user->train_numbers);
                                        ?>
                                        <tr>
                                            <td><?php echo ++$sno; ?></td>
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo $user->name; ?></td>
                                            <td><?php echo $user_train_numbers; ?></td>
                                            <td>
                                                <select 
                                                class="form-control show-tick train_numbers" 
                                                data-live-search="true" 
                                                data-selected-text-format="count"  
                                                multiple 
                                                data-username="<?php echo $user->username; ?>" 
                                                data-type="<?php echo $type; ?>" 
                                                data-assigned="<?php echo $user_train_numbers; ?>" 
                                                data-size="4">
                                                    <?php foreach($train_numbers as $train_number){ ?>
                                                        <option <?php echo array_search($train_number, $user->train_numbers) !== FALSE ? "selected" : ""; ?> ><?php echo $train_number; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
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