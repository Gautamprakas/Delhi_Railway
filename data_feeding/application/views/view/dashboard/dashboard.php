<?php
/*$output = firebase('eOYudE-qaWo:APA91bGhkmWcJFAVasEDbmiP5xF9IYmvaHc_TcE75r4Uxs-xDRUE9DAwan2gs8KSgaY4X_f9pTAoWI-rS8t5Zp5X_mD2uciS-jtEhM6HIRtigYlrBZv497bpdGUyJl1207q4AmMFRG7-',"Test","Hello Upendra");

print_r($output);*/
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>


         

            <!-- Widgets -->
            <div class="row clearfix">
                <a href="<?php echo base_url("Incidence/incidenceDetails/pending");?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">notifications_active</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW INCIDENCE</div>
                            <div class="number" id="newIncidence"></div>
                        </div>
                    </div>
                </div>
                </a>
                <a href="<?php echo base_url("Incidence/incidenceDetails/").urlencode("under process");?>">
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">warning</i>
                        </div>
                        <div class="content">
                            <div class="text">UNDER PROCESS</div>
                            <div class="number" id="underProcess"></div>
                        </div>
                    </div>
                </div>
                </a>
                <a href="<?php echo base_url("Incidence/incidenceDetails/complete");?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">done_all</i>
                        </div>
                        <div class="content">
                            <div class="text">COMPLETED</div>
                            <div class="number"  id="complete"></div>
                        </div>
                    </div>
                </div>
                </a>
               <a href="<?php echo base_url("Incidence/incidenceDetails");?>">
               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">notifications</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL INCIDENCE</div>
                            <div class="number" id="totalIncidence"></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!-- #END# Widgets -->
       
            
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>Your Action Pending</h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive" style="overflow-y: scroll;height: 250px">
                                <table class="table table-hover dashboard-task-infos" id="dashtable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>INCIDENCE ID</th>
                                            <th>INCIDENCE TYPE</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                

                      <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                    	 <div class="header">
                            <h2>Last Three Day Incidence</h2>
                            
                        </div>
                        <div class="body bg-blue">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                
                            </div>
                            <ul class="dashboard-stat-list">
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                
            </div>

            <div class="row clearfix">

                      <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>Incidence</h2>
                            
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->

                <!-- Line Chart -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Week Wise Incidence Report</h2>
                            
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="130"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
            </div>


        </div>
    </section>
