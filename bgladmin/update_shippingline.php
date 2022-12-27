<?php
include "../header.php";
include_once '../logstat.php';


    if ( !empty($_GET['id_Shipline'])) {
        $id_Shipline = $_REQUEST['id_Shipline'];
    //    echo $id_Shipline;
    }

//    if ( null==$id_Shipline ) {
//        header("Location: read_deposit.php");
//    }

    if ( !empty($_POST)) {

        $ShippingLineError = null;
        $ShippingLinefullError = null;
        $ShipReq  = null;
        $Address1Error = null;
        $Address2Error = null;
        $Address3Error = null;
        $Contact1Error = null;
        $Contact2Error = null;
        $Authorize1Error = null;
        $Authorize2Error = null;
        $EncodedbyError = null;
        $EncodedDateError = null;


        // keep track post values
        $ShippingLine = $_POST['ShippingLine'];
        $ShippingLinefull = $_POST['ShippingLinefull'];
        $ShipReq = $_POST['ShipReq'];

        $Address1 = $_POST['Address1'];
        $Address2 = $_POST['Address2'];
        $Address3 = $_POST['Address3'];
        $Contact1 = $_POST['Contact1'];
        $Contact2 = $_POST['Contact2'];
        $Authorize1 = $_POST['Authorize1'];
        $Authorize2 = $_POST['Authorize2'];

        
        
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

        if (empty($ShippingLine)) {
            $ShippingLineError = 'Please enter ShippingLine';
            $valid = false;
        }

        if (empty($ShippingLinefull)) {
            $ShippingLinefullError = 'Please enter ShippingLinefull Address';
            $valid = false;
        }

        if (empty($ShipReq)) {
            $ShipReqError = 'Please enter ShipReq';
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


        if (empty($Authorize1)) {
            $Authorize1Error = 'Please enter 1st Authorized Personnel';
            $valid = false;
        }
        
        
        if (empty($Authorize2)) {
            $Authorize2Error = 'Please enter 2nd Authorized Personnel';
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
            $sql = "UPDATE tbl_shippingline SET ShippingLine = ?, ShippingLinefull = ?, ShipReq = ?, Address1 = ?, Address2 = ?, Address3 = ?, Contact1 = ?, Contact2 = ?, Authorize1 = ?, Authorize2 = ?, Encodedby = ?, EncodedDate = ? WHERE id_Shipline = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($ShippingLine,$ShippingLinefull,$ShipReq,$Address1,$Address2,$Address3,$Contact1,$Contact2,$Authorize1,$Authorize2,$Encodedby,$EncodedDate,$id_Shipline));
            $message = 'Congratulations! You have Sucessfully Updated the ShippingLine ' . $ShippingLine;
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\shippingline.php';\",1000);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\ShippingLine.php?id_Shipline=' . $id_Shipline . '';\",1000,);</script>";
        //    header("Location: read_deposit.php");
            Database::disconnect();
            exit();
          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_shippingline where id_Shipline = '".$id_Shipline."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Shipline));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $ShippingLine = $data['ShippingLine'];
        $ShippingLinefull = $data['ShippingLinefull'];
        $ShipReq = $data['ShipReq'];
        $Address1 = $data['Address1'];
        $Address2 = $data['Address2'];
        $Address3 = $data['Address3'];
        $Contact1 = $data['Contact1'];
        $Contact2 = $data['Contact2'];
        $Authorize1 = $data['Authorize1'];
        $Authorize2 = $data['Authorize2'];

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
input{
   width:500px;
}
</style>


</head>



</head>

<body>
    <div class="container">

                <div class="span11 offset1">
                    <div class="row"><br/>
                        <h3>Update Shipping Line Info</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_shippingline.php?id_Shipline=<?php echo $id_Shipline?>" method="post">


                      <div class="control-group <?php echo !empty($ShippingLineError)?'error':'';?>">
                        <label class="control-label">ShippingLine</label>
                        <div class="controls">
                            <input name="ShippingLine" type="text"  placeholder="ShippingLine" value="<?php echo !empty($ShippingLine)?$ShippingLine:'';?>">
                            <?php if (!empty($ShippingLineError)): ?>
                                <span class="help-inline"><?php echo $ShippingLineError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($ShippingLinefullError)?'error':'';?>">
                        <label class="control-label">ShippingLinefull</label>
                        <div class="controls">
                            <input name="ShippingLinefull" type="text"  placeholder="ShippingLinefull" value="<?php echo !empty($ShippingLinefull)?$ShippingLinefull:'';?>">
                            <?php if (!empty($ShippingLinefullError)): ?>
                                <span class="help-inline"><?php echo $ShippingLinefullError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($ShipReqError)?'error':'';?>">
                        <label class="control-label">ShipReq</label>
                        <div class="controls">
                            <input name="ShipReq" type="text"  placeholder="ShipReq" value="<?php echo !empty($ShipReq)?$ShipReq:'';?>">
                            <?php if (!empty($ShipReqError)): ?>
                                <span class="help-inline"><?php echo $ShipReqError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group" <?php echo !empty($Address1Error)?'error':'';?>">
                        <label class="control-label">Address1</label>
                        <div class="controls">
                            <input maxlenght="50" name="Address1" type="text"  placeholder="Address1" value="<?php echo !empty($Address1)?$Address1:'';?>">
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


                    <div class="control-group <?php echo !empty($Authorize1Error)?'error':'';?>">
                      <label class="control-label">1st Authorized Representative</label>
                      <div class="controls">
                          <input name="Authorize1" type="text"  placeholder="Authorize1" value="<?php echo !empty($Authorize1)?$Authorize1:'';?>">
                          <?php if (!empty($Authorize1Error)): ?>
                              <span class="help-inline"><?php echo $Authorize1Error;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($Authorize2Error)?'error':'';?>">
                      <label class="control-label">2nd Authorized Representative</label>
                      <div class="controls">
                          <input name="Authorize2" type="text"  placeholder="Authorize2" value="<?php echo !empty($Authorize2)?$Authorize2:'';?>">
                          <?php if (!empty($Authorize2Error)): ?>
                              <span class="help-inline"><?php echo $Authorize2Error;?></span>
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
                        <a class="btn" href="shippingline.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
