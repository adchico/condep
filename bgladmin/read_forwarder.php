<?php
 include "../header.php";
include_once '../logstat.php';
include '../paginator.php';

$cr_containerNo = null;

    $id_Forwarder = null;
    if ( !empty($_GET['id_Forwarder'])) {
        $id_Forwarder = $_REQUEST['id_Forwarder'];
    }
    else{
      $id_Forwarder = $_SESSION['id_Forwarder'];
    }

    
/*
    if ( null==$id_Forwarder ) {
        header("Location: ViewDeposit.php");
    } else {*/
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_forwarder where id_Forwarder = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Forwarder));
        $data = $q->fetch(PDO::FETCH_ASSOC);

//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link   href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>






</head>

<body>

  <br> <br>
   <div class="container" >
    <div >
      <div class="span8">
        <br/>
          <h3 align='center'>View Forwarder Details</h3>
          <br/>
      </div>
    
      
<table class="table table-striped table-bordered table-hover" style="width:70%">
<thead>
    <tr>
    <th>Forwarder</th>          <td>  <?php echo $data['Forwarder'];?></td>
    </tr>
    <tr>
    <th>Forwarderfull</th>     <td><?php echo $data['Forwarderfull']; ?></td>
    </tr>
    <tr>
    <th>ADDRESS1</th>        <td><?php echo $data['Address1']; ?></td>
    </tr>
    <tr>
    <th>Address2</th>        <td><?php echo $data['Address2']; ?></td>
    </tr>
    <tr>
    <th>Address3</th>          <td><?php echo $data['Address3']; ?></td>
    </tr>
    <tr>
    <th>Contact1</th>     <td class="number">  <?php echo $data['Contact1'];?></td>
    </tr>
    <tr>
    <th>Contact2</th>        <td><?php echo $data['Contact2'];?></td>
    </tr>
  
    <tr>
    <th>ENCODED BY LATEST</th>          <td><?php echo $data['Encodedby']; ?></td>
    </tr>
    <tr>
    <th>ENCODED DATE LATEST</th>     <td class="number">  <?php echo $data['EncodedDate'];?></td>  
    </tr>
</thead>
</table>
<right>
</div >

         <div class="span8" align=right>
            <form  method="post" action="forwarder.php"  >
            <a class="btn" href="forwarder.php">Home</a>
            <button type="submit" class="btn btn-success">Back</button>
          <!--          <a href="reports/A_CheqRefundrpt.php?&cheqNo='<?php// php echo $data['cheqno']; ?>'"  class="btn btn-primary pull-right">Print Cheq</a>
          -->    
  </div>
</right>
    </body>

  


  </html>
  <html>
