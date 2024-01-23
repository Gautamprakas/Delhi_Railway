<?php
    $type = $this->session->userdata("type");
    if( $type == 'admin'){
      $res = $this->db->order_by("order","ASC")->get("form_created");
    }else if( $type == 'dept'){
      $dept = $this->session->userdata("dept");
      $res = $this->db->where("dept",$dept)->order_by("order","ASC")->get("form_created");
    }else if( $type == 'siteincharge'){
      $res = $this->db->order_by("order","ASC")->get("form_created");
    }else if( $type == 'block'){
      $res = $this->db->order_by("order","ASC")->get("form_created");
    }
?>
<!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                     <!-- <li class="<?php //if(strcasecmp($menuActive, 'home') == 0) echo 'active'; ?>">
                        <a href="<?php //echo base_url('Admin/dashboard'); ?>" onclick="//return false;">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                                         </li> -->

                  <!--  <li class="<?php /*if(strcasecmp($menuActive, 'screening') == 0) echo 'active'; ?>">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">person_add</i>
                           <span>Screened</span>
                       </a>
                       <ul class="ml-menu">
                               <li class="<?php //if(strcasecmp($subMenuActive, 'view_data') == 0) echo 'active'; ?>">
                                   <a href="<?php //echo base_url('view/Screening/view_data');*/ ?>">View Data</a>
                               </li>
                        </ul>
                   </li> -->

                    <?php if( $type=="admin" ){ ?>
                    <li class="<?php if(strcasecmp($menuActive, 'create_form') == 0) echo 'active'; ?>">
                        <a href="<?php echo base_url('view/CreateForm/index'); ?>">
                            <i class="material-icons">create</i>
                            <span>Create Form Schema</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if( $type=="admin" ){ ?>
                    <li class="<?php if(strcasecmp($menuActive, 'update_form') == 0) echo 'active'; ?>">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">edit</i>
                           <span>Update Form Schema</span>
                       </a>
                       <ul class="ml-menu">
                            <?php foreach($res->result() as $row){ ?>
                               <li class="<?php if(strcasecmp($subMenuActive, 'update_form'.$row->form_id) == 0) echo 'active'; ?>">
                                   <a href="<?php echo base_url('view/CreateForm/updateForm/'.$row->form_id); ?>"><?php echo $row->form_title; ?></a>
                               </li>
                            <?php } ?>   
                        </ul>
                   </li>
                   <?php } ?>

                   <?php if( $type=="dept" || $type=="admin" || $type=="block" ){ ?>
                    <li class="<?php if(strcasecmp($menuActive, 'view_form') == 0) echo 'active'; ?>">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">book</i>
                           <span>View Form Data</span>
                       </a>
                       <ul class="ml-menu">
                            <?php foreach($res->result() as $row){ if($type=="block"&&$row->form_id!=SELECT_ITEMS_FOR_WORK){ continue; } ?>
                               <li class="<?php if(strcasecmp($subMenuActive, 'view_form'.$row->form_id) == 0) echo 'active'; ?>">
                                   <a href="<?php echo base_url('view/CreateForm/viewFormData/'.$row->form_id); ?>"><?php echo $row->form_title; ?></a>
                               </li>
                            <?php } ?>   
                        </ul>
                   </li>
                   <?php } ?>


                   <?php if( $type=="block" || $type=="admin" ){ ?>
                    <li class="<?php if(strcasecmp($menuActive, 'view_update_form') == 0) echo 'active'; ?>">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">book</i>
                           <span>View Update Form Data</span>
                       </a>
                       <ul class="ml-menu">
                            <?php foreach($res->result() as $row){ if($type=="block"&&$row->form_id!=SELECT_ITEMS_FOR_WORK){ continue; } ?>
                               <li class="<?php if(strcasecmp($subMenuActive, 'view_update_form'.$row->form_id) == 0) echo 'active'; ?>">
                                   <a href="<?php echo base_url('view/CreateForm/viewUpdateFormData/'.$row->form_id); ?>"><?php echo $row->form_title; ?></a>
                               </li>
                            <?php } ?>   
                        </ul>
                   </li>
                    <?php } ?>


                     <?php if( $type=="siteincharge" ){ ?>
                    <li class="<?php if(strcasecmp($menuActive, 'view_rejected_form') == 0) echo 'active'; ?>">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">book</i>
                           <span>View Rejected Form Data</span>
                       </a>
                       <ul class="ml-menu">
                            <?php foreach($res->result() as $row){ if($row->form_id==USER_WORK_DONE_ACTION){ continue; } ?>
                               <li class="<?php if(strcasecmp($subMenuActive, 'view_rejected_form'.$row->form_id) == 0) echo 'active'; ?>">
                                   <a href="<?php echo base_url('view/CreateForm/viewRejectedFormData/'.$row->form_id); ?>"><?php echo $row->form_title; ?></a>
                               </li>
                            <?php } ?>   
                        </ul>
                   </li>
                   <?php } ?>

                    <!-- <li class="<?php //if(strcasecmp($menuActive, 'feedback') == 0) echo 'active'; ?>">
                        <a href="<?php //echo base_url('view/CreateForm/feedback'); ?>">
                            <i class="material-icons">create</i>
                            <span>Feed Data</span>
                        </a>
                    </li> -->

                    


                    <!-- <li class="<?php /*if(strcasecmp($menuActive, 'changepassword') == 0) echo 'active'; ?>">
                        <a href="<?php //echo base_url('view/Employee/changePasswordView');*/ ?>">
                            <i class="material-icons">mode_edit</i>
                            <span>Change Password</span>
                        </a>
                    </li> -->
                    <?php if( $type=="admin" || $type=="sbsadmin" || $type=="seniorssc" ){ ?>
                    <li class="<?php if(strcasecmp($menuActive, 'assign_work') == 0) echo 'active'; ?>">
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">edit</i>
                           <span>Assign Work</span>
                       </a>
                       <ul class="ml-menu">
                               <?php if( $type=="admin" || $type=="sbsadmin" ){ ?>
                               <li class="<?php if(strcasecmp($subMenuActive, 'assign_work_sbs_supervisor') == 0) echo 'active'; ?>">
                                   <a href="<?php echo base_url('view/CreateForm/assignWork/sbs_supervisor'); ?>">SBS Supervisor</a>
                               </li>
                               <?php } ?>
                               <?php if( $type=="admin" || $type=="seniorssc" ){ ?>
                               <li class="<?php if(strcasecmp($subMenuActive, 'assign_work_ssc') == 0) echo 'active'; ?>">
                                   <a href="<?php echo base_url('view/CreateForm/assignWork/ssc'); ?>">SSC</a>
                               </li>
                               <?php } ?>
                        </ul>
                   </li>
                   <?php } ?>

                    
                    <li class="<?php if(strcasecmp($menuActive, 'logout') == 0) echo 'active'; ?>">
                        <a href="<?php echo base_url('view/Login/logout'); ?>">
                            <i class="material-icons">power_settings_new</i>
                            <span>Logout</span>
                        </a>
                    </li>
                   
                    
                </ul>
            </div> 
            <!-- #Menu -->