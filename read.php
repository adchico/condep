<?php

session_start();
// set


//include_once 'header.php';
include_once 'logstat.php';
    require 'database.php';
    $id_BLNo = null;
    if ( !empty($_GET['id_BLNo'])) {
        $id_BLNo = $_REQUEST['id_BLNo'];
    }






    if ( null==$id_BLNo ) {
        header("Location: viewbl.php");



    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_blcreate where id_BLNo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_BLNo));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
}

$myVariable = $data['BLNo'];

$_SESSION['textBL'] = $myVariable;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                      <br/>
                        <h3 align='center'>View Bill of Lading Info</h3>
                        <br/>
                    </div>

                    <div class="form-horizontal" >


                      <div class="control-group">
                        <label class="control-label">id_BLNo</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php // echo $data['BLNo'];
                                // variable got the value
                                      echo $id_BLNo;
                                ?>
                            </label>
                        </div>
                      </div>



                      <div class="control-group">
                        <label class="control-label">BLNo</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php // echo $data['BLNo'];
                                // variable got the value
                                      echo $myVariable;
                                ?>
                            </label>
                        </div>
                      </div>


                      <div class="control-group">
                        <label class="control-label">Consignee</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Consignee'];?>
                            </label>
                        </div>
                      </div>


                      <div class="control-group">
                        <label class="control-label">Forwarder</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Forwarder'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">ShippingLine</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ShippingLine'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Encodedby</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Encodedby'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">EncodedDateBLNo</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['EncodedDateBLNo'];?>
                            </label>
                        </div>
                      </div>
              <?php  $_SESSION['id_BLNo'] = $id_BLNo;
              ob_start();

              header('Location:ViewDeposit.php');

              ob_end_flush(); ?>
              <div class="form-actions">
              <form method="post" action="ViewDeposit.php">
              <a class="btn" href="viewbl.php">Back</a>
              <input type="hidden" name="textBL" value="<?php echo $myVariable; ?>">

			        <button type="submit" class="btn btn-success">Container Deposit</button>

                       </div>


                    </div>
                </div>

    </div> <!-- /container -->
  </body>
</html>
