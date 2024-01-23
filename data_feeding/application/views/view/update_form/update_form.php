<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Update Form Schema
                    <small></small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Update Form Schema
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  action="#" method="post">


                                    <div class="row clearfix">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-success" name="submit">
                                                 Update
                                            </button>
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class='form-group form-float'>
                                                <div class='form-line'>
                                                    <input type='text' class='form-control' name='form_title' required minlength='1' maxlength='500' value="<?php echo $data->step1->title; ?>" >
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

                                    <?php  foreach($data->step1->fields as $field){ ?>
                                         <div class="row clearfix elements_row">
                                            <hr style="clear:both;">
                                            <div class='col-sm-1'>
                                                <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete_row">
                                                    <?php list($form_id,$key) = explode("_", $field->key); echo $key; ?> 
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </div>
                                            <div class='col-sm-2'>
                                                <div class='form-group form-float'>
                                                    <div class='form-line'>
                                                        <select class="form-control input_type show-tick" name="input_type[<?php echo $key; ?>]" data-size="5" required >
                                                        <option value="">--Select Input Type--</option>
                                                        <option value="edit_text" <?php if($field->type=='edit_text'){ echo "selected";} ?> >Text</option>
                                                        <option value="spinner" <?php if($field->type=='spinner'){ echo "selected";} ?> >Select</option>
                                                        <option value="check_box" <?php if($field->type=='check_box'){ echo "selected";} ?> >Checkbox</option>
                                                        <option value="radio" <?php if($field->type=='radio'){ echo "selected";} ?> >Radio</option>
                                                        <option value="date_picker" <?php if($field->type=='date_picker'){ echo "selected";} ?> >Date</option>
                                                        <option value="label" <?php if($field->type=='label'){ echo "selected";} ?> >Label</option>
                                                        <option value="choose_image" <?php if($field->type=='choose_image'){ echo "selected";} ?> >Choose Image</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dynamic">
                                                <?php 
                                                    switch ($field->type) {
                                                        case 'edit_text':
                                                            echo edit_text( $key,
                                                                            $field->hint,
                                                                            $field->v_min_length->value,
                                                                            $field->v_max_length->value,
                                                                            isset($field->v_required)?true:false
                                                                           );
                                                            break;
                                                        
                                                        case 'spinner':
                                                            $values = implode(',', $field->values);
                                                            echo spinner( $key,
                                                                          $field->hint,
                                                                          $values,
                                                                          isset($field->v_required)?true:false
                                                                        );
                                                            break;

                                                        case 'check_box':
                                                            $options = array();
                                                            foreach($field->options as $val){
                                                                $options[] = $val->key;
                                                            }
                                                            $options = implode(',', $options);
                                                            echo check_box( $key,
                                                                            $field->label,
                                                                            $options,
                                                                            isset($field->v_required)?true:false
                                                                          );
                                                            break;

                                                        case 'radio':
                                                            $options = array();
                                                            foreach($field->options as $val){
                                                                $options[] = $val->key;
                                                            }
                                                            $options = implode(',', $options);
                                                            echo radio( $key,
                                                                        $field->label,
                                                                        $options,
                                                                        isset($field->v_required)?true:false
                                                                      );
                                                            break;

                                                        case 'choose_image':
                                                            echo choose_image( $key,
                                                                            $field->uploadButtonText,
                                                                            isset($field->v_required)?true:false
                                                                           );
                                                            break;

                                                        case 'date_picker':
                                                            echo date_picker( $key,
                                                                            $field->hint,
                                                                            isset($field->v_required)?true:false
                                                                           );
                                                            break;

                                                        case 'label':
                                                            echo label( $key,
                                                                            $field->text
                                                                           );
                                                            break;

                                                        default:
                                                            # code...
                                                            break;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>




                                </form>
                                <input type="hidden" id="ivalue" value="<?php echo isset($key)?$key:0; ?>">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

        </div>
    </section>