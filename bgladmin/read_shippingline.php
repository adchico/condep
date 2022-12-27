<?php
include "../header.php";
include_once '../logstat.php';
include '../paginator.php';

$cr_containerNo = null;

    $id_Shipline = null;
    if ( !empty($_GET['id_Shipline'])) {
        $id_Shipline = $_REQUEST['id_Shipline'];
    }
    else{
      $id_Shipline = $_SESSION['id_Shipline'];
    }

    
/*
    if ( null==$id_Shipline ) {
        header("Location: ViewDeposit.php");
    } else {*/
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_shippingline where id_Shipline = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Shipline));
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
          <h3 align='center'>View ShippingLine Details</h3>
          <br/>
      </div>
    
      
<table class="table table-striped table-bordered table-hover" style="width:70%">
<thead>
    <tr>
    <th>ShippingLine</th>          <td>  <?php echo $data['ShippingLine'];?></td>
    </tr>
    <tr>
    <th>ShippingLinefull</th>     <td><?php echo $data['ShippingLinefull']; ?></td>
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
            <form  method="post" action="shippingline.php"  >
            <a class="btn" href="shippingline.php">Home</a>
            <button type="submit" class="btn btn-success">Back</button>
          <!--          <a href="reports/A_CheqRefundrpt.php?&cheqNo='<?php// php echo $data['cheqno']; ?>'"  class="btn btn-primary pull-right">Print Cheq</a>
          -->    
  </div>
</right>
    </body>

  


  </html>
  <html>
