<?php
include_once 'header.php';
include_once 'logstat.php';
 //   require 'database.php';


    if ( !empty($_GET['id_contreq'])) {
        $id_contreq = $_REQUEST['id_contreq'];
    //    echo $id_contreq;
    }

//    if ( null==$id_contreq ) {
//        header("Location: read_deposit.php");
//    }

    if ( !empty($_POST)) {

        $cr_BLNoError = null;
        $cr_containerNoError = null;
        $cr_shippingLineError = null;
        $cr_orError = null;
        $cr_fclError = null;
        $cr_emptyError = null;
        $cr_masterblError = null;
        $cr_contguaError = null;
        $cr_truckingError = null;
        $cr_platenoError = null;
        $cr_driverError = null;
        $id_DepositError = null;
        $cr_EncodedbyError = null;
        $cr_EncodedDateError = null;


        // keep track post values
        $cr_BLNo = $_POST['cr_BLNo'];
        $cr_containerNo = $_POST['cr_containerNo'];
        $cr_shippingLine = $_POST['cr_shippingLine'];
        $cr_or = $_POST['cr_or'];
        $cr_fcl = $_POST['cr_fcl'];
        $cr_empty = $_POST['cr_empty'];
        $cr_masterbl = $_POST['cr_masterbl'];
        $cr_contgua = $_POST['cr_contgua'];
        $cr_trucking= $_POST['cr_trucking'];
        $cr_plateno= $_POST['cr_plateno'];
        $cr_driver= $_POST['cr_driver'];
        $id_Deposit = $_POST['id_Deposit'];
        $cr_Encodedby = $_POST['cr_Encodedby'];
        $cr_EncodedDate = $_POST['cr_EncodedDate'];

        // validate input
        $valid = true;

        if (empty($cr_BLNo)) {
            $cr_BLNoError = 'Please enter cr_BLNo';
            $valid = false;
        }

        if (empty($cr_containerNo)) {
            $cr_containerNoError = 'Please enter cr_containerNo Address';
            $valid = false;
        }

        if (empty($cr_shippingLine)) {
            $cr_shippingLineError = 'Please enter cr_shippingLine Number';
           $valid = false;
        }
                // 11 starts here

        if (empty($cr_or)) {
            $cr_orError = 'Please enter cr_or Number';
           $valid = false;
        }

        if (empty($cr_fcl)) {
            $cr_fclError = 'Please enter cr_fcl Number';
          $valid = false;
        }

        if (empty($cr_empty)) {
            $cr_emptyError = 'Please enter cr_empty Number';
           $valid = false;
        }

        if (empty($cr_masterbl)) {
            $cr_masterblError = 'Please enter cr_masterbl Number';
           $valid = false;
        }

        if (empty($cr_contgua)) {
            $cr_contguaError = 'Please enter cr_contgua Number';
            $valid = false;
        }

        if (empty($cr_trucking)) {
            $cr_truckingError = 'Please enter cr_trucking Number';
            $valid = false;
        }

        if (empty($cr_plateno)) {
            $cr_platenoError = 'Please enter cr_plateno Number';
           $valid = false;
        }

        if (empty($cr_driver)) {
            $cr_driverError = 'Please enter cr_driver Number';
           $valid = false;
        }

        if (empty($id_Deposit)) {
            $id_DepositError = 'Please enter id_Deposit Number';
           $valid = false;
        }

        if (empty($cr_Encodedby)) {
            $cr_EncodedbyError = 'Please enter cr_Encodedby Number';
          $valid = false;
        }

        if (empty($cr_EncodedDate)) {
            $cr_EncodedDateError = 'Please enter cr_EncodedDate Number';
           $valid = false;
        }



                 // 11 ends hereby


        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tbl_contreq SET cr_BLNo = ?, cr_containerNo = ?, cr_shippingLine = ?, cr_or = ?, cr_fcl = ?, cr_empty = ?, cr_masterbl = ?, cr_contgua = ?, cr_trucking = ?, cr_plateno = ?, cr_driver = ?, id_Deposit = ?, cr_Encodedby = ?, cr_EncodedDate = ? WHERE id_contreq = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($cr_BLNo,$cr_containerNo,$cr_shippingLine,$cr_or,$cr_fcl,$cr_empty,$cr_masterbl,$cr_contgua,$cr_trucking,$cr_plateno,$cr_driver,$id_Deposit,$cr_Encodedby,$cr_EncodedDate,$id_contreq));

           $message = 'Congratulations! Container Requirement Sucessfully Updated!';
           echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\contreq_msg.php';\",1000,);</script>";

            Database::disconnect();
            header("Location: read_deposit.php");

          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_contreq where id_contreq = '".$id_contreq."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_contreq));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $cr_BLNo = $data['cr_BLNo'];
        $cr_containerNo = $data['cr_containerNo'];
        $cr_shippingLine = $data['cr_shippingLine'];
        $cr_or = $data['cr_or'];
        $cr_fcl = $data['cr_fcl'];
        $cr_empty = $data['cr_empty'];
        $cr_masterbl = $data['cr_masterbl'];
        $cr_contgua = $data['cr_contgua'];
        $cr_trucking= $data['cr_trucking'];
        $cr_plateno= $data['cr_plateno'];
        $cr_driver= $data['cr_driver'];
        $id_Deposit = $data['id_Deposit'];
        $cr_Encodedby = $data['cr_Encodedby'];
        $cr_EncodedDate = $data['cr_EncodedDate'];

        Database::disconnect();
          }





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="dist/number-divider.min.js"></script>

    <script type="text/javascript" language="javascript">
          $(document).ready(function(){
            $("input").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            });
            });
    </script>



</head>

<body>
    <div class="container">

                <div class="span11 offset1">
                    <div class="row"><br/>
                        <h3>Update a Container Requirements</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_contreq.php?id_contreq=<?php echo $id_contreq?>" method="post">


                      <div class="control-group ">
                        <label class="control-label">cr_BLNo</label>
                        <div class="controls">
                            <input readonly  name="cr_BLNo" type="text"  placeholder="cr_BLNo" value="<?php echo !empty($cr_BLNo)?$cr_BLNo:'';?>">

                        </div>
                      </div>


                      <div class="control-group ">
                        <label class="control-label">cr_containerNo Address</label>
                        <div class="controls">
                            <input readonly name="cr_containerNo" type="text" placeholder="cr_containerNo" value="<?php echo !empty($cr_containerNo)?$cr_containerNo:'';?>">

                        </div>
                      </div>


                      <div class="control-group >">
                                            <label class="control-label">ShippingLine</label>
                                            <div class="controls">

                        <?php
                      //Combo box of ShippingLine db connection

                        $pdo = Database::connect();
                        $smt_ShippingLine = $pdo->prepare('SELECT ShippingLine From tbl_shippingline');
                        $smt_ShippingLine->execute();
                        $data_ShippingLine = $smt_ShippingLine->fetchAll();
                        ?>

<!- Select of ShippingLine ->
                          <INPUT readonly name="cr_shippingLine" type="text" placeholder="Shipping Line" value="<?php echo !empty($cr_shippingLine)?$cr_shippingLine:'';?>">




                      </div>
                    </div>


<!- 11 Starts Here ->

                    <div class="control-group <?php echo !empty($cr_orError)?'error':'';?>">
                      <label class="control-label">cr_or</label>
                      <div class="controls">
                          <input name="cr_or" type="text"  placeholder="cr_or" value="<?php echo !empty($cr_or)?$cr_or:'';?>">
                          <?php if (!empty($cr_orError)): ?>
                              <span class="help-inline"><?php echo $cr_orError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($cr_fclError)?'error':'';?>">
                      <label class="control-label">cr_fcl</label>
                      <div class="controls">
                          <input name="cr_fcl" type="text"  placeholder="cr_fcl" value="<?php echo !empty($cr_fcl)?$cr_fcl:'';?>">
                          <?php if (!empty($cr_fclError)): ?>
                              <span class="help-inline"><?php echo $cr_fclError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($cr_emptyError)?'error':'';?>">
                      <label class="control-label">cr_empty</label>
                      <div class="controls">
                          <input name="cr_empty" type="text"  placeholder="cr_empty" value="<?php echo !empty($cr_empty)?$cr_empty:'';?>">
                          <?php if (!empty($cr_emptyError)): ?>
                              <span class="help-inline"><?php echo $cr_emptyError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($cr_masterblError)?'error':'';?>">
                      <label class="control-label">cr_masterbl</label>
                      <div class="controls">
                          <input name="cr_masterbl" type="text"  placeholder="cr_masterbl" value="<?php echo !empty($cr_masterbl)?$cr_masterbl:'';?>">
                          <?php if (!empty($cr_masterblError)): ?>
                              <span class="help-inline"><?php echo $cr_masterblError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($cr_contguaError)?'error':'';?>">
                      <label class="control-label">cr_contgua</label>
                      <div class="controls">
                          <input name="cr_contgua" type="text"  placeholder="cr_contgua" value="<?php echo !empty($cr_contgua)?$cr_contgua:'';?>">
                          <?php if (!empty($cr_contguaError)): ?>
                              <span class="help-inline"><?php echo $cr_contguaError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($cr_truckingError)?'error':'';?>">
                                          <label class="control-label">trucking</label>
                                          <div class="controls">

                      <?php
                    //Combo box of trucking db connection

                      $pdo = Database::connect();
                      $smt_trucking = $pdo->prepare('SELECT truckingcode FROM `tbl_trucking` ORDER BY `tbl_trucking`.`truckingcode` ASC ');
                      $smt_trucking->execute();
                      $data_trucking = $smt_trucking->fetchAll();
                      ?>

<!- Select of trucking ->
                        <SELECT name="cr_trucking" type="text" placeholder="cr_trucking" value="<?php echo !empty($cr_trucking)?$cr_trucking:'';?>">
                            <option value="<?php echo $cr_trucking;?>" selected><?php echo $cr_trucking;?></option>
                            <?php
                            //Combo box  of trucking
                            foreach ($data_trucking as $row): ?>
                              <option><?=$row["truckingcode"]?></option>
                            <?php endforeach ?>
                            // end of combo box of trucking
                          </SELECT>
                        <?php if (!empty($truckingError)): ?>
                            <span class="help-inline"><?php echo $truckingError;?></span>
                        <?php endif;?>
                    </div>
                  </div>

                    <div class="control-group <?php echo !empty($cr_platenoError)?'error':'';?>">
                      <label class="control-label">cr_plateno</label>
                      <div class="controls">
                          <input name="cr_plateno" type="text"  placeholder="cr_plateno" value="<?php echo !empty($cr_plateno)?$cr_plateno:'';?>">
                          <?php if (!empty($cr_platenoError)): ?>
                              <span class="help-inline"><?php echo $cr_platenoError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($cr_driverError)?'error':'';?>">
                      <label class="control-label">cr_driver</label>
                      <div class="controls">
                          <input name="cr_driver" type="text"  placeholder="cr_driver" value="<?php echo !empty($cr_driver)?$cr_driver:'';?>">
                          <?php if (!empty($cr_driverError)): ?>
                              <span class="help-inline"><?php echo $cr_driverError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div style="display: none;" class="control-group <?php echo !empty($id_DepositError)?'error':'';?>">
                      <label style="display: none;" class="control-label">id_Deposit</label>
                      <div style="display: none;" class="controls">
                          <input style="display: none;" readonly name="id_Deposit" type="text"  placeholder="id_Deposit" value="<?php echo !empty($id_Deposit)?$id_Deposit:'';?>">
                          <?php if (!empty($id_DepositError)): ?>
                              <span class="help-inline"><?php echo $id_DepositError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group ">
                      <label class="control-label">cr_Encodedby </label>
                      <div class="controls">
                          <input Readonly name="" type="text"  placeholder="cr_Encodedby" value="<?php echo !empty($cr_Encodedby)?$cr_Encodedby: '';?>">

                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label">cr_EncodedDate </label>
                      <div class="controls">
                          <input Readonly name="" type="text"  placeholder="cr_EncodedDate" value="<?php echo !empty($cr_EncodedDate)?$cr_EncodedDate: '';?>">

                        </div>
                      </div>

                    <div style="display: none;" class="control-group <?php echo !empty($cr_EncodedbyError)?'error':'';?>">
                      <label class="control-label">cr_Encodedby NOW</label>
                      <div class="controls">
                          <input Readonly name="cr_Encodedby" type="text"  placeholder="cr_Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                          <?php if (!empty($cr_EncodedbyError)): ?>
                              <span class="help-inline"><?php echo $cr_EncodedbyError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div style="display: none;" class="control-group <?php echo !empty($cr_EncodedDateError)?'error':'';?>">
                      <label class="control-label">cr_EncodedDate NOW</label>
                      <div class="controls">
                          <input Readonly name="cr_EncodedDate" type="text"  placeholder="cr_EncodedDate" value="<?php $currentDateTime = date('Y-m-d');
                          echo $currentDateTime;
                          ?>">
                          <?php if (!empty($cr_EncodedDateError)): ?>
                              <span class="help-inline"><?php echo $cr_EncodedDateError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>




<!- 11 ends Here ->

                      <div class="form-actions">
                        <a class="btn" href="read_deposit.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
