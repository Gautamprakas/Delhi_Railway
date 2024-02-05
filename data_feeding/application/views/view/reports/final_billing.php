<script>
    document.title = '<?php echo $form_title; ?>';
</script>
<section class="content">
<style>
body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
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
     <tr style="margin-top: 50px;">
                          <td colspan="5" style="text-align:left;">
                            <label for="trainNumber">Train Number:</label>
                          <select  id="selectTrain" required>
                            <option value="">--Select Train Number--</option>
                        <?php
                            foreach ($railway_trains as $row) { ?>
                             
                                <option value="<?php echo $row['train_number']; ?>" data-info="<?php echo $row['username'];?>" required>
                                    <?php echo $row['train_number']; ?>
                                </option>
                            <?php } ?>
                        

                        </select>
                          </td>
                          <td colspan="6" style="text-align: right;">
                            <label for="maintenancePerson">Maintenance SEE/JEE:</label>
                            <span id="nameHere"></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" style="text-align:left;">
                            <label for="date">Date:</label>
                            <input type="date" id="date" data-info="<?php echo $form_id ; ?>" size="30" required style="margin-left:20px ;">
                          </td>
                          <td colspan="6" style="text-align: right;">
                            <label for="maintenanceFrom">Maintenance Slot- From &nbsp;<input type="time" id="time1" name="maintenanceFrom" required></label>
                            <label for="maintenanceTo">&nbsp;to&nbsp;&nbsp;</label>
                            <input type="time" id="time2" name="maintenanceTo" required>
                            
                          </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" id="submitTrain" class="btn btn-success">
                                               Submit
                                            </button>
                            </td>
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
      <tr>
            <td>1</td>
            <td>07934</td>
            <td>A1</td>
            <td>Gallery- PP</td>
            <td>1</td>
            <td>3</td>
            <td>3</td>
            <td>100%</td>
            <td>610</td>
            <td>0</td>
            <td>610</td>
        </tr>
  </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Total Rating</th>
            <td>27</td>
            <td>20</td>
            <td>74%</td>
            <td>5936</td>
            <td>521</td>
            <td>5415</td>
        </tr>
    </tfoot>
</table>
<br>
<br>

<div class="additional-info">
    <p><strong>Railway JEE/C&W ND Name:</strong></p>
    <p><strong>Contractor Supervisor Name:</strong></p>
</div>
<button id="printButton" onclick="printTable()" style="align-content:center;">Print</button>
</div>
</section>
<script>
    function printTable() {
        window.print();
    }
</script>

