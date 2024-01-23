<?php //print_r($data); ?>
<html>
<title><?php echo $data['child_info']->child_id; ?> Screening Report</title>
<head>
<?php $this->load->view('css/invoice'); ?>
</head>
    <body>
       
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <!-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> -->
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="#">
                            <img src="http://vdsai.com:81/vdsai/images/logo_vdai.webp" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="http://vdsai.com">
                            VDAI Biosec Pvt Ltd
                            </a>
                        </h2>
                        <div>117/H-2/136, Pandu Naga, Kanpur, Uttar Pradesh, India</div>
                        <div></div>
                        <div>vdaibiosec@gmail.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">CHILD INFO :</div>
                        <h2 class="to"><?php echo $data['child_info']->child_name; ?></h2>
                        <div class="address">
                            <h4>
                                <span class="badge badge-info">
                                    Age <?php echo $data['child_info']->child_age_in_months; ?> Months
                                </span>
                                <span class="badge badge-info">
                                    Gender <?php echo $data['child_info']->gender; ?>
                                </span>
                            </h4>
                        </div>
                        <div class="email">
                            <h4>
                                <span class="badge badge-info">
                                    Weight <?php echo $data['child_info']->weight_in_kg; ?> Kg
                                </span>
                                <span class="badge badge-info">
                                    Height <?php echo $data['child_info']->height_in_cm; ?> Cm
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="col invoice-details">
                        <h5 class="invoice-id"><?php echo $data['child_info']->child_id; ?></h5>
                        <div class="date">
                            Date of Screening: <?php echo date("d/m/Y",strtotime($data['child_info']->record_datetime)); ?>
                        </div>
                        <div class="date">
                            <!-- Date of Screening: <?php //echo date("d/m/Y",strtotime($data['quiz'][0]->record_datetime)); ?> -->
                        </div>
                        
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left" colspan="3">QUESTIONS</th>
                            <th class="text-right">RISK PERCENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; 
                        $TotalQues = 0;
                        $ChildScore = 0;
                        $Disease = [];
                        foreach($data['quiz'] as $ques): ?>
                                <tr>
                                    <td class="no"><?php echo ++$i; ?></td>
                                    <td class="text-left" colspan="3"><h3>
                                        <!-- <a target="_blank" href=""> -->
                                        <?php echo $ques->ques_eng; ?>
                                        <!-- </a> -->
                                        </h3>
                                       <a target="_blank" href="">
                                           <!-- Useful videos -->
                                       </a> 
                                       <!-- to improve your Javascript skills. Subscribe and stay tuned :) -->
                                    </td>
                                    <!-- <td class="unit">
                                        <?php  /*$Score = 0; if($ques->ans == $ques->refer_if): $Score = 1; ?>
                                        <i class="fa fa-check" aria-hidden="true" style="color:red"></i>
                                        <?php $Disease[$ques->disease] = $ques->disease; endif; ?>
                                    </td>
                                    <td class="qty">
                                        <?php if($ques->ans != $ques->refer_if): ?>
                                        <i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                        <?php endif;*/ ?>
                                    </td> -->
                                    <td class="total">
                                        <?php echo $ques->ans; ?>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                       
                    </tbody>
                    <tfoot>
                        <!-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TOTAL QUESTIONS</td>
                            <td><?php //echo $TotalQues; ?></td>
                        </tr> -->
                        <!-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">CHILD SCORE</td>
                            <td><?php //echo 100 ?></td>
                        </tr> -->
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TOTAL RISK PERCENT</td>
                            <td><?php echo $data["TotalRisk"] ?></td>
                        </tr>
                    </tfoot>
                </table>
                <!-- <div class="thanks">Thank you!</div> -->
                <div class="notices">
                    <div>DIAGNOSIS:</div>
                    <div class="notice">
                        <h5>
                            <?php foreach($data["Disease"] as $value): ?>
                                <span class="badge badge-danger">
                                     <?php echo sprintf("%s (%s%%)",$value["disease"],$value["prob"]); ?>
                                </span>
                            <?php endforeach; ?>
                        </h5>
                    </div>
                </div>
            </main>
            <footer>
                <!-- Invoice was created on a computer and is valid without the signature and seal. -->
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
    </body>
<?php $this->load->view('js/invoice'); ?>
</html>