<section class="content">
        <div class="container-fluid">
            <div class="block-header">
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Add Work
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  action="#" method="post">


                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1">

                                            <!-- <button type="submit" class="btn btn-success" name="submit">
                                                 Update
                                            </button> -->
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <input type='text' id="workName" class='form-control' name='form_title' required minlength='1' maxlength='500' value="" >
                                                    <label class='form-label'>Work Name</label>
                                                    <div class='help-info'> </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1">

                                            <!-- <button type="submit" class="btn btn-success" name="submit">
                                                 Update
                                            </button> -->
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <input type='text' id="workCode" class='form-control' name='form_title' required minlength='1' maxlength='500' value="" >
                                                    <label class='form-label'>Work Code</label>
                                                    <div class='help-info'> </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1">

                                            <!-- <button type="submit" class="btn btn-success" name="submit">
                                                 Update
                                            </button> -->
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <input type='text' id="workRate" class='form-control' name='form_title' required minlength='1' maxlength='500' value="" >
                                                    <label class='form-label'>Work Rate</label>
                                                    <div class='help-info'> </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1">
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <input type='text' id="warrantyDays" class='form-control' name='form_title' required minlength='1' maxlength='500' value="" >
                                                    <label class='form-label'>Warranty In Days</label>
                                                    <div class='help-info'> </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1"></div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <select id="categoryValue" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select Category--</option>
                                                            <?php 
                                                            foreach($result_categories as $row){ ?>
                                                                <option value="<?php echo $row['category'] ; ?>"><?php echo $row['category'] ; ?></option>

                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1"></div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <select id="itemValue" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select Item--</option>
                                                            <?php 
                                                            foreach($item_name as $row){ ?>
                                                                <option value="<?php echo $row['item_name'] ; ?>"><?php echo $row['item_name'] ; ?></option>

                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1"></div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <select id="uomValue" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select UOM--</option>
                                                            <?php 
                                                            foreach($result_uom as $row){ ?>
                                                                <option value="<?php echo $row['uom'] ; ?>"><?php echo $row['uom'] ; ?></option>

                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1"></div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <button type="submit" id="submitWork" class="btn btn-success" name="submit">
                                                     Add Work
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

        </div>
    </section>