<section class="content">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Add Coach 
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  action="#" method="post">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">SI.No.</th>
                                                <th class="font-12" style="background: #2196f3;">Coach Number</th>
                                                <th class="font-12" style="background: #2196f3;">Coach Category</th>
                                                <th class="font-12" style="background: #2196f3;">Action</th>
                                               
                                            </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/">1</td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><input type='text' class='form-control' name='form_title' id="coachNumber" required minlength='1' maxlength='500' value="" ></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><input type='text' class='form-control' name='form_title' id="coachCategory" required minlength='1' maxlength='500' value="" ></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><button type="submit" id="submitCoach" class="btn btn-success" name="submit">
                                                     Add Coach
                                                    </button></td>
                                            </tr>
                                    </tbody>
                                </table>

                                </form>
                                


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

        </div>
    </section>