<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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


</head>

<body>


    <div class="container-fluid">


            <div class="container alighn-left"><br>
                    <h3><font size=20><b>Container Deposits For Refund</b></font></h3>
            </div>



            <form id="form-transparent" class="form-search" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            <!--        <form method="post" action="ViewAlldepositJoin.php" >  -->
              <div class="container-fluid">
            <table style="width:100%">
              <thead>
              <tr>
                <th>
                          
                              <div class="container pull-right">
                                    <input type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>" placeholder="input search 1">
                                    <input type="text" name="query2" class="input-medium search-query" value="<?php echo isset($_GET['query2'])?$_GET['query2']:'';?>" placeholder="input search 2">
                                    
                                <button type="submit" class="btn btn-info">Search</button>



                                </form>
                              </th>
                            </tr>









            <div class="row">

<?php
              $pdo = Database::connect();
           
?>
<div class="container-fluid offset1">
<form id="form-transparent" class="form-search" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            <!--        <form method="post" action="ViewAlldepositJoin.php" >  -->

            <table style="width:100%">
              <thead>
            

<?php include "buttons.php"; ?>



      </table>

          </thead>
</table>
<br />

<div class="row">

                <table class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                    <tr id="trbg" >
                      <th>No</th>
                      <th>Consignee</th>
                      <th>ShippingLine</th>
                      <th>Forwarder</th>
                      <th>BL No</th>
                      <th>ReceiptNo</th>
                      <th>ContainerNo</th>
                      <th>DepAmount</th>
                       <th>DateOfDeposit</th>
                      <th >Refund Date</th>
                      <th >EncodedDate</th>
                      <th>CtrlFormNo</th>
                      <th>DepStatus</th>





                    </tr>
                  </thead>
                  <tbody align=left>

              <?php





               $sqlDep = "SELECT count(*)FROM `tbl_deposit` RIGHT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo`";

               $sqlDep = "SELECT * FROM `tbl_deposit` RIGHT JOIN tbl_blcreate ON tbl_deposit.`id_BLNo` = tbl_blcreate.`id_BLNo`";
               $sqlDep .= "WHERE tbl_deposit.`DepStatus` Like 'For Refund Follow up' AND tbl_deposit.refund_date != '	0000-00-00'";

               $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
               $query2 = isset($_GET['query2'])?('%'.$_GET['query2'].'%'):'%';
               
               $sqlDep .= "AND (`id_Deposit` LIKE :query
               OR ShippingLine LIKE :query
               OR Forwarder LIKE :query
               OR Consignee LIKE :query
               OR DepBLNo LIKE :query
               OR ContainerNo LIKE :query
               OR ReceiptNo LIKE :query
               OR DepAmount LIKE :query
               OR DateOfDeposit LIKE :query
               OR EncodedDateDeposit LIKE :query
               OR DepStatus LIKE :query
               OR CtrlFormNo LIKE :query
               OR StubNoRefNo LIKE :query
               OR CheqNo LIKE :query)";
               
               $sqlDep .= "AND (`id_Deposit` LIKE :query2
               OR ShippingLine LIKE :query2
               OR Forwarder LIKE :query2
               OR Consignee LIKE :query2
               OR DepBLNo LIKE :query2
               OR ContainerNo LIKE :query2
               OR ReceiptNo LIKE :query2
               OR DepAmount LIKE :query2
               OR DateOfDeposit LIKE :query2
               OR EncodedDateDeposit LIKE :query2
               OR DepStatus LIKE :query2
               OR CtrlFormNo LIKE :query2
               OR StubNoRefNo LIKE :query2
               OR CheqNo LIKE :query2)";






//                $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                $sqlDep .= "ORDER BY tbl_deposit.`refund_date`";







                $sth = $pdo->prepare($sqlDep);

                /*
               $sth->bindParam(':start',$start,PDO::PARAM_INT);
                $sth->bindParam(':length',$length,PDO::PARAM_INT);
                */
                $sth->bindParam(':query',$query,PDO::PARAM_STR);
                $sth->bindParam(':query2',$query2,PDO::PARAM_STR);
                

                $sth->execute();
                
                $x=0;
                $QueryDepTotal=0;
                foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
                
		       
		            $x++;
                echo '<tr>';
                echo '<td>'. $x .'</td>';
		       
		       
              //  echo '<td>'. $row['id_Deposit'] . '</td>';
                echo '<td >'. $row['Consignee'] . '</td>';
                echo '<td width="150px" >'. $row['ShippingLine'] . '</td>';
                echo '<td width="200px">'. $row['Forwarder'] . '</td>';

		            echo '<td >'. $row['DepBLNo'] . '</td>';
                echo '<td width="220">'. $row['ReceiptNo'] . '</td>';
                echo '<td>'. $row['ContainerNo'] . '</td>';

                
                echo '<td ><div class=\'number\'>'. $row['DepAmount'] . '</div></td>';
                echo '<td width="100px" style="background-color:#FFC300"><center>'. $row['DateOfDeposit'] . '</center></td>';
                echo '<td width="100px"><center>'. $row['EncodedDateDeposit'] . '</center></td>';
                
                
                
                
                echo '<td width="100"style="background-color:#FFC300"><center>'. $row['refund_date'] . '</td>';

                echo '<td width="200">'. $row['CtrlFormNo'] . '</td>';

                echo '<td>'. $row['DepStatus'] . '</td>';
                $QueryDepTotal+= $row['DepAmount'];

                   }

                 if (!isset($query) || !isset($query2)){
                     $QueryDepTotal = 0;
                     echo "";
                 }else{
                 echo '<div style="margin:20px" align=right><font color=#58d68d  size=5><b>QUERY-TOTAL DEPOSIT '. money_format('%i', ' '.$QueryDepTotal)  .'</b> </font></div>';
                    }

                   Database::disconnect();
              //     session_destroy();
                  ?>












                  </tbody>

            </table>
            <?php /*
            echo $paginator->pageNav(); */
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
