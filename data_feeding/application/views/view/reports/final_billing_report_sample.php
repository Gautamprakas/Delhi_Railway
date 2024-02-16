<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing</title>
  <style>
    body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: auto;
            margin: auto;
        }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      align-content: center;
    }
    th, td {
      padding: 8px;
/*      text-align: left;*/
    }
    .additional-info {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    #printButton {
        margin-top: 20px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: auto; /* Center horizontally */
        display: flex; /* Enable flex container */
        align-items: center;
        }
    #printButton.hidden {
            display: none;
        }
  </style>
</head>
<body>
<div class="card">
  <table>
    <thead>
      <tr>
        <th colspan="11">SBS Enterprise</th>
      </tr>
      <tr>
        <th colspan="11">LOA NO. GEMC-511687726582445</th>
      </tr>
      <tr>
        <th colspan="11">Comprehensive Passenger Amenity Work At New Delhi Railway Station for Two Years</th>
      </tr>
      <tr>
        <th colspan="11">Bill Report</th>
      </tr>
      <tr>
        <th colspan="5" style="text-align: left;">Train Number-<?php echo $train_number ;?></th>
        <th colspan="6" style="text-align: right;">Maintenance JEE/SSE - <?php echo $username ;?></th>
      </tr>
      <tr>
        <th colspan="5" style="text-align: left;">Date -<?php echo $date ; ?></th>
        <th colspan="6" style="text-align: right;">Maintenance Slot - From <?php echo $time1 ; ?>AM To <?php echo $time2 ; ?>PM</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Sl. No.</th>
        <th>Coach Number</th>
        <th>Item Code/Activity Code</th>
        <th>Seat block/Area (C)</th>
        <th>Item Qty</th>
        <th>Max Rating</th><th>Gain Rating</th>
        <th>Rating %</th>
        <th>Amt As per Tender</th>
        <th>Panelty Amt.</th>
        <th>Net Pay</th>
      </tr>
<?php if(count($newdata)>0){ $i = 0; ?>
    <?php foreach($newdata as $data){  ?>
        <?php if(count($data) > 0){ ?>
            <?php foreach($data as $req_id => $row){ ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <?php foreach($newKeys as $key){ ?>
                            <?php if($key == "1690365766_5"){ 
                                $workGlobal=$row[$key];
                                $work="work";
                                if(isset($row[$key])){ // Fixed the missing closing parenthesis here
                                    $work = $row[$key];
                                    $workParts = explode("|", $work);
                                    if(count($workParts) > 1){
                                        $work = $workParts[0];
                                        $valueParts = explode("-", $work);
                                        if(count($valueParts) > 1){
                                            $work = $valueParts[1];
                                        }
                                    }
                                }
                            ?>
                            <td><?php echo $work; ?></td>
                            <?php }else if($key=="amount"){
                                    if(isset($workGlobal)){
                                        $amt=explode("@", $workGlobal);
                                        if(count($amt)>1){
                                            $amt_parts=explode("$",$amt[1]);
                                            $amt=$amt_parts[0];
                                        }else{
                                            $amt="N/A";
                                        }
                                    }
                            ?>
                            <td><?php echo $amt; ?></td>
                            <?php } else { ?>
                                <td><?php echo isset($row[$key]) ? $row[$key] : ''; ?></td>
                        <?php } ?>
                    <?php }?>
                </tr>
            <?php } ?>
        <?php }?>
    <?php }?>
<?php }?>
  </tbody>
    <tfoot style="font-weight: bold;">
        <tr>
            <th colspan="5">Total Rating</th>
            <td><?php echo $total_max_rating; ?></td>
            <td><?php echo $totalRatingGot; ?></td>
            <td><?php echo $totalRatingPercent."%"; ?></td>
            <td><?php echo number_format($totalAmount,2); ?></td>
            <td><?php echo $toal_penalty_amt; ?></td>
            <td><?php echo number_format($toalRatingAMount,2) ; ?></td>
        </tr>
    </tfoot>
</table>
<br>
<br>

<div class="additional-info">
    <p><strong>Railway JEE/C&W ND Name:</strong></p>
    <p><strong>Contractor Supervisor Name:</strong></p>
</div>
<div style="align-content:center;">
<button id="printButton" onclick="printTable()" style="align-content:center;">Print</button>
</div>
</div>


<script>
    function printTable() {
        window.print();
    }
</script>
</body>
</html>
