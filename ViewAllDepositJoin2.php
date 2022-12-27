<?php


require "convert_no_to_words.php";
include_once 'header.php';
include_once 'logstat.php';

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


</head>

<body>


    <div class="container-fluid">


            <div class="container alighn-left"><br>
                <h3>Print Container Deposits ( PAGE 2 )</h3>
            </div>

            <div class="row">





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
                              <input type="hidden" name="textBL" value="<?php echo $textBL; ?>"><BR/>
                              <div class="container pull-right">
                                    <input type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>" placeholder="input search 1">
                                    <input type="text" name="query2" class="input-medium search-query" value="<?php echo isset($_GET['query2'])?$_GET['query2']:'';?>" placeholder="input search 2">
                                    <input type="text" name="query3" class="input-medium search-query" value="<?php echo isset($_GET['query3'])?$_GET['query3']:'';?>" placeholder="input search 3">
                                <button type="submit" class="btn btn-info">Search</button>



                                </form>
                              </th>
                            </tr>



                            <tr>
                            <td><a class="btn btn-warning" href="viewbl.php">Home</a> </td>
                              <td width="90"><a type="submit" class="btn" href="printIDs.php">Print ID's</a></td>


                              <td width="170"><a type="submit" class="btn btn-primary" href="ViewAllDepositJoin.php">Back to Printing 1</a></td>



                          </tr>
          </thead>
</table>
<br>


                <table class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                    <tr id="trbg" >
                      <th>id</th>
                      <th>Consignee</th>
                      <th>ShippingLine</th>
                      <th>Forwarder</th>
                      <th>BL No</th>
                      <th>ReceiptNo</th>
                      <th>ContainerNo</th>
                      <th>DepAmount</th>
                      <th >DepStatus</th>
                      <th>idBLNo</th>
                      <th>StubNoRefNo</th>
                      <th>CtrlFormNo</th>
                      <th>CheqNo</th>

                      <th><center>Stalled</center></th>
                      <th><center>Reconsideration</center></th>
                      <th><center>Acknowledgement</center></th>
                      <th><center>Notary EIR</center></th>
                      <th><center>Update</center></th>



                    </tr>
                  </thead>
                  <tbody align=left>

              <?php
               require 'paginator.php';
           //    require 'database.php';



               $pdo = Database::connect();
               $paginator = new Paginator();
               $sqlDep = "SELECT count(*)FROM `tbl_deposit` RIGHT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo`";
               $paginator->paginate($pdo->query($sqlDep)->fetchColumn());
               $sqlDep = "SELECT * FROM `tbl_deposit` RIGHT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo`";

               $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
               $query2 = isset($_GET['query2'])?('%'.$_GET['query2'].'%'):'%';
               $query3 = isset($_GET['query3'])?('%'.$_GET['query3'].'%'):'%';

               $sqlDep .= "WHERE (`id_Deposit` LIKE :query
                OR ShippingLine LIKE :query
                OR Forwarder LIKE :query
                OR Consignee LIKE :query
                OR DepBLNo LIKE :query
                OR ContainerNo LIKE :query
                OR ReceiptNo LIKE :query
                OR DepAmount LIKE :query
                OR DepStatus LIKE :query
                OR CtrlFormNo LIKE :query
                OR StubNoRefNo LIKE :query
                OR CheqNo LIKE :query)

                AND (`id_Deposit` LIKE :query2
                 OR ShippingLine LIKE :query2
                 OR Forwarder LIKE :query2
                 OR Consignee LIKE :query2
                 OR DepBLNo LIKE :query2
                 OR ContainerNo LIKE :query2
                 OR ReceiptNo LIKE :query2
                 OR DepAmount LIKE :query2
                 OR DepStatus LIKE :query2
                 OR CtrlFormNo LIKE :query2
                 OR StubNoRefNo LIKE :query2
                 OR CheqNo LIKE :query2)

                 AND (`id_Deposit` LIKE :query3
                  OR ShippingLine LIKE :query3
                  OR Forwarder LIKE :query3
                  OR Consignee LIKE :query3
                  OR DepBLNo LIKE :query3
                  OR ContainerNo LIKE :query3
                  OR ReceiptNo LIKE :query3
                  OR DepAmount LIKE :query3
                  OR DepStatus LIKE :query3
                  OR CtrlFormNo LIKE :query3
                  OR StubNoRefNo LIKE :query3
                  OR CheqNo LIKE :query3)";

                $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                $length = ($paginator->itemsPerPage);
                $sqlDep .= "ORDER BY tbl_deposit.id_Deposit DESC limit :start, :length";

                $sth = $pdo->prepare($sqlDep);
                $sth->bindParam(':start',$start,PDO::PARAM_INT);
                $sth->bindParam(':length',$length,PDO::PARAM_INT);
                $sth->bindParam(':query',$query,PDO::PARAM_STR);
                $sth->bindParam(':query2',$query2,PDO::PARAM_STR);
                $sth->bindParam(':query3',$query3,PDO::PARAM_STR);
                $sth->execute();

                foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {

		            echo '<tr>';
                echo '<td>'. $row['id_Deposit'] . '</td>';
                echo '<td >'. $row['Consignee'] . '</td>';
                echo '<td width="150px" >'. $row['ShippingLine'] . '</td>';
                echo '<td width="200px">'. $row['Forwarder'] . '</td>';

		            echo '<td >'. $row['DepBLNo'] . '</td>';
                echo '<td width="80">'. $row['ReceiptNo'] . '</td>';
                echo '<td>'. $row['ContainerNo'] . '</td>';


                echo '<td><div class=\'number\'>'. $row['DepAmount'] . '</div></td>';
                echo '<td width="200">'. $row['DepStatus'] . '</td>';
                echo '<td>'. $row['id_BLNo'] . '</td>';
                echo '<td>'. $row['StubNoRefNo'] . '</td>';
                echo '<td width="180">'. $row['CtrlFormNo'] . '</td>';

                echo '<td>'. $row['CheqNo'] . '</td>';




// Codes for choosing printpages
                $Forwarder = $row['Forwarder'];
                $_SESSION['Forwarder'] = $Forwarder;
                $ShippingLine =  $row['ShippingLine'];
                $CtrlFormNo = $row['CtrlFormNo'];
                $MessagePrint = null;
                $cheqNo = $row['CheqNo'];
                $_SESSION['checkNo']= $cheqNo;














                    $_SESSION['Forwarder'] = $Forwarder;
                                    $DepBLNo = null;
                                  $txtBL = null;
                                  $id_BLNo = null;
                                      //      if(!isset($_POST['textBL'])){
                                            //  $DepBLNo = $_POST['textBL'];
                                              $DepBLNo = $row['DepBLNo'];
                                                $DepAmount = $row['DepAmount'];
                                              $_SESSION["textBL"] = $DepBLNo;

                                            //echo $_POST['textBL'];
                                              $id_BLNo = $row['id_BLNo'];
                                              $_SESSION['id_BLNo'] = $id_BLNo;
                                              $CtrlFormNo=$row['CtrlFormNo'];
                                              $_SESSION['CtrlFormNo '] = $CtrlFormNo ;
                                               $uid=$_SESSION['u_uid'];
                                               $_SESSION['u_uid']=$uid;
                                      //        echo '<b>'.convert_number_to_words( @$DepAmount ).'</b>';

                                        echo '<td><center>';
                                        echo '<a id="print" class="btn btn-danger btn-small" href="reports/Stalled.php?id_Deposit='.$row['id_Deposit'].'&DepBLNo='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&Forwarder='.$row['Forwarder'].'&cheqNo='.$row['CheqNo'].'">Stalled</a>';
                                        echo '</center></td>';

                                        echo '<td><center>';
                                        echo '<a id="print" class="btn btn-success btn-small" href="reports/Reconsiderationrpt.php?id_Deposit='.$row['id_Deposit'].'&DepBLNo='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&Forwarder='.$row['Forwarder'].'&cheqNo='.$row['CheqNo'].'">Reconsideration</a>';
                                        echo '</center></td>';

                                        echo '<td><center>';
                                        echo '<a class="btn btn-primary btn-small" href="reports/Acknowledgementrpt.php?id_Deposit='.$row['id_Deposit'].'&DepBLNo='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&Forwarder='.$row['Forwarder'].'">Acknowledgement</a>';
                                        echo '</center></td>';

                                        echo '<td width="90" ><center>';
                                        echo '<a class="btn btn-warning btn-small" href="reports/Notaryrpt.php?id_Deposit='.$row['id_Deposit'].'&DepBLNo='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&Forwarder='.$row['Forwarder'].'">Notary EIR</a>';
                                        echo '</center></td>';

                                        echo '<td><center>';
                                        echo '<a class="btn btn-info btn-small pull-center" href="update_deposit.php?id_Deposit='.$row['id_Deposit'].'&textBL='.$row['DepBLNo'].'&ContainerNo='.$row['ContainerNo'].'&ReceiptNo='.$row['ReceiptNo'].'&CtrlFormNo='.$row['CtrlFormNo'].'&id_BLNo='.$row['id_BLNo'].'&DepAmount='.$row['DepAmount'].'&Consignee='.$row['Consignee'].'&ShippingLine='.$row['ShippingLine'].'&Forwarder='.$row['Forwarder'].'">Update</a>';
                                        echo '</center></td>';

                                        echo '</tr>';
                   }




                   Database::disconnect();
              //     session_destroy();
                  ?>












                  </tbody>

            </table>
            <?php
            echo $paginator->pageNav();
            ?>
        </div>
    </div> <!-- /container -->

    <script src="js/number-divider.min.js"></script>
    <script>
    $('.number').divide({
      delimiter: ','});

    </script>



  </body>
</html>
