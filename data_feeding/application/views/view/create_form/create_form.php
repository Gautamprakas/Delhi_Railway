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
                                Created Forms
                            </h2>
                        </div>
                        <div class="body" style="overflow-x: scroll;">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        <tr>
                                            <th>Sno</th>
                                            <th>Title</th>
                                            <th>Fields</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($data as $row){ ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $row->form_title; ?></td>
                                                <td><?php echo $row->fields_count; ?></td>
                                                <td><?php echo $row->update_datetime; ?></td>
                                                <td>
                                                     <div class="icon-button-demo">
                                                       <?php if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="dept" ){ ?>
                                                             <a href="<?php echo base_url("view/CreateForm/updateForm/".$row->form_id); ?>" class="btn btn-danger waves-effect" title="Edit Form Schema">
                                                                <i class="material-icons">mode_edit</i>
                                                            </a>
                                                       <?php } ?>
                                                        <a href="<?php echo base_url("view/CreateForm/viewFormData/".$row->form_id); ?>" class="btn btn-primary waves-effect" title="View Form Data">
                                                            <i class="material-icons">visibility</i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<?php if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="dept"){ ?>
                        <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Create New Form
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  action="#" method="post">


                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-success" name="submit">
                                                 Save
                                            </button>
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <input type='text' class='form-control' name='form_title' required minlength='1' maxlength='500' >
                                                    <label class='form-label'>Form Title</label>
                                                    <div class='help-info'> </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class='col-sm-1'>
                                            <button type="button" class="btn btn-success add_row btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>




                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
<?php } ?>

        </div>
    </section>