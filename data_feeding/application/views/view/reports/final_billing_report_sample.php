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
    .table-no-borders th,
        .table-no-borders td {
            border: none;
            padding: 8px;
            text-align: center;
        }
    .table-with-borders {
            width: 100%;
            border-collapse: collapse;
        }

        .table-with-borders th,
        .table-with-borders td {
            border: 1px solid;
            padding: 8px;
            text-align: center;
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
        @media print {
            @page {
                size: landscape; /* Set the page size to portrait mode */
                margin: 1cm; /* Set margins as needed */
            }
            #printButton{
              display: none;
            }
            thead {
                display: table-header-group;
            }
        }        
  </style>
</head>
<body>
<div class="card">
  <table class="table-with-borders">
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
        <th colspan="6" style="text-align: right;">Maintenance JEE/SSE - <?php echo $user_name ;?></th>
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
                                <td><?php echo isset($row[$key]) ? $row[$key] : '_'; ?>
                    <?php }?>
                </tr>
            <?php } ?>
        <?php }?>
    <?php }?>
<?php }?>
<tr style="font-weight:bold;">
            <td colspan="5">Total Rating</td>
            <td><?php echo $total_max_rating; ?></td>
            <td><?php echo $totalRatingGot; ?></td>
            <td><?php echo $totalRatingPercent."%"; ?></td>
            <td><?php echo $totalAmount; ?></td>
            <td><?php echo $toal_penalty_amt; ?></td>
            <td><?php echo $toalRatingAMount ; ?></td>
</tr>
  </tbody>
</table>
<br>
<br>

<table class="table-no-borders" style="width: 100%;">
    <tr>
        <th colspan="5" style="text-align: center;">Railway JEE/C&W ND Name</th>
        <th colspan="5" style="text-align: center;">Contractor Supervisor Name</th>
    </tr>
    <tr style="font-weight: bold;">
        <td colspan="5" style="text-align: center;"><?php echo $user_name ; ?></td>
        <td colspan="5" style="text-align: center;"><?php echo $contractor_name ; ?></td>
    </tr>
</table>
<div style="align-content:center;">
<button id="printButton" onclick="printDocument()" style="align-content:center;">Print</button>
</div>
</div>



<script>
    function printDocument() {
        window.print();
    }
</script>
</body>
</html>
