<?php
include_once 'header.php';
include_once 'logstat.php';


$DepBLNoCD = null;
$id_Deposit = null;
$txtBL = null;






if(isset($_POST['textBL'])){
$DepBLNoCD= $_POST['textBL'];
//$_SESSION["textBL"] = $DepBLNoCD;

}else{
  $DepBLNoCD= $_SESSION['textBL'];
//  echo "textBL Not Set!";
}

//require 'database.php';

if ( !empty($_GET['id_Deposit'])) {
  $id_Deposit = $_REQUEST['id_Deposit'];
}
$id_BLNo = null;
$id_BLNo = $_SESSION['id_BLNo'];



          if ( !empty($_POST)) {
              // keep track validation errors
              $DepBLNoCDError = null;
              $DateOfDepositError = null;
              $ContainerNoError = null;
              $houseblError = null;
              $ReceiptNoError = null;
              $StubNoRefNoError = null;
              $DepAmountError = null;
              $CtrlFormNoError = null;
              $refund_dateError = null;
              $CheqNoError = null;
              $deduction_desc = null;
              $cheq_deduction = null;
              $DepStatusError = null;
              $id_BLNoError = null;
              $EncodedbyError = null;
              $EncodedDateDepositError = null;

              // $DateOfDeposit
              // $ReceiptNo

              // keep track post values


              if(!empty($_POST['DateOfDeposit'])){
                $DateOfDeposit = $_POST['DateOfDeposit'];
              }

              if(!empty($_POST['ContainerNo'])){
              $ContainerNo = $_POST['ContainerNo'];
              $pdo = Database::connect();
          //    $stmt = $pdo->prepare("SELECT * FROM tbl_deposit WHERE ? = ContainerNo AND ? = DepBLNo ");
              $stmt = $pdo->prepare("SELECT * FROM tbl_deposit WHERE DepBLNo=? AND ContainerNo=?");
              $stmt->execute(array($DepBLNoCD, $ContainerNo));
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  if ($stmt->rowCount() > 0) {
                  $valid = false;
                  echo "<script type='text/javascript'>alert(' BLNo with Container No. Already Exist!!'); setTimeout(\"location.href = '\depositmsg.php';\",1000,);</script></script>";
                  Database::disconnect();
                  exit();
                  }




          if(!empty($_POST['housebl'])){
          $housebl = $_POST['housebl'];
          }

          if(!empty($_POST['ReceiptNo'])){
          $ReceiptNo = $_POST['ReceiptNo'];
          }

          if(!empty($_POST['StubNoRefNo'])){
          $StubNoRefNo = $_POST['StubNoRefNo'];
          }

          if(!empty($_POST['DepAmount'])){
          $DepAmount = $_POST['DepAmount'];
          }

          if(!empty($_POST['CtrlFormNo'])){
          $CtrlFormNo = $_POST['CtrlFormNo'];
          }

          if(!empty($_POST['refund_date'])){
          $refund_date = $_POST['refund_date'];
          }

          if(!empty($_POST['CheqNo'])){
          $CheqNo = $_POST['CheqNo'];
          }

          if(!empty($_POST['deduction_desc'])){
          $deduction_desc = $_POST['deduction_desc'];
          }
         if(!empty($_POST['cheq_deduction'])){
          $cheq_deduction = $_POST['cheq_deduction'];
          }

          if(!empty($_POST['DepStatus'])){
          $DepStatus = $_POST['DepStatus'];
          }

          if(!empty($_POST['id_BLNo'])){
          $id_BLNo = $_POST['id_BLNo'];
          }

          if(!empty($_POST['Encodedby'])){
          $Encodedby = $_POST['Encodedby'];
          }

          if(!empty($_POST['EncodedDateDeposit'])){
          $EncodedDateDeposit = $_POST['EncodedDateDeposit'];
          }

// validate input
                $valid = true;



                if (empty($DepBLNo)) {
                    $DepBLNoError = 'Please enter DepBLNo';
    //                $valid = false;
                }

                if (empty($DateOfDeposit)) {
                    $DateOfDepositError = 'Please enter DateOfDeposit';
                    $valid = false;
                }

                if (empty($ContainerNo)) {
                    $ContainerNoError = 'Pls. enter Container No';
                    $valid = false;
                }

                if (empty($housebl)) {
                    $houseblError = 'Pls. enter Container No';
                    $valid = false;
                }

                if (empty($ReceiptNo)) {
                    $ReceiptNoError = 'Please enter ReceiptNo';
                    $valid = false;
                }

                if (empty($StubNoRefNo)) {
                    $StubNoRefNoError = 'Please enter StubNoRefNo';
                    $valid = false;
                }


                if (empty($DepAmount)){
                    $DepAmountError = 'Please enter DepAmount';
                    $valid = false;
                }

                if ($DepAmount < 8000) {
                    $DepAmountError = 'Invalid Deposit Amount';
                    $valid = false;
                }

                if (empty($CtrlFormNo)) {
                    $CtrlFormNoError = 'Please enter CtrlFormNo';
                    $valid = false;
                }

                if (empty($CheqNo)) {
                    $CheqNoError = 'Please enter CheqNo';
                    $valid = false;
                }

                if (empty($deduction_desc)) {
                    $deduction_descError = 'Please enter deduction_desc';
                    $valid = false;
                }

      //          if (empty($cheq_deduction)) {
      //              $cheq_deductionError = 'Please enter cheq_deduction';
        //            $valid = false;
        //        }
                if (empty($refund_date)) {
                  $refund_date=null;

                }
                if (empty($DepStatus)) {
                    $DepStatusError = 'Please enter DepStatus';
                    $valid = false;
                }

                if (empty($id_BLNo)) {
                    $id_BLNoError = 'Please enter id_BLNo';
                //    $valid = false;
                }

                if (empty($Encodedby)) {
                    $EncodedbyError = 'Please enter Encodedby';
                    $valid = false;
                }

                if (empty($EncodedDateDeposit)) {
                    $EncodedDateDepositError = 'Please enter Encoded Date';
                    $valid = false;
                }



    // insert data




    if ($valid) {
    //    $GlobalBLNo = $_POST['textBL'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_deposit";
        $sql = "INSERT INTO tbl_deposit(DepBLNo,DateOfDeposit,ContainerNo, housebl, ReceiptNo,StubNoRefNo,DepAmount,CtrlFormNo,refund_date,CheqNo,deduction_desc,cheq_deduction,DepStatus,id_BLNo,Encodedby,EncodedDateDeposit) values(? ,? , ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($DepBLNoCD,$DateOfDeposit,$ContainerNo,$housebl,$ReceiptNo,$StubNoRefNo,$DepAmount,$CtrlFormNo,$refund_date,$CheqNo,$deduction_desc,$cheq_deduction,$DepStatus,$id_BLNo,$Encodedby,$EncodedDateDeposit));
  // Set Messagebox and delay before redirecting to next page using javascript//
        $message = 'Congratulations! Container No. '. $ContainerNo .' Sucessfully Created!';
        echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\depositmsg.php';\",1000,);</script>";
        Database::disconnect();

      }

    }
  }


?>

<!-- After PHP Code -->

<!DOCTYPE html>


<html lang="en">
<head>

  <!-- HTML meta refresh URL redirection -->


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
//-->


// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
    // When someone clicks on a close button
    close[i].onclick = function(){

        // Get the parent of <span class="closebtn"> (<div class="alert">)
        var div = this.parentElement;

        // Set the opacity of div to 0 (transparent)
        div.style.opacity = "0";

        // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}

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


#inputbackcolor {


    background-color: #3CBC8D;
    color: white;

}

#inputbackcolor2 {


    background-color: #99b9ff;
    color: white;

}




    { margin: 0; padding: 0; }



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

<body id="body-background" onload="LoadOnce()">

<div id="div-background" class="container">

            <div class="span8 offset1">
                <div class="row"> <CENTER>


                    <h3>Create Container Deposit Entry</h3></CENTER>
                </div>
                <br/>

<div class="gridbl" >
<?php include "blinfo.php"; ?>
</div>

         <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >



                  <div class="control-group <?php// echo !empty($DepBLNoCDError)?'error':'';?>">
                    <label  class="control-label">DepBLNo</label>

                    <div class="controls">
                    <?


                    ?>
                        <input Readonly name="DepBLNo" type="text"  placeholder="Enter DepBLNo" value="<?php  echo !empty($DepBLNoCD)?$DepBLNoCD:'';?>">
                        <?php// if (!empty($DepBLNoCDError)): ?>
                            <span class="help-inline"> </span>
                        <?php  // endif; ?>
                    </div>

                  </div>


                  <div class="control-group <?php echo !empty($DateOfDepositError)?'error':'';?>">
                    <label class="control-label">DateOfDeposit</label>
                    <div class="controls">
                        <input name="DateOfDeposit" id="DateOfDeposit" type="date" placeholder="DateOfDeposit" value="<?php echo !empty($DateOfDeposit)?$DateOfDeposit:'';?>">
                      <?php if (!empty($DateOfDepositError)): ?>
                          <span class="help-inline"><?php echo $DateOfDepositError;?></span>
                      <?php endif;?>

                    </div>
                  </div>


                  <div class="control-group <?php echo !empty($ContainerNoError)?'error':'';?>">
                    <label class="control-label">ContainerNo</label>
                    <div class="controls">
                        <input id="upCase" name="ContainerNo" type="text"  placeholder="ContainerNo" <?php if($row['ShippingLine'] == 'OOCL'){echo 'value=OOLU';}else {echo 'value=""';}?>>
                    <?php if (!empty($ContainerNoError)): ?>
                        <span class="help-inline"><?php echo $ContainerNoError;?></span>
                    <?php endif;?>
                    </div>
                  </div>

                  <div class="control-group <?php echo !empty($houseblError)?'error':'';?>">
                      <label class="control-label">house bl</label>
                      <div class="controls">
                          <input id="upCase" name="housebl" type="text"  placeholder="NA for Not Forwarder" value="<?php echo !empty($housebl)?$housebl:'';?>">
                          <?php if (!empty($houseblError)): ?>
                              <span class="help-inline"><?php echo $houseblError;?></span>
                          <?php endif;?>
                      </div>
                    </div>

                          <div class="control-group <?php echo !empty($ReceiptNoError)?'error':'';?>">
                            <label class="control-label">ReceiptNo</label>
                            <div class="controls">
                                <input id="upCase"  name="ReceiptNo" type="text"  placeholder="ReceiptNo" <?php if($row['ShippingLine'] == 'APL'){echo 'value=APC-MNL-';} elseif($row['ShippingLine'] == 'YANG MING'){echo 'value=MNL/CDEP/';} elseif($row['ShippingLine'] == 'HYUNDAI'){echo 'value=HPH';} elseif($row['ShippingLine'] == 'ONE'){echo 'value=RECMNLBB';} else {echo '""';}?>
                                <?php echo !empty($ReceiptNo)?$ReceiptNo:'';?>">
                                  <?php if (!empty($ReceiptNoError)): ?>
                                      <span class="help-inline"><?php echo $ReceiptNoError;?></span>
                                  <?php endif;?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($StubNoRefNoError)?'error':'';?>">
                            <label class="control-label">StubNo/Invoice No</label>
                            <div class="controls">
                                <input id="upCase"  name="StubNoRefNo" type="text"  placeholder="StubNoRefNo" value="<?php if ($row['ShippingLine'] == 'APL'){echo 'MNL';}echo !empty($StubNoRefNo )?$StubNoRefNo:'';?>">
                                  <?php if (!empty($StubNoRefNoError)): ?>
                                      <span class="help-inline"><?php echo $StubNoRefNoError;?></span>
                                  <?php endif;?>
                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($DepAmountError)?'error':'';?>">
                            <label class="control-label">Deposit Amount</label>
                            <div class="controls">

                                <input class="inputNumberDot" maxlength="7" name="DepAmount" type="text"  placeholder="DepAmount" value="<?php echo !empty($DepAmount)?$DepAmount:'';?>">
                                  <?php if (!empty($DepAmountError)): ?>
                                      <span class="help-inline"><?php echo $DepAmountError;?></span>
                                  <?php endif;?>

                            </div>
                          </div>

                          <div class="control-group <?php echo !empty($CtrlFormNoError)?'error':'';?>">
                            <label class="control-label">CtrlFormNo</label>
                            <div class="controls">

                                <input id="upCase" style="background-color: #99b9ff;"  maxlength="22" name="CtrlFormNo" type="text"  placeholder="NA for No CtrlFormNo" value="<?php if($row['Consignee'] == 'sample'){echo 'SPL-';} elseif($row['Consignee'] == 'MEATPLUS') {echo 'MPL-';} else {echo "";} ?>" >
                                  <?php if (!empty($CtrlFormNoError)): ?>
                                      <span class="help-inline"><?php echo $CtrlFormNoError;?></span>
                                  <?php endif;?> (Consignee)-YRMONTHDAY-SL(EMP)-NO

                            </div>
                          </div>
<!- Refund Date  ->
                          <div class="control-group <?php echo !empty($refund_dateError)?'error':'';?>">
                            <label class="control-label">Refund/Claim Date</label>
                            <div class="controls">

                                <input style="background-color: yellow;" name="refund_date" type="date" value="<?php echo !empty($refund_date)?$refund_date:'';?>">
                                  <?php if (!empty($refund_dateError)): ?>
                                      <span class="help-inline"><?php echo $refund_dateError;?></span>
                                  <?php endif;?>

                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($CheqNoError)?'error':'';?>">
                            <label class="control-label">CheqNo</label>
                            <div class="controls">

                                <input id="upCase" style="background-color: #99b9ff;"  maxlength="20" name="CheqNo" type="text"  placeholder="NA for No CheqNo" value="<?php echo !empty($CheqNo)?$CheqNo:'';?>">
                                  <?php if (!empty($CheqNoError)): ?>
                                      <span class="help-inline"><?php echo $CheqNoError;?></span>
                                  <?php endif;?>

                            </div>
                          </div>



                          <div class="control-group <?php echo !empty($deduction_descError)?'error':'';?>">
                                                      <label class="control-label">Deduction Description</label>
                                                      <div class="controls">
                            <input id="inputbackcolor" maxlength="25" name="deduction_desc" type="text"  placeholder="NA for No deduction" value="<?php echo !empty($deduction_desc)?$deduction_desc:'';
                            ?>">
                              <?php if (!empty($deduction_descError)): ?>
                                  <span class="help-inline"><?php echo $deduction_descError;?></span>
                              <?php endif;?>

                            </div>
                          </div>


                          <div class="control-group <?php echo !empty($cheq_deductionError)?'error':'';?>">
                                                      <label class="control-label">Cheq Deduction</label>
                                                      <div class="controls">
                            <input class="inputNumberDot" id="inputbackcolor" maxlength="25" name="cheq_deduction" type="text"  placeholder="leave empty if no deduction" value="<?php echo !empty($cheq_deduction)?$cheq_deduction:'';
                            ?>">
                              <?php if (!empty($cheq_deductionError)): ?>
                                  <span class="help-inline"><?php echo $cheq_deductionError;?></span>
                              <?php endif;?>

                            </div>
                          </div>
<!- DepStatus Select ->

                          <?php
                          //Combo box of depstatus db connection

                          $pdo = Database::connect();
                          $smt_depstatus = $pdo->prepare('SELECT depstatus From tbl_depstatus ORDER BY DepStatus ASC');
                          $smt_depstatus->execute();
                          $data_depstatus = $smt_depstatus->fetchAll();

                          ?>
                          <div class="control-group <?php echo !empty($DepStatusError)?'error':'';?>">
                                                      <label class="control-label">DepStatus</label>
                                                      <div class="controls">
                            <SELECT name="DepStatus" type="text"  placeholder="Enter Deposit Status" value="<?php echo !empty($DepStatus)?$DepStatus:''; ?>">
                              <?php
                          //Combo box  of ShippingLine
                                foreach ($data_depstatus as $row): ?>
                                  <option style="display:none"></option>
                                  <option><?=$row["depstatus"]?></option>
                                <?php endforeach

                          // end of combo box of ShippingLine
                                                            ?>

                                  </SELECT>

                              <?php if (!empty($DepStatusError)): ?>
                                  <span class="help-inline"><?php echo $DepStatusError;?></span>
                              <?php endif;?>
  </div>
                          </div>

                          <div style="display: none;" class="control-group <?php echo !empty($id_BLNoError)?'error':'';?>">
                            <label class="control-label">id_BLNo</label>
                            <div style="display: none;" class="controls">
                                <input style="display: none;" readonly name="id_BLNo" type="text"  placeholder="id_BLNo" value="<?php echo !empty($id_BLNo)?$id_BLNo:'';?>">
                                <?php if (!empty($id_BLNoError)): ?>
                                    <span class="help-inline"><?php echo $id_BLNoError;?></span>
                                <?php endif;?>
                            </div>
                          </div>

                          <div class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                            <label class="control-label">Encoded by</label>
                            <div class="controls">
                                <input Readonly id="upCase"  name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                                <?php if (!empty($EncodedbyError)): ?>
                                    <span class="help-inline"><?php echo $EncodedbyError;?></span>
                                <?php endif;?>
                            </div>
                          </div>

                          <div class="control-group <?php echo !empty($EncodedDateDepositError)?'error':'';?>">
                            <label class="control-label">EncodedDateDeposit</label>
                            <div class="controls">
                                <input Readonly name="EncodedDateDeposit" type="date" value="<?php $currentDateTime = date('Y-m-d');echo $currentDateTime; ?>">
                                <?php if (!empty($EncodedDateDepositError)): ?>
                                    <span class="help-inline"><?php echo $EncodedDateDepositError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                      <div id="form-transparent" class="form-actions">
<?php
                        if(isset($_POST['textBL'])){
                        //  $DepBLNoCD= $_POST['textBL'];
                          $DepBLNoCD= $_POST['textBL'];
                          $_SESSION["textBL"] = $DepBLNoCD;
                        //echo $_POST['textBL'];
                        }

                        if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){


                          }else{
                            echo '<button type="submit" class="btn btn-success">Save</button>';
                          }


?>
                      <a class="btn" href="ViewDeposit.php">Back</a>
                      <a id="modal" class="btn" href="createdeposit.php">Refresh</a>





                    </div>
                </form>
            </div>

</div> <!-- /container -->
<script src="js/number-divider.min.js"></script>
<script>
$(document).ready(function() {
  $('.inputNumberDot').keypress(function(event) {
    return isNumber(event, this)
  });
});

function isNumber(evt, element) {

  var charCode = (evt.which) ? evt.which : event.keyCode

  if (
    (charCode != 45 || $(element).val().indexOf('-') != -1) && // “-” CHECK MINUS, AND ONLY ONE.
    (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
    (charCode < 48 || charCode > 57))
    return false;

  return true;
}


</script>





</body>

</html>
