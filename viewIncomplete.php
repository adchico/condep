<?php

setlocale(LC_MONETARY, 'en_PH');
require "convert_no_to_words.php";
include_once 'header.php';
include_once 'logstat.php';

require 'paginator.php';
//require 'database.php';

if ( !empty($_GET['textBL'])) {
    $textBL = $_REQUEST['textBL'];
}

if ( !empty($_POST)) {
    // keep track post values
    $textBL = $_POST['textBL'];
 }


if(isset($_POST['textBL'])){
$textBL = $_POST['textBL'];

}
if(isset($_SESSION['textBL'])) {
$textBL = $_SESSION['textBL'];
}

               ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="dist/number-divider.min.js"></script>
     <script src="printbutton.js"></script>
     <script src="js/numtowords.js"></script>

<link   href="css/bootstrap.min.css" rel="stylesheet">
     <script src="js/bootstrap.min.js"></script>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

     <style>
     .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
      background-color: #aeb6bf;
     }
     #trbg{
     background-color:  #212f3d;
     color:white;
     }
     </style>
     <style type="text/css">

      #maintable td.red {color: #DC143C ;}
      #maintable td.green {color:#ADFF2F;}

     </style>



</head>

<body>


    <div class="container-fluid">

<br />
            <div class="container alighn-left"><br>
                <h3><font size=20><b>Incomplete Container Deposits Docs</b></font></h3>
            </div>

            <div class="row">


<?php
              $pdo = Database::connect();
              $sqltotal = "SELECT SUM(tbl_deposit.DepAmount) FROM `tbl_deposit` RIGHT JOIN tbl_contreq ON tbl_deposit.`id_Deposit` = tbl_contreq.`id_Deposit` LEFT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo` WHERE tbl_deposit.`DepStatus` = \"INCOMPLETE\"";
              $sthtotal = $pdo->prepare($sqltotal);
              $sthtotal->execute();
              $totalincdep = (int) $sthtotal->fetchColumn();
              echo '<div style="margin:20px" align=right><font color=#e74c3c  size=15><b>-'. money_format('%i', ' '.$totalincdep)  .'</b> </font></div>';
?>
<form id="form-transparent" class="form-search" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            <!--        <form method="post" action="ViewAlldepositJoin.php" >  -->
              <div class="container-fluid">
            <table style="width:100%">
              <thead>
          <tr>
                <th>
                          <?
                            if(isset($_SESSION['textBL'])) {
                            $textBL = $_SESSION['textBL'];
                          }else{
                            $textBL = $_POST['textBL'];
                          }

                            ?>
                              <!--
                              <input type="hidden" name="textBL" value="<?php echo $textBL; ?>"><BR/>
                              <div class="container pull-right">
                                    <input type="text" name="query" class="input-medium search-query" value="<?php // echo isset($_GET['query'])?$_GET['query']:'';?>" placeholder="input search 1">
                                    <input type="text" name="query2" class="input-medium search-query" value="<?php // echo isset($_GET['query2'])?$_GET['query2']:'';?>" placeholder="input search 2">
                                    <input type="text" name="query3" class="input-medium search-query" value="<?php // echo isset($_GET['query3'])?$_GET['query3']:'';?>" placeholder="input search 3">
                                    <input type="text" name="query4" class="input-medium search-query" value="<?php // echo isset($_GET['query4'])?$_GET['query4']:'';?>" placeholder="input search 4">
                                <button type="submit" class="btn btn-info">Search</button>

-->

                                </form>
                              </th>
                            </tr>



    <?php include "buttons.php"; ?>
          </thead>
</table>
<br>


                <table class="table table-striped table-bordered table-hover" style="text-align:center;" style="width:100%">
                  <thead>
                    <tr id="trbg" >
                      <th>id</th>
                      <th>Consignee</th>
                      <th>ShippingLine</th>
                      <th>Forwarder</th>
                      <th>BLNo</th>
                      <th>ContainerNo</th>
                      <th>DepAmount</th>
                      <th>DateOfDeposit</th>
                      <th >EncodedDate</th>
                      <th>OR</th>
                      <th>FCL</th>
                      <th>EMT</th>
                      <th>MBL</th>
                      <th>GUA</th>
                      <th>Trucking</th>
                      <th>PlateNo</th>
                      <th>Driver</th>
                      <th style="display:none;"> idBLNo</th>

                      <th><center>Update</center></th>


                    </tr>
                  </thead>
                  <tbody align=left>

              <?php





               $paginator = new Paginator();
               //$sqlDep = "SELECT count(*)FROM `tbl_deposit` RIGHT JOIN tbl_contreq ON tbl_deposit.`id_BLNo` = tbl_contreq.`id_BLNo`";
          //     $sqlDep = "SELECT count(*) FROM `tbl_deposit` RIGHT JOIN tbl_contreq ON tbl_deposit.`id_Deposit` = tbl_contreq.`id_Deposit` LEFT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo` WHERE tbl_deposit.`DepStatus` = \"INCOMPLETE\" ORDER BY tbl_deposit.`DateOfDeposit`";
               $sqlDep = "SELECT count(*) FROM `tbl_deposit` RIGHT JOIN tbl_contreq ON tbl_deposit.`id_Deposit` = tbl_contreq.`id_Deposit` LEFT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo` WHERE tbl_deposit.`DepStatus` = \"INCOMPLETE\"";

               $paginator->paginate($pdo->query($sqlDep)->fetchColumn());

               $sqlDep = "SELECT * FROM `tbl_deposit` RIGHT JOIN tbl_contreq ON tbl_deposit.`id_Deposit` = tbl_contreq.`id_Deposit` LEFT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo` WHERE tbl_deposit.`DepStatus` = \"INCOMPLETE\"";
/*
               $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
               $query2 = isset($_GET['query2'])?('%'.$_GET['query2'].'%'):'%';
               $query3 = isset($_GET['query3'])?('%'.$_GET['query3'].'%'):'%';
               $query4 = isset($_GET['query4'])?('%'.$_GET['query4'].'%'):'%';

               $sqlDep .= "WHERE (`id_Deposit` LIKE :query
                OR Consignee LIKE :query
                OR ShippingLine LIKE :query
                OR Forwarder LIKE :query
                OR DepBLNo LIKE :query
                OR ContainerNo LIKE :query
                OR DepAmount LIKE :query
                OR DateOfDeposit LIKE :query
                OR EncodedDateDeposit LIKE :query
                OR cr_or LIKE :query
                OR cr_fcl LIKE :query
                OR cr_empty LIKE :query
                OR cr_masterbl LIKE :query
                OR cr_contgua LIKE :query
                OR cr_trucking LIKE :query
                OR cr_plateno LIKE :query
                OR cr_driver LIKE :query)

                AND (`id_Deposit` LIKE :query2
                OR Consignee LIKE :query2
                OR ShippingLine LIKE :query2
                OR Forwarder LIKE :query2
                OR DepBLNo LIKE :query2
                OR ContainerNo LIKE :query2
                OR DepAmount LIKE :query2
                OR DateOfDeposit LIKE :query2
                OR EncodedDateDeposit LIKE :query2
                OR cr_or LIKE :query2
                OR cr_fcl LIKE :query2
                OR cr_empty LIKE :query2
                OR cr_masterbl LIKE :query2
                OR cr_contgua LIKE :query2
                OR cr_trucking LIKE :query2
                OR cr_plateno LIKE :query2
                OR cr_driver LIKE :query2)

                 AND (`id_Deposit` LIKE :query3
                 OR Consignee LIKE :query3
                 OR ShippingLine LIKE :query3
                 OR Forwarder LIKE :query3
                 OR DepBLNo LIKE :query3
                 OR ContainerNo LIKE :query3
                 OR DepAmount LIKE :query3
                 OR DateOfDeposit LIKE :query3
                 OR EncodedDateDeposit LIKE :query3
                 OR cr_or LIKE :query3
                 OR cr_fcl LIKE :query3
                 OR cr_empty LIKE :query3
                 OR cr_masterbl LIKE :query3
                 OR cr_contgua LIKE :query3
                 OR cr_trucking LIKE :query3
                 OR cr_plateno LIKE :query3
                 OR cr_driver LIKE :query3)

                  AND (`id_Deposit` LIKE :query4
                  OR Consignee LIKE :query4
                  OR ShippingLine LIKE :query4
                  OR Forwarder LIKE :query4
                  OR DepBLNo LIKE :query4
                  OR ContainerNo LIKE :query4
                  OR DepAmount LIKE :query4
                  OR DateOfDeposit LIKE :query4
                  OR EncodedDateDeposit LIKE :query4
                  OR cr_or LIKE :query4
                  OR cr_fcl LIKE :query4
                  OR cr_empty LIKE :query4
                  OR cr_masterbl LIKE :query4
                  OR cr_contgua LIKE :query4
                  OR cr_trucking LIKE :query4
                  OR cr_plateno LIKE :query4
                  OR cr_driver LIKE :query4) ";
*/
                $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                $length = ($paginator->itemsPerPage);
                $sqlDep .= "ORDER BY tbl_deposit.`DateOfDeposit` ASC limit :start, :length";

                $sth = $pdo->prepare($sqlDep);
                $sth->bindParam(':start',$start,PDO::PARAM_INT);

                $sth->bindParam(':length',$length,PDO::PARAM_INT);
/*
                $sth->bindParam(':query',$query,PDO::PARAM_STR);
                $sth->bindParam(':query2',$query2,PDO::PARAM_STR);
                $sth->bindParam(':query3',$query3,PDO::PARAM_STR);
                $sth->bindParam(':query4',$query4,PDO::PARAM_STR);
*/
                $sth->execute();

                foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

		            echo '<tr>';
                echo '<td width="80px">'. $row['id_Deposit'] . '</td>';
                echo '<td width="120px" >'. $row['Consignee'] . '</td>';
                echo '<td width="100px" >'. $row['ShippingLine'] . '</td>';
                echo '<td width="100px">'. $row['Forwarder'] . '</td>';
		            echo '<td width="100px">'. $row['DepBLNo'] . '</td>';
                echo '<td width="130px">'. $row['ContainerNo'] . '</td>';
                echo '<td width="100px"><center>'. money_format('%i', ' '.$row['DepAmount']) . '</center></td>';
                echo '<td width="100px" style="background-color:#FFC300"><center>'. $row['DateOfDeposit'] . '</center></td>';
                echo '<td width="100px"><center>'. $row['EncodedDateDeposit'] . '</center></td>';




                echo '<td width="50px">'. $row['cr_or'] . '</td>';

                echo '<td width="50px">'. $row['cr_fcl'] . '</td>';
                echo '<td width="50px">'. $row['cr_empty'] . '</td>';
                echo '<td width="50px">'. $row['cr_masterbl'] . '</td>';
                echo '<td width="50px">'. $row['cr_contgua'] . '</td>';


                echo '<td>'. $row['cr_trucking'] . '</td>';
                echo '<td width="80px">'. $row['cr_plateno'] . '</td>';
                echo '<td width="180px">'. $row['cr_driver'] . '</td>';
                echo '<td style=display:none;>'. $row['id_BLNo'] . '</td>';

                echo '<td width="80px" align="center"><center><a class="btn btn-primary" href="ViewDeposit.php?id_BLNo='. $row['id_BLNo'].'&textBL='.$row['DepBLNo'].'">Update</a> </center></td>';
                echo '<tr>';





/*

                                      echo '<td><center>';
                                        echo '<a id="print" class="btn btn-success btn-small" href="reports/' . $printpage . '?id_Deposit='.$row['id_Deposit'].'&DepBLNo='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&$Forwarder='.$row['Forwarder'].'">Receiving</a>';
                                      echo '</center></td>';

                                        echo '<td><center>';
                                          echo '<a id="print" class="btn btn-warning btn-small" href="reports/OneOverpaymentrpt.php?id_Deposit='.$row['id_Deposit'].'&DepBLNo='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&$Forwarder='.$row['Forwarder'].'">Overpayment</a>';
                                        echo '</center></td>';

                                          echo '<td><center>';

                                        if($ShippingLine=="ONE" OR $ShippingLine=="YANG MING" OR $ShippingLine=="APL"){
                                          echo '<a align="right" class="btn btn-primary btn-small" href="reports/1_ControlFormrpt.php?CtrlFormNo=' . $CtrlFormNo .'">Summary</a>';
                                        }else{
                                         echo '<a align="right" class="btn btn-primary btn-small" href="reports/A_ControlFormrpt.php?CtrlFormNo=' . $CtrlFormNo .'">Summary</a>';
                                       }
                                      //  echo '<a class="btn btn-danger btn-sm" href="delete_deposit.php?id_Deposit='.$row['id_Deposit'].'&textBL='.$row['DepBLNo'].'">Delete</a>';
                                        echo '</center></td>';
                                        echo '<td><center>';

                                         echo '<a align="right" class="btn btn-warning btn-small" href="reports/A_CheqSummaryrpt.php?CtrlFormNo=' . $CtrlFormNo .'&CheqNo='.$row['CheqNo'].'">CheqSum</a>';
                                      //  echo '<a class="btn btn-danger btn-sm" href="delete_deposit.php?id_Deposit='.$row['id_Deposit'].'&textBL='.$row['DepBLNo'].'">Delete</a>';
                                        echo '</center></td>';
                                        echo '<td><center>';
                                        echo '<a class="btn btn-info btn-small pull-center" href="update_deposit.php?id_Deposit='.$row['id_Deposit'].'&textBL='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&$Forwarder='.$row['Forwarder'].'">Update</a>';
                                        echo '</center></td>';

                          */

                   }




                   Database::disconnect();

                  ?>












                  </tbody>

            </table>
            <?php
            echo $paginator->pageNav();
            ?>
        </div>
    </div>




  </body>
</html>
