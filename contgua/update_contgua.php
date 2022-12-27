<!DOCTYPE html>

<?php
session_start();

include('/home/wpxgrynlfqu1/public_html/betty/database.php');


//  include_once 'top.php';

include 'header.php';
include 'logstat.php';



    $id_contgua = null;
    if ( !empty($_GET['id_contgua'])) {
        $id_contgua = $_REQUEST['id_contgua'];
    }

    if ( null==$id_contgua) {
        header("Location: view_contgua.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $LetterDateError = null;
        $BLNoError = null;
				$VesselNameError = null;
				$VoyageNoError = null;
				$ContainerNoError = null;
        $ConsigneeError = null;
        $ForwarderError = null;
        $ShippingLineError = null;
        $EncodedbyError = null;
        $EncodedDateBLNoError = null;
        // keep track post values
        $LetterDate = $_POST['LetterDate'];
        $BLNo = $_POST['BLNo'];
        $VesselName = $_POST['VesselName'];
        $VoyageNo = $_POST['VoyageNo'];
        $ContainerNo = $_POST['ContainerNo'];
        $Consignee = $_POST['Consignee'];
        $Forwarder = $_POST['Forwarder'];
        $ShippingLine = $_POST['ShippingLine'];
        $Encodedby = $_SESSION['u_uid'];
        $EncodedDateBLNo = $_POST['EncodedDateBLNo'];


        $valid = true;

        if (empty($LetterDate)) {
            $LetterDateError = 'Please enter LetterDate';
            $valid = false;
        }


        if (empty($BLNo)) {
            $BLNoError = 'Please enter BLNo';
            $valid = false;
        }

  //************************************

  if (empty($VesselName)) {
    $VesselNameError = 'Please enter VesselName';
    $valid = false;
  }

  if (empty($VoyageNo)) {
    $VoyageNoError = 'Please enter VoyageNo';
    $valid = false;
  }

  if (empty($ContainerNo)) {
    $ContainerNoError = 'Please enter ContainerNo';
    $valid = false;
  }

  //************************************

        if (empty($Consignee)) {
            $ConsigneeError = 'Please enter Consignee';
            $valid = false;

        }


        if (empty($Forwarder)) {
            $ForwarderError = 'Please enter Forwarder Number';
            $valid = false;
        }

        if (empty($ShippingLine)) {
            $ShippingLineError = 'Please enter ShippingLine';
            $valid = false;
        }


        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby';
            $valid = false;
        }

        if (empty($EncodedDateBLNo)) {
            $EncodedDateBLNoError = 'Please enter Encoded Date BLNo';
            $valid = false;
        }


        // update data

        if ($valid) {


            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //          $sql = "UPDATE tbl_contgua SET  BLNo = ?, Consignee = ?, Forwarder = ?, ShippingLine = ?, Encodedby = ?, EncodedDateBLNo = ? WHERE id_contgua= ?";
            $sql = "UPDATE tbl_contgua SET  LetterDate= ?, BLNo= ?, VesselName= ?, VoyageNo= ?, ContainerNo= ?, Consignee= ?, Forwarder= ?, ShippingLine= ?, Encodedby= ?, EncodedDateBLNo= ? WHERE id_contgua= ?";

            $q = $pdo->prepare($sql);

            $q->execute(array($LetterDate, $BLNo, $VesselName, $VoyageNo, $ContainerNo, $Consignee, $Forwarder, $ShippingLine, $Encodedby, $EncodedDateBLNo, $id_contgua));

            $message = 'Congratulations! You have Sucessfully Updated Containers Guarantee Details of '. $ContainerNo . ' with BLNo ' . $BLNo . ' of Shipping Line ' . $ShippingLine;
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'view_contgua.php';\",1000,);</script>";



      //     $sqlcount = "UPDATE tbl_contgua SET BLNo = '.$BLNo.' WHERE id_contgua= '".$id_contgua."'";



        //    foreach ($pdo->query($sqlDep) as $row) {
        Database::disconnect();
      //  header("Location: view_contgua.php");

        }
      } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_contgua where id_contgua = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_contgua));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $message = 'Baho burnik ni Bam Chico! Wahahaa!';
        echo "<script type='text/javascript'> setTimeout(\"location.href = 'update_contgua.php'&id_contgua='.$id_contgua.';\",1000,);</script>";

    //    $id_contgua = $data['id_contgua'];
    $LetterDate = $data['LetterDate'];
    $BLNo = $data['BLNo'];
    $VesselName = $data['VesselName'];
    $VoyageNo = $data['VoyageNo'];
    $ContainerNo = $data['ContainerNo'];
    $Consignee = $data['Consignee'];
    $Forwarder = $data['Forwarder'];
    $ShippingLine = $data['ShippingLine'];
    $Encodedby = $_SESSION['u_uid'];
    $EncodedDateBLNo = $data['EncodedDateBLNo'];

        Database::disconnect();
        }

?>








<html lang="en">
<head>

<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<meta charset="utf-8">
<link   href="../css/bootstrap.min.css" rel="stylesheet">
<script src="../js/bootstrap.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <style>
        { margin: 0; padding: 0; }

        #bgimage {
            background-position: left top;
            background: url('img/background-trans.jpg')no-repeat center center fixed;;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        #form-transparent
        {
        background-color: transparent;
        }
        #body-background {
            background-color: #dfe3ee;
        }
        #div-background {
            background-color: #ffffff;
        }

    </style>
</head>

<body id="body-background">
  <br><br>   <br><br>
    <div  class="container">


                <div class="span10 offset1">

                    <div class="row">
                       <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Containers Guarantee</h3>
                    </div>
                    <br><br>
                    <form class="form-horizontal" action="update_contgua.php?id_contgua=<?php echo $id_contgua?>" method="post">

                      <div class="control-group <?php echo !empty($ShippingLineError)?'error':'';?>">
                        <label class="control-label">Shipping Line</label>
                        <div class="controls">
                          <?php
                      //Combo box of ShippingLine db connection

                      $pdo = Database::connect();
                      $smt_ShippingLine = $pdo->prepare('SELECT ShippingLine From tbl_shippingline');
                      $smt_ShippingLine->execute();
                      $data_ShippingLine = $smt_ShippingLine->fetchAll();
                      ?>

                    <!- Select of ShippingLine ->
                        <SELECT name="ShippingLine" type="text" placeholder="ShippingLine" value="<?php echo !empty($ShippingLine)?$ShippingLine:'';?>">
                            <option value="<?php echo $ShippingLine;?>" selected><?php echo $ShippingLine;?></option>
                            <?php
                            //Combo box  of ShippingLine
                            foreach ($data_ShippingLine as $row): ?>
                              <option><?=$row["ShippingLine"]?></option>
                            <?php endforeach ?>
                            // end of combo box of ShippingLine
                          </SELECT>
                        <?php if (!empty($ShippingLineError)): ?>
                            <span class="help-inline"><?php echo $ShippingLineError;?></span>
                        <?php endif;?>
                    </div>
                    </div>


                    <div class="control-group <?php echo !empty($ForwarderError)?'error':'';?>">
                      <label class="control-label">Forwarder</label>
                      <div class="controls">

                    <?php
//Combo box of Consignee db connection

                    $pdo = Database::connect();
                    $smt_forwarder = $pdo->prepare('SELECT Forwarder From tbl_forwarder');
                    $smt_forwarder->execute();
                    $data_forwarder = $smt_forwarder->fetchAll();
                    ?>

<!- Select of Forwarder ->
                      <SELECT name="Forwarder" type="text"  placeholder="Forwarder" value="<?php echo !empty($Forwarder)?$Forwarder:'';?>">
                          <option value="<?php echo $Forwarder;?>" selected><?php echo $Forwarder;?></option>

                      <?php //Combo box  of Forwarder
                      foreach ($data_forwarder as $row): ?>
                        <option><?=$row["Forwarder"]?></option>
                      <?php endforeach;
                      Database::disconnect();
                      ?>
                  </SELECT>
                  <?php if (!empty($ForwarderError)): ?>
                      <span class="help-inline"><?php echo $ForwarderError;?></span>
                  <?php endif;?>
                  </div>
                </div>





                <div class="control-group <?php echo !empty($ConsigneeError)?'error':'';?>">
                  <label class="control-label">Consignee</label>
                  <div class="controls">
                    <?php
//Combo box of Consignee db connection

                    $pdo = Database::connect();
                    $smt_Consignee = $pdo->prepare('SELECT Consignee From tbl_consignee');
                    $smt_Consignee->execute();
                    $data_Consignee = $smt_Consignee->fetchAll();
                    ?>

<!- Select of Consignee ->
                      <SELECT name="Consignee" type="text" placeholder="Consignee" value="<?php echo !empty($Consignee)?$Consignee:'';?>">
                          <option value="<?php echo $Consignee;?>" selected><?php echo $Consignee;?></option>
                          <?php
                          //Combo box  of Consignee
                          foreach ($data_Consignee as $row): ?>
                            <option><?=$row["Consignee"]?></option>
                          <?php endforeach;
                          Database::disconnect(); ?>

                        </SELECT>
                      <?php if (!empty($ConsigneeError)): ?>
                          <span class="help-inline"><?php echo $ConsigneeError;?></span>
                      <?php endif;

                      ?>
                  </div>
                </div>


                          <div class="control-group <?php echo !empty($LetterDateError)?'error':'';?>">
                            <label class="control-label">LetterDate</label>
                            <div class="controls">
                                <input id='textSLcode' style="background-color: #ffff99;  " name="LetterDate" type="date"  placeholder="" value="<?php echo !empty($LetterDate)?$LetterDate:'';?>">
                                <?php if (!empty($LetterDateError)): ?>
                                    <span class="help-inline"><?php echo $LetterDateError;?></span>
                                <?php endif; ?>
                            </div>

                          </div>




                          <div class="control-group <?php echo !empty($BLNoError)?'error':'';?>">
                            <label class="control-label">BLNo</label>
                            <div class="controls">
                                <input id='textSLcode' style="background-color: #ffff99;  " name="BLNo" type="text"  placeholder="Enter BLNo" value="<?php echo !empty($BLNo)?$BLNo:'';?>">
                                <?php if (!empty($BLNoError)): ?>
                                    <span class="help-inline"><?php echo $BLNoError;?></span>
                                <?php endif; ?>
                            </div>

                          </div>

                      <!-             New Codes here                ->

                      <div class="control-group <?php echo !empty($VesselNameError)?'error':'';?>">
                      <label class="control-label">VesselName</label>
                      <div class="controls">
                      <input id='textSLcode' style="background-color: #ffff99;  " name="VesselName" type="text"  placeholder="Enter VesselName" value="<?php echo !empty($VesselName)?$VesselName:'';?>">
                      <?php if (!empty($VesselNameError)): ?>
                      <span class="help-inline"><?php echo $VesselNameError;?></span>
                      <?php endif; ?>
                      </div>

                      </div>

                      <div class="control-group <?php echo !empty($VoyageNoError)?'error':'';?>">
                      <label class="control-label">VoyageNo</label>
                      <div class="controls">
                      <input id='textSLcode' style="background-color:#ffff99;" name="VoyageNo" type="text"  placeholder="Enter VoyageNo" value="<?php echo !empty($VoyageNo)?$VoyageNo:'';?>">
                      <?php if (!empty($VoyageNoError)): ?>
                      <span class="help-inline"><?php echo $VoyageNoError;?></span>
                      <?php endif; ?>
                      </div>

                      </div>


                      <div class="control-group <?php echo !empty($ContainerNoError)?'error':'';?>">
                      <label class="control-label">ContainerNo/s</label>
                      <div class="controls">
                      <input id='textSLcode' style="background-color:#ffff99;" name="ContainerNo" type="text"  placeholder="Enter ContainerNo" value="<?php echo !empty($ContainerNo)?$ContainerNo:'';?>">
                      <?php if (!empty($ContainerNoError)): ?>
                      <span class="help-inline"><?php echo $ContainerNoError;?></span>
                      <?php endif; ?>
                      </div>

                      </div>


                      <!-         End of New Codes here                ->



                                  <div class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                                    <label class="control-label">Encoded by</label>
                                    <div class="controls">
                                        <input Readonly  name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                                        <?php if (!empty($EncodedbyError)): ?>
                                            <span class="help-inline"><?php echo $EncodedbyError;?></span>
                                        <?php endif;?>
                                    </div>
                                  </div>

                                  <div class="control-group <?php echo !empty($EncodedDateBLNoError)?'error':'';?>">
                                    <label class="control-label">EncodedDateBLNo</label>
                                    <div class="controls">
                                        <input Readonly name="EncodedDateBLNo" type="date"  value="<?php
                                        $currentDateTime = date('Y-m-d');
                                        echo $currentDateTime;
                                        ?>">
                                        <?php if (!empty($EncodedDateBLNoError)): ?>
                                            <span class="help-inline"><?php echo $EncodedDateBLNoError;?></span>
                                        <?php endif;?>

                                    </div>
                                  </div>


                      <div id="form-transparent" class="form-actions">

<?php
                        	if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                        }else{
                          echo '<button type="submit" class="btn btn-success">Update</button>';
                        }
?>



                          <a class="btn" href="view_contgua.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
