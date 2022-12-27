

<?php
include_once 'header.php';
//include_once "welcome.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id_Deposit = null;
if ( !empty($_GET['id_Deposit'])) {
    $id_Deposit = $_REQUEST['id_Deposit'];
}else {
$id_Deposit = $_SESSION['id_Deposit'];
}

$id_contreq = null;
if ( !empty($_GET['id_contreq'])) {
    $id_contreq = $_REQUEST['id_contreq'];
}


if(isset($_POST['textBL'])){
  $cr_BLNo = $_POST['textBL'];
  $_SESSION["textBL"] = $cr_BLNo;
}else{
    $cr_BLNo = $_SESSION['textBL'];
}

if (isset($_GET['varContainerNo'])) {
    $varContainerNo = $_REQUEST['varContainerNo'];
    $_SESSION["varContainerNo"] = $varContainerNo;

}






include_once 'logstat.php';
//require 'database.php';



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
  }else{
    $cr_containerNo= $_SESSION['varContainerNo'];
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


if(!empty($_POST['id_Deposit'])){
  $id_Deposit = $_POST['id_Deposit'];
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

    if (empty($cr_containerNo)) {
        $cr_containerNoError = 'Please Enter ContainerNo';
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

    if (empty($id_Deposit)) {
        $id_DepositError = 'No id_Deposit Data!';
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
    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href ='read_deposit.php';\",1500);</script>";
}
       if(isset($_POST['textBL'])){
       //  $cr_BLNo = $_POST['textBL'];
         $cr_BLNo = $_POST['textBL'];
}         $_SESSION["textBL"] = $cr_BLNo;




   //echo $_POST['textBL'];
        }

        Database::disconnect();


//}

/*
else {
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM tbl_contreq WHERE id_contreq = '".$id_contreq."'";
  $q = $pdo->prepare($sql);
  $q->execute(array($id_contreq));
  $data = $q->fetch(PDO::FETCH_ASSOC);

//    $id_BLNo = $data['id_BLNo'];

$cr_BLNo = $data['cr_BLNo'];
$cr_containerNo = $data['cr_containerNo'];
$cr_shippingLine =$data['shippingLine'];
$cr_or = $data['cr_or'];
$cr_fcl = $data['cr_fcl'];
$cr_empty = $data['cr_empty'];
$cr_masterbl = $data['cr_masterbl'];
$cr_contgua =$data['cr_contgua'];
$cr_trucking =$data['cr_trucking'];
$cr_plateno = $data['cr_plateno'];
$cr_driver = $data['cr_driver '];
$cr_Encodedby = $data['cr_Encodedby'];
$cr_EncodedDate = $data['cr_EncodedDate'];

*/











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

{ margin: 0; padding: 0; }



#form-transparent
{
background-color: transparent;
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

<body>
<div class="container">

            <div class="span10 offset1">
                <div class="row"> <CENTER>
                  <br/>

                    <h3>Add Container Requirements</h3></CENTER>
                </div>
<br/>
<div class="gridbl" >
<?php

$pdo = Database::connect();

$sqlDep = "SELECT * FROM tbl_blcreate WHERE BLNo = '" . $cr_BLNo . "'";
foreach ($pdo->query($sqlDep) as $row) {
//cho   '<div></div>';echo '<div></div>';
echo '<label style="display:none" align=right>id ContReq</label> <div style="display:none">' .$id_contreq. '</div>';
echo '<div></div>';echo '<div></div>';echo '<div></div>';echo '<div></div>';
echo '<label align=right>id Deposit</label> <div>' . $id_Deposit . '</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Consignee</label> <div  style=\'background-color:#ffad33\'>' . $row['Consignee'] . '</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Forwarder</label> <div style=\'background-color:lightblue\'>' . $row['Forwarder'] .'</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Bill of Lading No</label> <div>' . $row['BLNo'] . '</div>';
echo '<div></div>';echo '<div></div>';

echo  '<label align=right>Container No</label> <div>'. $_SESSION["varContainerNo"] .'</div>';
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


         <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >


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
                  <div class="control-group <?php // echo !empty($cr_shippingLineError)?'error':'';?>">
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
                                <SELECT style="width: 60px" name="cr_or" type="text"  placeholder="Have O.R.?" value="<?php echo !empty($cr_or)?$cr_or:'';?>">
                                <option selected>Y</option>
                                <option>N</option>
                              </SELECT>  &nbsp;&nbsp;&nbsp;
                                  <?php if (!empty($cr_orError)): ?>
                                      <span class="help-inline"><?php echo $cr_orError;?></span>
                                  <?php endif;
                                  echo 'Do you have O.R.?';
                                  ?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cr_fclError)?'error':'';?>">
                            <label class="control-label">FCL hardcopy?</label>
                            <div class="controls">
                                <SELECT style="width: 60px" name="cr_fcl" type="text"  placeholder="Have Fcl?" value="<?php echo !empty($cr_fcl )?$cr_fcl:'';?>">

                                  <option>Y</option>
                                  <option selected>N</option>
                                  <option>NA</option>
                                </SELECT> &nbsp;&nbsp;&nbsp;
                                  <?php if (!empty($cr_fclError)): ?>
                                      <span class="help-inline"><?php echo $cr_fclError;?></span>
                                  <?php endif;
                                  echo 'Do you have FCL?';
                                  ?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cr_emptyError)?'error':'';?>">
                            <label class="control-label">Empty hardcopy?</label>
                            <div class="controls">
                                <SELECT style="width: 60px" class="date" name="cr_empty" type="text"  placeholder="Have Empty?" value="<?php echo !empty($cr_empty)?$cr_empty:'';?>">

                                  <option>Y</option>
                                  <option selected>N</option>
                                  <option>NA</option>
                                </SELECT>&nbsp;&nbsp;&nbsp;
                                  <?php if (!empty($cr_emptyError)): ?>
                                      <span class="help-inline"><?php echo $cr_emptyError;?></span>
                                  <?php endif;
                                  echo 'Do you have Empty?';
                                  ?>

                            </div>
                          </div>



                      <div class="control-group <?php echo !empty($cr_masterblError)?'error':'';?>">
                          <label class="control-label">Master BL</label>
                          <div class="controls">
                              <SELECT style="width: 60px" name="cr_masterbl" type="text" value="<?php echo !empty($cr_masterbl)?$cr_masterbl:'';?>">


                                <option>Y</option>
                                <option>N</option>
                                <option selected>NA</option>


                              </SELECT>&nbsp;&nbsp;&nbsp;
                                <?php if (!empty($cr_masterblError)): ?>
                                    <span class="help-inline"><?php echo $cr_masterblError;?></span>
                                <?php endif;
                                echo 'Happag and MOL Only!';
                                ?>

                          </div>
                        </div>

                        <div class="control-group <?php echo !empty($cr_contguaError)?'error':'';?>">
                          <label class="control-label">Containers Guarantee</label>
                          <div class="controls">
                              <SELECT style="width: 60px" name="cr_contgua" type="text"  placeholder="Click Here" value="<?php echo !empty($cr_contgua)?$cr_contgua:'';?>">


                                <option>Y</option>
                                <option>N</option>
                                <option selected>NA</option>
                              </SELECT> &nbsp;&nbsp;&nbsp;
                                <?php if (!empty($cr_contguaError)): ?>
                                    <span class="help-inline"><?php echo $cr_contguaError;?> </span>
                                <?php endif;
                                echo 'Ben Lines and TS Lines Only!';
                                ?>
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
                                <option selected>NA</option>
                                <?php
  //Combo box  of Consignee
                              foreach ($data as $row): ?>
                                <option><?=$row["truckingcode"]?></option>
                              <?php endforeach
  // end of combo box of Consignee
                              ?>

                            </SELECT>&nbsp;&nbsp;&nbsp;

                            <?php
                                if (!empty($cr_truckingError)): ?>
                                    <span class="help-inline"><?php echo $cr_truckingError;?></span>
                                <?php
                              endif;
                              echo 'Do you have Trucking Info?';
                              ?>
                          </div>
                        </div>

                        <div class="control-group <?php echo !empty($cr_platenoError)?'error':'';?>">
                          <label class="control-label">Plate No</label>
                          <div class="controls">
                              <input  name="cr_plateno" type="text"  placeholder="Enter Plate No." value="<?php echo !empty($cr_plateno)?$cr_plateno:'';?>">
                              &nbsp;&nbsp;&nbsp;  <?php if (!empty($cr_platenoError)): ?>
                                    <span class="help-inline"><?php echo $cr_platenoError;?></span>
                                <?php endif;
                                echo 'Put NA if no data!';
                                ?>

                          </div>
                        </div>

                        <div class="control-group <?php echo !empty($cr_driverError)?'error':'';?>">
                          <label class="control-label">driver Info</label>
                          <div class="controls">
                              <input name="cr_driver" type="text"  placeholder="Enter drivers Name" value="<?php echo !empty($cr_driver)?$cr_driver:'';?>">
                          &nbsp;&nbsp;&nbsp;      <?php if (!empty($cr_driverError)): ?>
                                    <span class="help-inline"><?php echo $cr_driverError;?></span>
                                <?php endif;
                                echo 'Put NA if no data!';
                                ?>

                          </div>
                        </div>

                        <div type="hidden" class="control-group <?php echo !empty($id_DepositError)?'error':'';?>">

          <div type="hidden" class="controls">
              <input readonly name="id_Deposit" type="hidden"  placeholder="id_deposit" value="<?php echo !empty($id_Deposit)?$id_Deposit:'';?>">
                <?php if (!empty($id_DepositError)): ?>
                    <span class="help-inline"><?php echo $id_DepositError;?></span>
                <?php endif;

                ?>

                          </div>
                        </div>

<!- Point Marker ->

                          <div class="control-group <?php echo !empty($cr_EncodedbyError)?'error':'';?>">
                            <label class="control-label">Encoded by</label>
                            <div class="controls">
                                <input Readonly name="cr_Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                                <?php if (!empty($cr_EncodedbyError)): ?>
                                    <span class="help-inline"><?php echo $cr_EncodedbyError;?></span>
                                <?php endif;?>
                            </div>
                          </div>

                          <div class="control-group <?php echo !empty($cr_EncodedDateError)?'error':'';?>">
                            <label class="control-label">Encoded Date</label>
                            <div class="controls">
                                <input Readonly name="cr_EncodedDate" type="date"  placeholder="Encoded Date" value="<?php
                                $currentDateTime = date('Y-m-d');
                                echo $currentDateTime;
                                ?>">
                                <?php if (!empty($cr_EncodedDateError)): ?>
                                    <span class="help-inline"><?php echo $cr_EncodedDateError;?></span>
                                <?php endif;?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cr_containerNoError)?'error':'';?>">
                            <label class="control-label"></label>
                            <div class="controls">
                              <input type="hidden" name="cr_containerNo" value="<?php echo $cr_containerNo; ?>">
                                <input type="hidden" name="cr_containerNo" id="cr_containerNo" type="text" placeholder="Enter ContainerNo" value="<?php echo !empty($_SESSION["varContainerNo"])?$cr_containerNo:'';?>">
                              <?php if (!empty($cr_containerNoError)): ?>
                                  <span class="help-inline"><?php echo $cr_containerNoError;?></span>
                              <?php endif;?>

                            </div>
                          </div>

                      <div id="form-transparent" class="form-actions">
<?
                        if(isset($_POST['textBL'])){
                        //  $cr_BLNo = $_POST['textBL'];
                          $cr_BLNo = $_POST['textBL'];
                          $_SESSION["textBL"] = $cr_BLNo;

                        //echo $_POST['textBL'];
                        }


                         // $_SESSION["varContainerNo"] = $row('cr_containerNo') ;

                        //echo $_POST['textBL'];



?>

  <a class="btn" href="read_deposit.php?id_Deposit=&id_Deposit&id_contreq=&id_contreq">Back</a>


  <?php
    if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

    }else{
  echo '<button type="submit" class="btn btn-warning">Create</button>';
    }
?>



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
