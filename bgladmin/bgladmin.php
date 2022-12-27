<?php
include "../header.php";
include_once '../logstat.php';

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


  <div class="container" align="center">
    <br>


    <div border="1" class="span6 offset2">
      <h2 > ADMIN CONTROL PANEL </h2>
          <br>  <br>
      <a class= "btn btn-primary btn-large btn-block" href="consignee.php"> Consignee </a>  <br> <br>

      <a class= "btn btn-success btn-large btn-block" href="forwarder.php"> Forwarder </a> <br> <br>

      <a class= "btn btn-info btn-large btn-block" href="shippingline.php"> Shipping Line </a> <br> <br>

      <a class= "btn btn-warning btn-large btn-block" href="trucking.php"> Trucking </a> <br> <br>

      <a class= "btn btn-danger btn-large btn-block" href="city.php"> City </a> <br> <br>

      <a class= "btn btn-default btn-large btn-block" href="banklist.php"> Bank List </a> <br> <br>

      <a class= "btn btn-primary btn-large btn-block" href="depositstatus.php"> Deposit Status </a><br> <br>
<?php if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
      echo '<a class= "btn btn-success btn-large btn-block" href="users.php"> Users </a>';
    }
    ?>
    </div>



  </div>
</body>
</html>
