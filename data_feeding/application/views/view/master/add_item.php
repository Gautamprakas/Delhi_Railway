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
                                                <th class="font-12" style="background: #2196f3;">SI.No.</th>
                                                <th class="font-12" style="background: #2196f3;">Item Name</th>
                                                
                                                <th class="font-12" style="background: #2196f3;">Unit Of Measurement</th>
                                                <th class="font-12" style="background: #2196f3;">Action</th>
                                               
                                            </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <tr data-class='<?php echo $row["class"]; ?>' class='<?php echo $row["class"]; ?> all'>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/">1</td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><input type='text' class='form-control' name='form_title'id="itemName" required minlength='1' maxlength='500' value="" ></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><select id="uom_value" class="form-control input_type show-tick" name="" data-size="5" required >
                                                            <option value="">--Select UOM--</option>
                                                            <?php 
                                                            foreach($result as $row){ ?>
                                                                <option value="<?php echo $row['uom'] ; ?>"><?php echo $row['uom'] ; ?></option>

                                                            <?php } ?>
                                                    </select></td>
                                                    <td class="font-12" style="/*background: #e3f2fd;*/"><button type="submit" id="submitItem" class="btn btn-success" name="submit">
                                                     Add Item
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