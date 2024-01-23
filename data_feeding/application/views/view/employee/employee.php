 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>EMPLOYEE</h2>
            </div>
            
<!--Dismiss Alert-->
            <?php if($response = $this->session->flashdata("message")): ?>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="alert <?php echo $this->session->flashdata('css'); ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo ucwords($response); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div>
           <?php endif; ?>
<!--#END# Dismiss Alert-->

             <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                ADD EMPLOYEE
                                <small></small> 
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                            	<form  action="<?php echo base_url('Employee/insertEmployee'); ?>" method="post">


                               <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <select class="form-control show-tick" id="location_id" data-live-search="true" name="location_id" data-size="5" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                  
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <select class="form-control show-tick" id="office_type" data-live-search="true" name="office_type" data-size="5" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <select class="form-control show-tick" id="office_id" data-live-search="true" name="office_id" data-size="5" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required pattern="[a-zA-Z][a-zA-Z ]+" title="Ex : Employee Name">
                                                <label class="form-label">Employee Name</label>
                                                <div class="help-info"> </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <input type="text" class="form-control" name="mobile" required pattern="[789][0-9]{9}" maxlength="10" title="Number Start With 7,8,9Ex : 7897897897">
                                            <label class="form-label">10 Digit Mobile Number</label>
                                            <div class="help-info"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <input type="text" class="form-control" name="email" required pattern="[a-zA-Z0-9.!_]+[@][a-zA-Z]+[.][a-zA-Z]+" minlength="5" title="Ex : abcd@efg.com">
                                            <label class="form-label">Email Address</label>
                                            <div class="help-info"></div>
                                        </div>
                                    </div>
                                </div>

                               <!-- <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <input type="text" class="form-control" name="person_id" required pattern="[a-zA-Z0-9]+" maxlength="15" title="Ex : abcd125kjk" minlength="5">
                                            <label class="form-label">PAN / ADHAAR</label>
                                            <div class="help-info"></div>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                           <input type="text" class="form-control" name="password" required pattern="[a-zA-Z0-9!@]+" maxlength="15" minlength="5" title="maxLength = 15, Ex : Abdc!@23">
                                            <label class="form-label">Password</label>
                                            <div class="help-info">Special Charachter '!' , '@'</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <button type="submit" class="btn <?php echo BG_BLUE_GREY; ?> btn-lg m-l-15 waves-effect">Submit</button>
                                </div>

                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--#END INPUT-->    

            <!-- Input Slider -->
            <div class="row clearfix" style="display: none;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <p><b>Basic Example</b></p>
                                    <div id="nouislider_basic_example"></div>
                                    <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Range Example</b></p>
                                    <div id="nouislider_range_example"></div>
                                    <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input Slider -->        	
        </div>
</section>