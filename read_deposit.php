<?php

include_once 'header.php';
include_once 'logstat.php';
// set


//    require 'database.php';
    include 'paginator.php';
$cr_containerNo = null;

    $id_Deposit = null;
    if ( !empty($_GET['id_Deposit'])) {
        $id_Deposit = $_REQUEST['id_Deposit'];
    }
    else{
      $id_Deposit = $_SESSION['id_Deposit'];


    }

    $id_contreq = null;
    if ( !empty($_GET['id_contreq'])) {
        $id_contreq = $_REQUEST['id_contreq'];
    }

    $_SESSION['id_contreq']=$id_contreq;
/*
    if ( null==$id_Deposit ) {
        header("Location: ViewDeposit.php");
    } else {*/
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_deposit where id_Deposit = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Deposit));
        $data = $q->fetch(PDO::FETCH_ASSOC);

//}

$myVariable = $data['DepBLNo'];
$_SESSION['textBL'] = $myVariable;

$txtContainerNo = $data['ContainerNo'];
$SESSION['txtContainerNo'] = $txtContainerNo;
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
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
      background-color: #aeb6bf;

    }
    #trbg{
      background-color: #212f3d;
      color: white;
    }


    #form-transparent
    {
    background-color: transparent;
    }
  </style>

</head>

<body>
  <br/><br/>
  <div class="container" >
   <div >
     <div class="span8">
       <br/>
         <h3 align='center'>View Container Deposit Details</h3>
         <br/>
     </div>

<table class="table table-striped table-bordered table-hover" style="width:70%">
<thead>
<tr>
<th>id Deposit</th>          <td>  <?php echo $id_Deposit?></td>
</tr>
<tr>
<th>Date Of Deposit</th>     <td><?php echo $data['DateOfDeposit']; ?></td>
</tr>
<tr>
<th>BLNo</th>        <td><?php echo $myVariable; ?></td>
</tr>
<tr>
<th>Container No</th>        <td><?php echo $data['ContainerNo']; $varContainerNo = $data['ContainerNo'];?></td>
</tr>
<tr>
<th>Receipt No</th>          <td><?php echo $data['ReceiptNo']; ?></td>
</tr>
<tr>
<th>Stub No / Ref No</th>     <td>  <?php echo $data['StubNoRefNo'];?></td>
</tr>
<tr>
<th>Deposit Amount</th>        <td class="number"><?php echo $data['DepAmount'];?></td>
</tr>

<?php

                      $sqlDep = "SELECT * FROM tbl_blcreate WHERE BLNo = '" . $myVariable . "'";
                      foreach ($pdo->query($sqlDep) as $row) {
                      $txtShippingLine = $row['ShippingLine'];

                      }
                      $sqlShipReq = "SELECT ShipReq FROM tbl_shippingline WHERE ShippingLine  = '" . $txtShippingLine . "'";

                      foreach ($pdo->query($sqlShipReq) as $row) {


                      echo '<tr>
                      <th>'.$txtShippingLine.'  Requirements </th>  <td style=\'background-color:GOLD\'> '. $row['ShipReq'] .' </td>
                      </tr>';


                      }

?>

</thead>
</table>



</div>
</div>







                      <div id="form-transparent" class="form-actions offset7" style="width:30%">

                         <form  align="left" method="post" action="addcontreq.php">
                         <div class="control-group">


                         <input readonly type="hidden" name="txtContainerNo" value="<?php echo $txtContainerNo; ?>">
                         <input readonly type="hidden" name="textBL" value="<?php echo $myVariable; ?>">
                         <a class="btn" href="ViewDeposit.php">Back</a>
                         <?php $id_contreq=$_SESSION['id_contreq']; ?>
                         <input readonly type="hidden" name="id_Deposit" value="<?php echo $data['id_Deposit'];?>">
                         <a href="addcontreq.php?id_Deposit=<?php echo $id_Deposit; ?>&id_contreq=<?php echo $id_contreq; ?>&varContainerNo=<?php echo $varContainerNo; ?>" class="btn btn-success">Add Requirements</a>
<?php

$_SESSION['id_Deposit'] = $data['id_Deposit'];

 Database::disconnect(); ?>
                       </div>
                       </div>


                               </div>
                           </div>

                   </div> <!-- /container -->


<!- ContReq Form Starts here ->
<div class="container-fluid">

<div class="row">

    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">

<!--        <input type="text" name="query" class="input-medium search-query" value="<?php //echo isset($_GET['query'])?$_GET['query']:'';?>">
        <button type="submit" class="btn btn-info">Search</button>
-->
    </form>
</div>

<div class="row offset3">



<table class="table table-striped table-bordered table-hover" style="width:60%">
  <h3> <?php echo $txtShippingLine; ?>  Requirements of Container No <?php echo $varContainerNo ?></h3>
  <thead>
    <tr id="trbg">
      <th>id</th>
      <th style="display: none;">BLNo</th>
      <th style="display: none;">ContNo</th>
      <th style="display: none;">ShipLine</th>
      <th bgcolor=#DAF7A6>O.R.</th>
      <th bgcolor=#DAF7A6>FCL</th>
      <th bgcolor=#DAF7A6>Empty</th>
      <th>Mbl</th>
      <th>ContGua</th>
      <th width="600px">Trucking</th>
      <th>PlateNo</th>
      <th width="800px">Driver</th>
      <th style="display: none;">ID Deposit</th>
      <th style="display: none;">Encodedby</th>
      <th style="display: none;">EncodedDateBLNo</th>
      <th style="width:100px">Update</th>
      <?php
      if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
      echo '<th style="width:50px">Delete</th>';
      }
      ?>

    </tr>
  </thead>
  <tbody>
  <?php

  //     include 'database.php';
       $pdo = Database::connect();
  //     $paginator = new Paginator();
  //     $sql = "SELECT count(*) FROM tbl_contreq";
//       $paginator->paginate($pdo->query($sql)->fetchColumn());

       $sql = "SELECT * FROM tbl_contreq WHERE cr_BLNo= '". $myVariable ."' AND cr_containerNo = '" . $varContainerNo . "' ";
/*
      $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';

    $sql .= "WHERE id_contreq :query
            OR cr_BLNo LIKE :query
            OR cr_containerNo LIKE :query
            OR cr_shippingLine LIKE :query
            OR cr_or LIKE : query
            OR cr_fcl LIKE : query
            OR cr_empty LIKE : query
            OR cr_masterbl LIKE : query
            OR cr_contgua LIKE : query
            OR cr_trucking LIKE : query
            OR cr_plateno LIKE : query
            OR cr_driver LIKE : query
            OR cr_Encodedby LIKE :query
            OR cr_EncodedDate LIKE :query ";

       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
       $length = ($paginator->itemsPerPage);
       $sql .= "ORDER BY id_contreq DESC limit :start, :length ";

       $sth = $pdo->prepare($sql);

       $sth->bindParam(':start',$start,PDO::PARAM_INT);
       $sth->bindParam(':length',$length,PDO::PARAM_INT);
       $sth->bindParam(':query',$query,PDO::PARAM_STR);
       $sth->execute();
       */

// foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {\
  foreach ($pdo->query($sql) as $row) {
  echo '<tr>';
  echo '<td>'. $row['id_contreq'] . '</td>';

  echo '<td style=\'display: none;\'>'. $row['cr_BLNo'] . '</td>';
  echo '<td style=\'display: none;\'>'. $row['cr_containerNo'] . '</td>';
  echo '<td style=\'display: none;\'>'. $row['cr_shippingLine'] . '</td>';
  echo '<td>'. $row['cr_or'] . '</td>';
  echo '<td>'. $row['cr_fcl'] . '</td>';
  echo '<td>'. $row['cr_empty'] . '</td>';
  echo '<td>'. $row['cr_masterbl'] . '</td>';
  echo '<td>'. $row['cr_contgua'] . '</td>';
  echo '<td width=\'200px\'>'. $row['cr_trucking'] . '</td>';
  echo '<td>'. $row['cr_plateno'] . '</td>';
  echo '<td width=\'200px\'>'. $row['cr_driver'] . '</td>';
    echo '<td style="display: none;">'. $row['id_Deposit'] . '</td>';
  echo '<td style=\'display: none;\'>'. $row['cr_Encodedby'] . '</td>';
  echo '<td style=\'display: none;\'>'. $row['cr_EncodedDate'] . '</td>';
  echo '<td>';
  echo '<a class="btn btn-success" href="update_contreq.php?id_contreq='.$row['id_contreq'].'">Update</a>';
  echo '</td>';
  if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
  echo '<td>';
  echo '<a class="btn btn-danger" href="deletecontreq.php?id_contreq='.$row['id_contreq'].'">Delete</a>';
  echo '</td>';
  }
  echo '</tr>';

}

$_SESSION['id_Deposit'] = $id_Deposit;
//echo $id_contreq;
$_SESSION['id_contreq'] = $id_contreq;




Database::disconnect();
?>
</tbody>
</table>
<?php
//echo $paginator->pageNav();
?>
</div>
</div>
</div> <!-- /container -->

<!- ContReq Form Ends Here ->



    <script src="js/number-divider.min.js"></script>
    <script>
    $('.number').divide({
      delimiter: ','
      });

    </script>


                                   </div>
                               </div>

  </body>
</html>
