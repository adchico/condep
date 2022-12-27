<?php
include "../header.php";
 
include_once '../logstat.php';
include '../paginator.php';

$cr_containerNo = null;

    $id_Consignee = null;
    if ( !empty($_GET['id_Consignee'])) {
        $id_Consignee = $_REQUEST['id_Consignee'];
    }
    else{
      $id_Consignee = $_SESSION['id_Consignee'];
    }

    
/*
    if ( null==$id_Consignee ) {
        header("Location: ViewDeposit.php");
    } else {*/
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_consignee where id_Consignee = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Consignee));
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
  <script src="../dist/number-divider.min.js"></script>

    <script type="text/javascript" language="javascript">
          $(document).ready(function(){
            $("input").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            });
            });
    </script>




</head>

<body>

  <br> <br>
   <div class="container" >
    <div >
      <div class="span8">
        <br/>
          <h3 align='center'>View Consignee Details</h3>
          <br/>
      </div>
    
      
<table class="table table-striped table-bordered table-hover" style="width:70%">
<thead>
    <tr>
    <th>CONSIGNEE</th>          <td>  <?php echo $data['Consignee'];?></td>
    </tr>
    <tr>
    <th>CONSIGNEEFULL</th>     <td><?php echo $data['Consigneefull']; ?></td>
    </tr>
    <tr>
    <th>ADDRESS</th>        <td><?php echo $data['Address']; ?></td>
    </tr>
    <tr>
    <th>CITY</th>        <td><?php echo $data['City']; ?></td>
    </tr>
    <tr>
    <th>CONTACT PERSON</th>          <td><?php echo $data['ContactPerson']; ?></td>
    </tr>
    <tr>
    <th>DESIGNATION</th>     <td class="number">  <?php echo $data['Designation'];?></td>
    </tr>
    <tr>
    <th>TELNO</th>        <td><?php echo $data['TelNo'];?></td>
    </tr>
    <tr>
    <th>FAX</th>        <td><?php echo $data['Fax']; ?></td>      
    </tr>
    <tr>
    <th>EMAIL</th>          <td><?php echo $data['Email']; ?></td>
    </tr>
    <tr>
    <th>TIN</th>           <td><?php echo $data['TIN'];?></td>
    </tr>
    <tr>
    <th>ASSIGNATORY</th>        <td><?php echo $data['Assignatory'];?></td>
    </tr>
    <tr>
    <th>ASSIGTITLE</th>        <td><?php echo $data['AssigTitle']; ?></td>
    </tr>    
   
    <tr>
    <th>ENCODED BY</th>          <td><?php echo $data['Encodedby']; ?></td>
    </tr>
    <tr>
    <th>ENCODED DATE</th>     <td class="number">  <?php echo $data['EncodedDate'];?></td>  
    </tr>
</thead>
</table>
<right>
</div >

         <div class="span8" align=right>
            <form  method="post" action="consignee.php"  >
            <a class="btn" href="consignee.php">Home</a>
            <button type="submit" class="btn btn-success">Back</button>
          <!--          <a href="reports/A_CheqRefundrpt.php?&cheqNo='<?php// php echo $data['cheqno']; ?>'"  class="btn btn-primary pull-right">Print Cheq</a>
          -->    
  </div>
</right>
    </body>

  


  </html>
  <html>
