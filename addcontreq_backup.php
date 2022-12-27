<?php
session_start();

$id_Deposit = null;
if ( !empty($_GET['id_Deposit'])) {
    $id_Deposit = $_REQUEST['id_Deposit'];
}else {
$id_Deposit = $_SESSION['id_Deposit'];
}

$id_contreq = null;
$id_contreq = $_SESSION['id_contreq'];

if(isset($_POST['textBL'])){
  $cr_BLNo = $_POST['textBL'];
  $_SESSION["textBL"] = $cr_BLNo;
}else{
    $cr_BLNo = $_SESSION['textBL'];
}

    if (isset($_POST['txtContainerNo'])) {
        $txtContainerNo = $_POST['txtContainerNo'];
        $_SESSION["txtContainerNo"] = $txtContainerNo;
      //  echo "Container No:" . $txtContainerNo;
      }else{
        $cr_containerNo= $_SESSION['txtContainerNo'];

      }

    include_once 'logstat.php';
    require 'database.php';
    $valid = null;


      if ( !empty($_POST)){
          // keep track validation errors
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
          $id_Deposit = null;
          $cr_EncodedbyError = null;
          $cr_EncodedDateError = null;

            // keep track post values
            if (!empty($_POST['cr_BLNo'])){
            $cr_BLNo = $_POST['textBL'];

            }

            if(!empty($_POST['$cr_containerNo'])){
              $cr_containerNo= $_POST['cr_containerNo'];
            }
            else{
              $cr_containerNo= $_SESSION['txtContainerNo'];
            }


              if(!empty($_POST['cr_shippingLine'])){
              $cr_shippingLine = $_POST['cr_shippingLine'];
            }

              if(!empty($_POST['cr_or'])){
              $cr_or = $_POST['cr_or'];
            }

              if(!empty($_POST['cr_fcl'])){
              $cr_fcl = $_POST['cr_fcl'];
            }

              if(!empty($_POST['cr_empty'])){
              $cr_empty = $_POST['cr_empty'];
            }

            if(!empty($_POST['cr_masterbl'])){
              $cr_masterbl = $_POST['cr_masterbl'];
            }

            if(!empty($_POST['cr_contgua'])){
              $cr_contgua = $_POST['cr_contgua'];
            }

            if(!empty($_POST['cr_trucking'])){
            $cr_trucking = $_POST['cr_trucking'];
          }

          if(!empty($_POST['cr_plateno'])){
            $cr_plateno = $_POST['cr_plateno'];
          }

          if(!empty($_POST['cr_driver'])){
            $cr_driver = $_POST['cr_driver'];
          }




          if(!empty($_POST['cr_Encodedby'])){
          $cr_Encodedby = $_POST['cr_Encodedby'];
          }

          if(!empty($_POST['cr_EncodedDate'])){
          $cr_EncodedDate = $_POST['cr_EncodedDate'];
          }

          // validate input
          $valid = true;

          if (empty($cr_BLNo)) {
              $cr_BLNoError = 'Please Enter BL No';
              $valid = false;
          }



          if (empty($cr_shippingLine)) {
              $cr_shippingLineError = 'Please Enter ShippingLine';
              $valid = false;
          }

          if (empty($cr_or)) {
              $cr_orError = 'Please Enter O.R. Date';
              $valid = false;
          }

          if (empty($cr_fcl)) {
              $cr_fclError = 'Please Enter FCL Date';
              $valid = false;
          }


          if (empty($cr_empty)) {
              $cr_emptyError = 'Please Enter Empty Date';
              $valid = false;
          }

          if (empty($cr_masterbl)) {
              $cr_masterblError = 'Master BL Copy is ';
              $valid = false;
          }

          if (empty($cr_contgua)) {
              $cr_contguaError = 'Cont. Gua. Copy is ';
              $valid = false;
          }

          if (empty($cr_trucking)) {
              $cr_truckingError = 'Please Enter trucking';
              $valid = false;
          }


          if (empty($cr_plateno)) {
              $cr_platenoError = 'Please Enter plateno';
              $valid = false;
          }

          if (empty($cr_driver)) {
              $cr_driverError = 'Please Enter driver';
              $valid = false;
          }



          if (empty($cr_Encodedby)) {
              $cr_EncodedbyError = 'Please Enter Encoded by';
              $valid = false;
          }

          if (empty($cr_EncodedDate)) {
              $cr_EncodedDateError = 'Please Enter Encoded Date';
              $valid = false;
          }


         // check if there is database duplicate before adding new BL No
         // check if there is database duplicate before adding new BL No

         if ($valid) {
          $pdo = Database::connect();
          $stmt = $pdo->prepare("SELECT *  FROM tbl_contreq WHERE cr_BLNo=? AND cr_containerNo=?");
          $stmt->execute(array($cr_BLNo, $cr_containerNo));
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if ($stmt->rowCount() > 0) {
          $valid = false;
          echo "<script type='text/javascript'>alert(' BLNo with Container No. Already Exist!!');
          </script>";
      /*    echo "<script type='text/javascript'>alert(' BLNo with Container No. Already Exist!!');
          setTimeout(\"location.href = '\deposit2msg.php';\",1000,);
          </script>"; */
          $_SESSION["textBL"] = $cr_BLNo;
          Database::disconnect();
          }
  }

}


    // insert data
//if(!isset($valid)){
    if ($valid) {
    //    $GlobalBLNo = $_POST['textBL'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM tbl_contreq WHERE id_contreq = ?";
    //    $txtContainerNo = $row['cr_containerNo'];
        $sql = "INSERT INTO tbl_contreq(cr_BLNo,cr_containerNo,cr_shippingLine,cr_or,cr_fcl,cr_empty,cr_masterbl, cr_contgua, cr_trucking, cr_plateno, cr_driver, id_Deposit,cr_Encodedby,cr_EncodedDate) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($cr_BLNo,$cr_containerNo,$cr_shippingLine,$cr_or,$cr_fcl,$cr_empty,$cr_masterbl,$cr_contgua,$cr_trucking,$cr_plateno,$cr_driver, $id_Deposit, $cr_Encodedby, $cr_EncodedDate));
  // Set Messagebox and delay before redirecting to next page using javascript//
        $message = 'Congratulations! ContainerNo Sucessfully Created!';

      // echo "<script type='text/javascript'>alert(' $message ');
    //   setTimeout(\"location.href = '\deposit2msg.php';\",1000,);</script>";
    $message = 'Container Requirements Sucessfully Added!';
    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href ='read_deposit.php';\",1000);</script>";
}
       if(isset($_POST['textBL'])){
       //  $cr_BLNo = $_POST['textBL'];
         $cr_BLNo = $_POST['textBL'];
         $_SESSION["textBL"] = $cr_BLNo;




   //echo $_POST['textBL'];
        }

        Database::disconnect();
  //      sleep(3);






?>

<!-- After PHP Code -->

<!DOCTYPE html>


<html lang="en">
<head>

<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<meta charset="utf-8">
<link   href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" language="javascript">
      $(document).ready(function(){
        $("input").keyup(function() {
        $(this).val($(this).val().toUpperCase());
        });
        });
</script>



<!-- CSS   -->
<style>
label { text-align:right; }

.gridbl {
display:grid;
grid-template-columns: 1fr 1fr  1fr 1fr;
grid-gap: 1em;
text-align: left;

}


</style>

<script language=" JavaScript" >
<!--
function LoadOnce()
{
  $(function() {
      $('#foo').on('submit', function(e) {
            e.preventDefault();
            setTimeout(function() {
                 window.location.reload();
            },0);
            this.submit();
      });
  });
}



//-->
</script>

</head>

<body >
<div class="container">

            <div class="span10 offset1">
                <div class="row"> <CENTER>
                  <br/><br/>

                    <h3>Update Container Requirements</h3></CENTER>
                </div>
<br/>
<div class="gridbl" >
<?php

$pdo = Database::connect();

$sqlDep = "SELECT * FROM tbl_blcreate WHERE BLNo = '" . $cr_BLNo . "'";
foreach ($pdo->query($sqlDep) as $row) {
//cho   '<div></div>';echo '<div></div>';
if (isset($id_contreq)){
echo '<label align=right>id ContReq</label> <div>' .$id_contreq. '</div>';
}else{
  echo '<label align=right> </label> <div> </div>';
}
echo '<div></div>';echo '<div></div>';
echo '<label align=right>id Deposit</label> <div>' . $id_Deposit . '</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Consignee</label> <div  style=\'background-color:#ffad33\'>' . $row['Consignee'] . '</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Forwarder</label> <div style=\'background-color:lightblue\'>' . $row['Forwarder'] .'</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Bill of Lading No</label> <div>' . $row['BLNo'] . '</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Container No</label> <div>'. $cr_containerNo .'</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Shipping Line</label> <div>'. $row['ShippingLine'] .'</div>';
$txtShippingLine = $row['ShippingLine']; echo '<div></div>';echo '<div></div>';
//echo '<div></div>';echo '<div></div>';
//echo'<br>';
}

$_SESSION['id_contreq'] =  $id_contreq;
$_SESSION['id_Deposit'] =  $id_Deposit;

$sqlShipReq = "SELECT ShipReq FROM tbl_shippingline WHERE ShippingLine  = '" . $txtShippingLine . "'";
foreach ($pdo->query($sqlShipReq) as $row) {
//echo '<div></div>';echo '<div></div>';
echo  '<label align=right>ShippingLine Requirements</label> <div style=\'background-color:lime\'>'. $row['ShipReq'] .'</div>';
echo '<br>';
}

Database::disconnect();


?>

</div>


         <form class="form-horizontal" action="addcontreq.php" method="post" >


                  <div class="control-group <?php //echo !empty($cr_BLNoError)?'error':'';?>">
                    <label style="display: none;" class="control-label">cr_BLNo</label>
                    <div class="controls">
                        <input name="textBL" type="hidden"  placeholder="Enter BLNo" value="<?php echo !empty($cr_BLNo)?$cr_BLNo:'';?>">
                        <input name="cr_BLNo" type="hidden"  placeholder="Enter BLNo" value="<?php echo !empty($cr_BLNo)?$cr_BLNo:'';?>">
                        <?php if (!empty($cr_BLNoError)): ?>
                            <span class="help-inline"><?php echo $cr_BLNoError;?></span>
                        <?php endif; ?>
                    </div>

                  </div>




<center>  <h3> <?php echo $txtShippingLine ?> REQUIREMENTS</h3></center>
                  <div class="control-group <?php  echo !empty($cr_shippingLineError)?'error':'';?>">
                    <label class="control-label"></label>
                    <div class="controls">
                        <input style="display: none;"  name="cr_shippingLine" type="text"  placeholder="Enter Shipping Line" value="<?php echo !empty($txtShippingLine)?$txtShippingLine:'';?>">
                    <?php if (!empty($cr_shippingLineError)): ?>
                      <span class="help-inline"><?php // echo $cr_shippingLineError;?></span>
                    <?php endif;?>
                    </div>
                  </div>

<!- Point Marker SELECT BOXES ->
                          <div class="control-group <?php echo !empty($cr_orError)?'error':'';?>">
                            <label class="control-label">O.R. hardcopy?</label>
                            <div class="controls">
                                <SELECT name="cr_or" type="text"  placeholder="Have O.R.?" value="<?php echo !empty($cr_or)?$cr_or:'';?>">
                                <option value="" Readonly selected>Do you have O.R.?</option>
                                <option>Y</option>
                                <option>N</option>
                                <option>NA</option>
                              </SELECT>
                                  <?php if (!empty($cr_orError)): ?>
                                      <span class="help-inline"><?php echo $cr_orError;?></span>
                                  <?php endif;?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cr_fclError)?'error':'';?>">
                            <label class="control-label">FCL hardcopy?</label>
                            <div class="controls">
                                <SELECT name="cr_fcl" type="text"  placeholder="Have Fcl?" value="<?php echo !empty($cr_fcl )?$cr_fcl:'';?>">

                                  <option>Y</option>
                                  <option>N</option>
                                   <option>NA</option>
                                  <option selected Readonly>Do you have fcl?</option>
                                </SELECT>
                                  <?php if (!empty($cr_fclError)): ?>
                                      <span class="help-inline"><?php echo $cr_fclError;?></span>
                                  <?php endif;?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cr_emptyError)?'error':'';?>">
                            <label class="control-label">Empty hardcopy?</label>
                            <div class="controls">
                                <SELECT class="date" name="cr_empty" type="text"  placeholder="Have Empty?" value="<?php echo !empty($cr_empty)?$cr_empty:'';?>">
                                  <option value="" Readonly selected>Do you have EIR Empty?</option>
                                  <option>Y</option>
                                  <option>N</option>
                                  <option>NA</option>
                                </SELECT>



                                  <?php if (!empty($cr_emptyError)): ?>
                                      <span class="help-inline"><?php echo $cr_emptyError;?></span>
                                  <?php endif;?>

                            </div>
                          </div>



                      <div class="control-group <?php echo !empty($cr_masterblError)?'error':'';?>">
                          <label class="control-label">Master BL</label>
                          <div class="controls">
                              <SELECT name="cr_masterbl" type="text" value="<?php echo !empty($cr_masterbl)?$cr_masterbl:'';?>">
                                <option>Y</option>
                                <option>N</option>
                                 <option>NA</option>
                                <option selected Readonly>Only for Happag Lloyd and Mitsui</option>

                              </SELECT>
                                <?php if (!empty($cr_masterblError)): ?>
                                    <span class="help-inline"><?php echo $cr_masterblError;?></span>
                                <?php endif;?>

                          </div>
                        </div>

                        <div class="control-group <?php echo !empty($cr_contguaError)?'error':'';?>">
                          <label class="control-label">Containers Guarantee</label>
                          <div class="controls">
                              <SELECT  name="cr_contgua" type="text"  placeholder="Click Here" value="<?php echo !empty($cr_contgua)?$cr_contgua:'';?>">


                                <option>Y</option>
                                <option>N</option>
                                <option>NA</option>
                                <option selected Readonly>Only for Ben Lines and TS Lines</option>
                              </SELECT>
                                <?php if (!empty($cr_contguaError)): ?>
                                    <span class="help-inline"><?php echo $cr_contguaError;?></span>
                                <?php endif;?>

                          </div>
                        </div>


                        <?php
                        //Combo box of Consignee db connection
                //        $pdo = Database::connect();
                        $smt = $pdo->prepare('SELECT * From tbl_trucking ORDER BY truckingcode ASC');
                        $smt->execute();
                        $data = $smt->fetchAll();
                        ?>
<!- Select of trucking ->

                        <div class="control-group <?php echo !empty($cr_truckingError)?'error':'';?>">
                          <label class="control-label">trucking Info</label>
                          <div class="controls">
                              <SELECT name="cr_trucking" id="cr_trucking" type="text"  placeholder="Enter trucking Name" value="<?php echo !empty($cr_trucking)?$cr_trucking:'';?>">
                              <option value="" Readonly selected>Choose Trucking Company</option>
                                <option>--No Information--</option>
                                <?php
  //Combo box  of Consignee
                              foreach ($data as $row): ?>
                                <option><?=$row["truckingcode"]?></option>
                              <?php endforeach
  // end of combo box of Consignee
                              ?>

                            </SELECT>

                            <?php
                                if (!empty($cr_truckingError)): ?>
                                    <span class="help-inline"><?php echo $cr_truckingError;?></span>
                                <?php
                              endif; ?>
                          </div>
                        </div>

                        <div class="control-group <?php echo !empty($cr_platenoError)?'error':'';?>">
                          <label class="control-label">Plate No</label>
                          <div class="controls">
                              <input   name="cr_plateno" type="text"  placeholder="NA for no Plate No. " value="<?php echo !empty($cr_plateno)?$cr_plateno:'';?>">
                                <?php if (!empty($cr_platenoError)): ?>
                                    <span class="help-inline"><?php echo $cr_platenoError;?></span>
                                <?php endif;?>

                          </div>
                        </div>

                        <div class="control-group <?php echo !empty($cr_driverError)?'error':'';?>">
                          <label class="control-label">driver Info</label>
                          <div class="controls">
                              <input   name="cr_driver" type="text"  placeholder="NA for no drivers Name" value="<?php echo !empty($cr_driver)?$cr_driver:'';?>">
                                <?php if (!empty($cr_driverError)): ?>
                                    <span class="help-inline"><?php echo $cr_driverError;?></span>
                                <?php endif;?>

                          </div>
                        </div>




              <input readonly  type="hidden"  name="id_Deposit" type="text"  placeholder="Enter drivers Name" value="<?php echo !empty($id_Deposit)?$id_Deposit:'';?>">
                <?php if (!empty($id_DepositError)): ?>
                    <span readonly  type="hidden"  class="help-inline"><?php echo $id_DepositError;?></span>
                <?php endif;?>




<!- Point Marker ->

                          <div class="control-group <?php echo !empty($cr_EncodedbyError)?'error':'';?>">
                            <label class="control-label">Encoded by</label>
                            <div class="controls">
                                <input name="cr_Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($cr_Encodedby)?$cr_Encodedby:'';?>">
                                <?php if (!empty($cr_EncodedbyError)): ?>
                                    <span class="help-inline"><?php echo $cr_EncodedbyError;?></span>
                                <?php endif;?>
                            </div>
                          </div>

                          <div class="control-group <?php echo !empty($EncodedDateError)?'error':'';?>">
                            <label class="control-label">EncodedDate</label>
                            <div class="controls">
                                <input name="EncodedDate" type="date"  value="<?php
                                $currentDateTime = date('Y-m-d');
                                echo $currentDateTime;
                                ?>">
                                <?php if (!empty($EncodedDateError)): ?>
                                    <span class="help-inline"><?php echo $EncodedDateError;?></span>
                                <?php endif;?>

                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cr_containerNoError)?'error':'';?>">
                            <label class="control-label"></label>
                            <div class="controls">
                              <input readonly type="hidden" name="txtContainerNo" value="<?php echo $cr_containerNo; ?>">
                                <input type="hidden" name="cr_containerNo" id="cr_containerNo" type="text" placeholder="Enter ContainerNo" value="<?php echo !empty($cr_containerNo)?$cr_containerNo:'';?>">
                              <?php if (!empty($cr_containerNoError)): ?>
                                  <span class="help-inline"><?php echo $cr_containerNoError;?></span>
                              <?php endif;?>

                            </div>
                          </div>

                      <div class="form-actions">
<?
                        if(isset($_POST['textBL'])){
                        //  $cr_BLNo = $_POST['textBL'];
                          $cr_BLNo = $_POST['textBL'];
                          $_SESSION["textBL"] = $cr_BLNo;

                        //echo $_POST['textBL'];
                        }

                        if(isset($_POST['txtContainerNo'])){
                        //  $cr_BLNo = $_POST['textBL'];
                          $cr_BLNo = $_POST['txtContainerNo'];
                          $_SESSION["txtContainerNo"] = $cr_containerNo;

                        //echo $_POST['textBL'];
                        }


?>


                      <button type="submit" class="btn btn-warning">Update</button>
                      <a class="btn" href="read_deposit.php?id_Deposit=&id_Deposit&id_contreq=&id_contreq&id_BLNo=&id_BLNo">Back</a>
                      <a class="btn" href="addcontreq.php?">Refresh</a>





                    </div>
                </form>
            </div>

</div> <!-- /container -->
<script src="js/number-divider.min.js"></script>
<script>
$('.number').divide({
  delimiter: ','
  });

</script>
<br/><br/><br/><br/><br/>


</body>
</html>
