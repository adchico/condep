<?php
include_once 'header.php';
include_once 'logstat.php';
// set




  //  require 'database.php';
    $id_cheq = null;
    if ( !empty($_GET['id_cheq'])) {
        $id_cheq = $_REQUEST['id_cheq'];
    }

    if ( null==$id_cheq ) {
    //    header("Location: view_cheq.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_cheq where id_cheq = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_cheq));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="dist/number-divider.min.js"></script>
    <style>
        { margin: 0; padding: 0; }



        #form-transparent
        {
        background-color: transparent;
        }



    </style>
</head>

<body>

<div class="container">
  <div class="span12 offset1">
    <div class="row">
      <br/>
        <h3 align='center'>View Check Details</h3>
        <br/>
    </div>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
    <th>BANK</th>          <td>  <?php echo $data['BankInfo'];?></td>
    <th>SHIPPING LINE</th>     <td><?php echo $data['ShippingLine']; ?></td>
    <th>CONSIGNEE</th>        <td><?php echo $data['Consignee']; ?></td>
    </tr>

    <tr>
    <th>CHECK NO.</th>          <td><?php echo $data['cheqno']; $cheqno = $data['cheqno']; ?></td>
    <th>CHECK AMOUNT</th>     <td class="number">  <?php echo $data['cheqamount'];?></td>
    <th>CHECK DATE</th>        <td><?php echo $data['cheqdate'];?></td>
    </tr>

    <tr>
    <th>CHECK ID</th>          <td><?php echo $data['id_cheq']; ?></td>
    <th>ENCODED BY</th>     <td class="number">  <?php echo $data['Encodedby'];?></td>
    <th>ENCODED DATE</th>        <td><?php echo $data['EncodedDate'];?></td>
    </tr>
</thead>
</table>



              <div class="form-actions" id="form-transparent">
              <form  method="post" action="view_cheq.php">
                  <a class="btn" href="viewbl.php">Home</a>
		        <button type="submit" class="btn btn-success">Back</button>
            <a href="reports/A_CheqRefundrpt.php?cheqNo='<?php echo $data['cheqno']; ?>'&Consignee='<?php echo $data['Consignee']; ?>'"  class="btn btn-primary pull-right">Print Cheq</a>

          </div>


<!- This will Start the Summary of the Cheq details ->
<center>

<?php if (!empty($data['image'])): ?>
<img src="<?php echo $data['image']; ?>" class="img-rounded" heigh = "400px" width = "800px"/>
<?php endif; ?>
</center>
<br/>

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>

                      <th>Cheq No</th>
                        <th>BL No</th>
                      <th bgcolor="Khaki">ContainerNo</th>
                      <th>ReceiptNo</th>
                      <th>DepAmount</th>
                      <th>Deduction</th>
                      <th>Ded. Decr.</th>

          <!--            <th>CheqNo</th>
                      <th>CtrlFormNo</th> -->




                  </thead>
                  <tbody align=left>

              <?php
               require 'paginator.php';
               $pdo = Database::connect();
            //   $sqlDep = "SELECT * FROM `tbl_deposit` FULL OUTER JOIN tbl_cheq ON tbl_deposit.`cheqno` = tbl_cheq.`cheqno` WHERE tbl_deposit.`cheqno` = ". $cheqno;
               $sqlDep = "SELECT * FROM `tbl_cheq` RIGHT JOIN `tbl_deposit` ON tbl_cheq.`cheqno` = tbl_deposit.`cheqno` WHERE tbl_deposit.`cheqno` = ". $cheqno;
                $sth = $pdo->prepare($sqlDep);
                $sth->execute();

                $SumDepAmount = 0;
                $Sumcheq_deduction = 0;
                $TotalRefund = 0;
                foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

                echo '<tr>';
                echo '<td >'. $row['id_Deposit'] . '</td>';
                echo '<td>'. $row['CheqNo'] . '</td>';

        //        echo '<td >'. $row['Consignee'] . '</td>';
                echo '<td >'. $row['DepBLNo'] . '</td>';
                echo '<td>'. $row['ContainerNo'] . '</td>';
                echo '<td>'. $row['ReceiptNo'] . '</td>';
                echo '<td><div class=\'number pull-right\'> '. $row['DepAmount'] . '</div></td>';
                echo '<td><div class=\'number pull-right\'> '. $row['cheq_deduction']. '</div></td>';
                echo '<td>'. $row['deduction_desc'] . '</td>';
        //        echo '<td  ><div style=\'display: none;\'>'. $row['ShippingLine'] . '</div></td>';

      //          echo '<td>'. $row['CtrlFormNo'] . '</td>';


                $CheqNo=$row['cheqno'];
                $_SESSION['cheqNo']=$CheqNo;
                $SumDepAmount += $row['DepAmount'];
              //  $SumDepAmount = number_format($SumDepAmount,2);
                $Sumcheq_deduction +=$row['cheq_deduction'];
          //      $Sumcheq_deduction = number_format($Sumcheq_deduction,2);
                $TotalRefund = number_format($SumDepAmount - $Sumcheq_deduction,2) ;

                echo '</div>';
                echo '</tr>';
                }
                echo '<tr>';
                echo '<th> </th>';
                echo '<th></th>';
                echo '<th></th>';

                echo '<th> </th>';
                echo '<th></th>';
                echo '<th ><div class=\'number pull-right\'>'. $SumDepAmount . '</div></th>';
                echo '<th ><div class=\'number pull-right\'>'. $Sumcheq_deduction .' </th>';
                echo '<th></th>';
        //        echo '<th>  </th>';

            //    echo '<th> </th>';
                echo '</tr>';

                echo '<tr>';
                echo '<th> </th>';
          //      echo '<th></th>';
                echo '<th></th>';
          //      echo '<th></th>';
                echo '<th> </th>';
                echo '<th></th>';
                echo '<th ><div> TOTAL REFUND </div></th>';

                echo '<th ><div class=\'number pull-right\'>' . $TotalRefund . '</th>';
                echo '<th>  </th>';
                echo '<th ><div class=\'number pull-right\'></th>';
            //    echo '<th> </th>';
                echo '</tr>';
                echo '</tbody>';
                echo '</thead>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '<br/><br/><br/><br/><br/> ';


                ?>





<br/><br/><br/><br/><br/>
  </body>

<!--  <script src="js/number-divider.min.js"></script>
  <script>
  $('.number').divide({
  	  delimiter: ','
  	});

  </script> -->


</html>
<html>
