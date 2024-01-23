<section class="content">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Add Item
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  action="#" method="post">

                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example2">
                                <caption style="caption-side: top;color: #254756;font-weight: bold;" ></caption>
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        
                                            <tr>
                                                <th class="font-12" style="background: #2196f3;">Work Name</th>
                                                <th class="font-12" style="background: #2196f3;">Work Code</th>
                                                <th class="font-12" style="background: #2196f3;">Work Rate</th>
                                                <th class="font-12" style="background: #2196f3;">Work Category</th>
                                                <th class="font-12" style="background: #2196f3;">Item Name</th>
                                                <th class="font-12" style="background: #2196f3;">UOM</th>
                                                <th class="font-12" style="background: #2196f3;">Action</th>
                                               
                                            </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><input type='text' class='form-control' name='form_title'id="workName" required minlength='1' maxlength='500' value="" ></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><input type='text' class='form-control' name='form_title'id="workCode" required minlength='1' maxlength='500' value="" ></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><input type='text' class='form-control' name='form_title'id="workRate" required minlength='1' maxlength='500' value="" ></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><select id="categoryValue" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select Category--</option>
                                                            <?php 
                                                            foreach($result_categories as $row){ ?>
                                                                <option value="<?php echo $row['category'] ; ?>"><?php echo $row['category'] ; ?></option>

                                                            <?php } ?>
                                                    </select></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><select id="itemValue" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select Item--</option>
                                                            <?php 
                                                            foreach($item_name as $row){ ?>
                                                                <option value="<?php echo $row['item_name'] ; ?>"><?php echo $row['item_name'] ; ?></option>

                                                            <?php } ?>
                                                    </select></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><select id="uomValue" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select UOM--</option>
                                                            <?php 
                                                            foreach($result_uom as $row){ ?>
                                                                <option value="<?php echo $row['uom'] ; ?>"><?php echo $row['uom'] ; ?></option>

                                                            <?php } ?>
                                                    </select></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><button type="submit" id="submitWork" class="btn btn-success" name="submit">
                                                     Add Work
                                                    </button></td>
                                            </tr>
                                    </tbody>
                                </table>
                                    
                                        <!-- <div class='col-sm-1'>
                                            <button type="submit" id="submitTrain" class="btn btn-success" name="submit">
                                                 Submit
                                            </button>
                                        </div> -->
                                        <div class="col-sm-2"></div>
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