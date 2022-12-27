<?php
include "../header.php";
require 'uploader.php';
include_once '../logstat.php';


    if ( !empty($_GET['id_Forwarder'])) {
        $id_Forwarder = $_REQUEST['id_Forwarder'];
    //    echo $id_Forwarder;
    }

//    if ( null==$id_Forwarder ) {
//        header("Location: read_deposit.php");
//    }

    if ( !empty($_POST)) {

        $ForwarderError = null;
        $ForwarderfullError = null;
        $Address1Error = null;
        $Address2Error = null;
        $Address3Error = null;
        $Contact1Error = null;
        $Contact2Error = null;
        $EncodedbyError = null;
        $EncodedDateError = null;


        // keep track post values
        $Forwarder = $_POST['Forwarder'];
        $Forwarderfull = $_POST['Forwarderfull'];
        $Address1 = $_POST['Address1'];
        $Address2 = $_POST['Address2'];
        $Address3 = $_POST['Address3'];
        $Contact1 = $_POST['Contact1'];
        $Contact2 = $_POST['Contact2'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

        if (empty($Forwarder)) {
            $ForwarderError = 'Please enter Forwarder';
            $valid = false;
        }

        if (empty($Forwarderfull)) {
            $ForwarderfullError = 'Please enter Forwarderfull Address';
            $valid = false;
        }

        if (empty($Address1)) {
            $Address1Error = 'Please enter Address1 Address';
            $valid = false;
        }

        if (empty($Address2)) {
            $Address2Error = 'Please enter Address2 Number';
           $valid = false;
        }
                // 11 starts here

        if (empty($Address3)) {
            $Address3Error = 'Please enter Address3 Number';
           $valid = false;
        }

        if (empty($Contact1)) {
            $Contact1Error = 'Please enter Contact1 Number';
          $valid = false;
        }

        if (empty($Contact2)) {
            $Contact2Error = 'Please enter Contact2 Number';
           $valid = false;
        }


        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby Number';
    //      $valid = false;
        }

        if (empty($EncodedDate)) {
            $EncodedDateError = 'Please enter EncodedDate Number';
    //       $valid = false;
        }






        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tbl_forwarder SET Forwarder = ?, Forwarderfull = ?, Address1 = ?, Address2 = ?, Address3 = ?, Contact1 = ?, Contact2 = ?, Encodedby = ?, EncodedDate = ? WHERE id_Forwarder = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($Forwarder,$Forwarderfull,$Address1,$Address2,$Address3,$Contact1,$Contact2,$Encodedby,$EncodedDate,$id_Forwarder));
            $message = 'Congratulations! You have Sucessfully Updated the Forwarder ' . $Forwarder;
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'forwarder.php';\",1000);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\Forwarder.php?id_Forwarder=' . $id_Forwarder . '';\",1000,);</script>";
        //    header("Location: read_deposit.php");
            Database::disconnect();
            exit();
          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_forwarder where id_Forwarder = '".$id_Forwarder."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Forwarder));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $Forwarder = $data['Forwarder'];
        $Forwarderfull = $data['Forwarderfull'];
        $Address1 = $data['Address1'];
        $Address2 = $data['Address2'];
        $Address3 = $data['Address3'];
        $Contact1 = $data['Contact1'];
        $Contact2 = $data['Contact2'];

        $Encodedby = $data['Encodedby'];
        $EncodedDate = $data['EncodedDate'];

        Database::disconnect();
          }



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link   href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../dist/number-divider.min.js"></script>

    

<style>
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: Beige;
}
</style>


</head>



</head>

<body>
    <div class="container">

                <div class="span11 offset1">
                    <div class="row"><br/>
                        <h3>Update Container Requirements</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_forwarder.php?id_Forwarder=<?php echo $id_Forwarder?>" method="post">


                      <div class="control-group <?php echo !empty($ForwarderError)?'error':'';?>">
                        <label class="control-label">Forwarder</label>
                        <div class="controls">
                            <input name="Forwarder" type="text"  placeholder="Forwarder" value="<?php echo !empty($Forwarder)?$Forwarder:'';?>">
                            <?php if (!empty($ForwarderError)): ?>
                                <span class="help-inline"><?php echo $ForwarderError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($ForwarderfullError)?'error':'';?>">
                        <label class="control-label">Forwarderfull</label>
                        <div class="controls">
                            <input name="Forwarderfull" type="text"  placeholder="Forwarderfull" value="<?php echo !empty($Forwarderfull)?$Forwarderfull:'';?>">
                            <?php if (!empty($ForwarderfullError)): ?>
                                <span class="help-inline"><?php echo $ForwarderfullError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($Address1Error)?'error':'';?>">
                        <label class="control-label">Address1</label>
                        <div class="controls">
                            <input name="Address1" type="text"  placeholder="Address1" value="<?php echo !empty($Address1)?$Address1:'';?>">
                            <?php if (!empty($Address1Error)): ?>
                                <span class="help-inline"><?php echo $Address1Error;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($Address2Error)?'error':'';?>">
                        <label class="control-label">Address2</label>
                        <div class="controls">
                            <input name="Address2" type="text"  placeholder="Address2" value="<?php echo !empty($Address2)?$Address2:'';?>">
                            <?php if (!empty($Address2Error)): ?>
                                <span class="help-inline"><?php echo $Address2Error;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

<!- 11 Starts Here ->

                    <div class="control-group <?php echo !empty($Address3Error)?'error':'';?>">
                      <label class="control-label">Address3</label>
                      <div class="controls">
                          <input name="Address3" type="text"  placeholder="Address3" value="<?php echo !empty($Address3)?$Address3:'';?>">
                          <?php if (!empty($Address3Error)): ?>
                              <span class="help-inline"><?php echo $Address3Error;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($Contact1Error)?'error':'';?>">
                      <label class="control-label">Contact1</label>
                      <div class="controls">
                          <input name="Contact1" type="text"  placeholder="Contact1" value="<?php echo !empty($Contact1)?$Contact1:'';?>">
                          <?php if (!empty($Contact1Error)): ?>
                              <span class="help-inline"><?php echo $Contact1Error;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($Contact2Error)?'error':'';?>">
                      <label class="control-label">Contact2</label>
                      <div class="controls">
                          <input name="Contact2" type="text"  placeholder="Contact2" value="<?php echo !empty($Contact2)?$Contact2:'';?>">
                          <?php if (!empty($Contact2Error)): ?>
                              <span class="help-inline"><?php echo $Contact2Error;?></span>
                          <?php endif; ?>
                      </div>
                    </div>


                    <div class="control-group ">
                      <label class="control-label">Encodedby </label>
                      <div class="controls">
                          <input Readonly name="" type="text"  placeholder="Encodedby" value="<?php echo !empty($Encodedby)?$Encodedby: '';?>">

                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label">EncodedDate </label>
                      <div class="controls">
                          <input Readonly name="" type="text"  placeholder="EncodedDate" value="<?php echo !empty($EncodedDate)?$EncodedDate: '';?>">

                        </div>
                      </div>

                    <div style="display: none;" class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                      <label class="control-label">Encodedby NOW</label>
                      <div class="controls">
                          <input Readonly name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                          <?php if (!empty($EncodedbyError)): ?>
                              <span class="help-inline"><?php echo $EncodedbyError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div style="display: none;" class="control-group <?php echo !empty($EncodedDateError)?'error':'';?>">
                      <label class="control-label">EncodedDate NOW</label>
                      <div class="controls">
                          <input Readonly name="EncodedDate" type="text"  placeholder="EncodedDate" value="<?php $currentDateTime = date('Y-m-d');
                          echo $currentDateTime;
                          ?>">
                          <?php if (!empty($EncodedDateError)): ?>
                              <span class="help-inline"><?php echo $EncodedDateError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>



<!- 11 ends Here ->

                      <div class="form-actions">
                        <a class="btn" href="forwarder.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
