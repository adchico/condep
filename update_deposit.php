<?php

include_once 'header.php';
include_once 'logstat.php';

?>


<!DOCTYPE html>


<?php
  $id_BLNo = null;
  $id_Deposit = null;

 // include 'database.php';

  if(isset($_SESSION['id_BLNo'])){
    $id_BLNo = $_SESSION['id_BLNo'];
  }


    $id_Deposit = null;
    if ( !empty($_GET['id_Deposit'])) {
        $id_Deposit = $_REQUEST['id_Deposit'];
    }

    if ( null==$id_Deposit) {
        header("Location: ViewDeposit.php");
    }


    $id_BLNo=null;
    if(isset($_SESSION['id_BLNo'])){
      $id_BLNo = $_SESSION['id_BLNo'];
    }

    if ( !empty($_GET['id_BLNo'])) {
        $id_BLNo = $_REQUEST['id_BLNo'];

    }
//    echo 'id_BLNo: ' . $id_BLNo;

//$_POST['id_BLNo'] = $id_BLNo;
//$id_BLNo = $_SESSION['id_BLNo'];







    if ( !empty($_POST)) {
        // keep track validation errors
        $DepBLNoUDError = null;
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

        // keep track post values
        $DepBLNoUD = $_POST['DepBLNo'];
        $DateOfDeposit = $_POST['DateOfDeposit'];
        $ContainerNo = $_POST['ContainerNo'];
        $housebl = $_POST['housebl'];
        $ReceiptNo = $_POST['ReceiptNo'];
        $StubNoRefNo = $_POST['StubNoRefNo'];
        $DepAmount= $_POST['DepAmount'];
        $CtrlFormNo= $_POST['CtrlFormNo'];
        $refund_date= $_POST['refund_date'];
        $CheqNo= $_POST['CheqNo'];
        $deduction_desc = $_POST['deduction_desc'];
        $cheq_deduction = $_POST['cheq_deduction'];
        $DepStatus= $_POST['DepStatus'];
        $id_BLNo= $_POST['id_BLNo'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDateDeposit = $_POST['EncodedDateDeposit'];


        $valid = true;

        if (empty($DepBLNoUD)) {
            $DepBLNoUDError = 'Please enter DepBLNo';
            $valid = false;
        }

        if (empty($DateOfDeposit)) {
            $DateOfDepositError = 'Please enter DateOfDeposit';
            $valid = false;
        }

        if (empty($ContainerNo)) {
            $ContainerNoError = 'Please enter ContainerNo Number';
            $valid = false;
        }

        if (empty($housebl)) {
            $houseblError = 'Please enter Forwarder Number';
            $valid = false;
        }


        if (empty($ReceiptNo)) {
            $ReceiptNoError = 'Please enter ReceiptNo';
            $valid = false;
        }


        if (empty($StubNoRefNo)) {
            $StubNoRefNotNoError = 'Please enter StubNoRefNo';
            $valid = false;
        }

        if (empty($DepAmount)) {
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
/*
        if (empty($cheq_deduction)) {
            $cheq_deductionError = 'Please enter cheq_deduction';
            $valid = false;
        }

*/
        if (empty($DepStatus)) {
            $DepStatusError = 'Please enter DepStatus';
            $valid = false;
        }

        if (empty($id_BLNo)) {
            $id_BLNoError = 'Please enter id_BLNo';
            $valid = false;
        }

        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby';
            $valid = false;
        }

        if (empty($EncodedDateDeposit )) {
            $EncodedDateDepositError = 'Please enter Encoded Date DepBLNo';
            $valid = false;
        }

        // update data



        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tbl_deposit set  DepBLNo = ?, DateOfDeposit = ?, ContainerNo = ?, housebl = ?, ReceiptNo = ?, StubNoRefNo = ?, DepAmount = ?, CtrlFormNo = ?, refund_date= ?,  CheqNo = ?, deduction_desc = ?, cheq_deduction = ?, DepStatus = ?, Encodedby = ?, id_BLNo = ?, EncodedDateDeposit = ? WHERE id_Deposit= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($DepBLNoUD, $DateOfDeposit , $ContainerNo,$housebl ,$ReceiptNo, $StubNoRefNo, $DepAmount,$CtrlFormNo,$refund_date,$CheqNo,$deduction_desc,$cheq_deduction,$DepStatus, $Encodedby, $id_BLNo, $EncodedDateDeposit, $id_Deposit));



            $message = 'Congratulations! You have Sucessfully Updated Container No '. $ContainerNo . ' with BLNo ' . $DepBLNoUD;
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'ViewDeposit.php?id_BLNo=' . $id_BLNo . '&txtBL='.$DepBLNoUD.'';\",1000,);</script>";
            Database::disconnect();

        }
      } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_deposit where id_Deposit = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Deposit));
        $data = $q->fetch(PDO::FETCH_ASSOC);

    //    $id_Deposit = $data['id_Deposit'];
        $id_BLNo = $data['id_BLNo'];
        $DepBLNoUD =  $data['DepBLNo'];
        $DateOfDeposit =  $data['DateOfDeposit'];
        $ContainerNo =  $data['ContainerNo'];
        $housebl = $data['housebl'];
        $ReceiptNo =  $data['ReceiptNo'];
        $StubNoRefNo =  $data['StubNoRefNo'];
        $DepAmount =  $data['DepAmount'];
        $CtrlFormNo =  $data['CtrlFormNo'];
        $refund_date = $data['refund_date'];
        $CheqNo =  $data['CheqNo'];
        $deduction_desc =  $data['deduction_desc'];
        $cheq_deduction =  $data['cheq_deduction'];
        $DepStatus =  $data['DepStatus'];
        $Encodedby = $data['Encodedby'];
        $EncodedDateDeposit =  $data['EncodedDateDeposit'];



        $_SESSION['textBL'] = $DepBLNoUD;

        $_SESSION['id_BLNo'] = $id_BLNo;

        Database::disconnect();
        }



?>





<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
<!--      <script src="jquery.min.js">  </script> -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script src="dist/number-divider.min.js"></script>



     <script type="text/javascript" language="javascript">
           $(document).ready(function(){
             $("input").keyup(function() {
             $(this).val($(this).val().toUpperCase());
             });
             });
     </script>

     <style>


         #body-background {
             background-color: #dfe3ee;
         }
         #div-background {
             background-color: #ffffff;
         }

         #form-transparent
         {
         background-color: transparent;
         }


     #inputbackcolor {
         background-color: #3CBC8D;
         color: white;
     }

     #inputbackcolor2 {
         background-color: #99b9ff;
         color: white;

     }


</style>

</head>

<body id="body-background" >
    <div id="div-background" class="container">


                <div class="span12 offset1">


                    <div class="row">
                         <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Update Container Details</h3>
                          <br/>
                    </div>
                    <form class="form-horizontal" action="update_deposit.php?id_Deposit=<?php echo $id_Deposit?>" method="post">

                       <div class="control-group <?php /* echo !empty($DepBLNoUDError)?'error':''; */?> ">
                        <label class="control-label">DepBLNo </label>

                        <div class="controls">

                            <input style="display: none;" name="DepBLNo" type="text"  placeholder="DepBLNo" value="<?php echo !empty($DepBLNoUD)?$DepBLNoUD:'';?> ">
                              <label><?php echo $DepBLNoUD ?></label>
                          <?php  /*
                            if (!empty($DepBLNoUDError)): ?>
                                <span class="help-inline"><?php echo $DepBLNoUDError;?></span>
                          <?php endif;
                                */
                          ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($DateOfDepositError)?'error':'';?>">
                        <label class="control-label">DateOfDeposit</label>
                        <div class="controls">
                            <input type="date" name="DateOfDeposit" type="text" placeholder="DateOfDeposit" value="<?php echo !empty($DateOfDeposit)?$DateOfDeposit:'';?>">
                            <?php if (!empty($DateOfDepositError)): ?>
                                <span class="help-inline"><?php echo $DateOfDepositError;?></span>
                            <?php endif;?>
                        </div>
                      </div>


                      <div class="control-group <?php echo !empty($ContainerNoError)?'error':'';?>">
                        <label class="control-label">ContainerNo</label>
                        <div class="controls">
                            <input   name="ContainerNo" type="text"  placeholder="ContainerNo" value="<?php echo !empty($ContainerNo)?$ContainerNo:'';?>">
                            <?php if (!empty($ContainerNoError)): ?>
                                <span class="help-inline"><?php echo $ContainerNoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($houseblError)?'error':'';?>">
                          <label class="control-label">House BL</label>
                          <div class="controls">
                              <input   name="housebl" type="text"  placeholder="NA for No housebl"
                              value="<?php echo !empty($housebl)?$housebl:''; ?>">
                              <?php if (!empty($houseblError)): ?>
                                  <span class="help-inline"><?php echo $houseblError;?></span>
                              <?php endif;?>
                          </div>
                        </div>


                      <div class="control-group <?php echo !empty($ReceiptNoError)?'error':'';?>">
                        <label class="control-label">ReceiptNo</label>
                        <div class="controls">
                            <input   name="ReceiptNo" type="text"  placeholder="ReceiptNo" value="<?php echo !empty($ReceiptNo)?$ReceiptNo:'';?>">
                            <?php if (!empty($ReceiptNoError)): ?>
                                <span class="help-inline"><?php echo $ReceiptNoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>






                    <div class="control-group <?php echo !empty($DepAmountError)?'error':'';?>">
                                            <label class="control-label">DepAmount</label>
                                            <div class="controls">
                                                <input class="number" maxlength = "7" name="DepAmount" type="text"  placeholder="DepAmount" value="<?php echo !empty($DepAmount)?$DepAmount:'';?>">

                                                <?php if (!empty($DepAmountError)): ?>
                                                    <span class="help-inline"><?php echo $DepAmountError;?></span>
                                                <?php endif;?>
                                            </div>
                                          </div>


<p> -------------------------------------------------------------------------------------------------------------</p>
                                          <div class="control-group <?php echo !empty($StubNoRefNoError)?'error':'';?>">
                                                                  <label class="control-label">StubNo/Invoice No</label>
                                                                  <div class="controls">
                                                                      <input   name="StubNoRefNo" type="text"  placeholder="No for no Reference No" value="<?php echo !empty($StubNoRefNo)?$StubNoRefNo:'';?>">
                                                                      <?php if (!empty($StubNoRefNoError)): ?>
                                                                          <span class="help-inline"><?php echo $StubNoRefNoError;?></span>
                                                                      <?php endif;?>
                                                                  </div>
                                                                </div>

                            <div class="control-group <?php echo !empty($CtrlFormNoError)?'error':'';?>">
                                                      <label class="control-label">CtrlFormNo</label>
                                                      <div class="controls">
                                                          <input id="inputbackcolor2" maxlength = "22" name="CtrlFormNo" type="text"  placeholder="NA for No CtrlNo" value="<?php echo !empty($CtrlFormNo)?$CtrlFormNo:'';?>">
                                                          <?php if (!empty($CtrlFormNoError)): ?>
                                                              <span class="help-inline"><?php echo $CtrlFormNoError;?></span>
                                                          <?php endif;?><label>(Consignee)-YRMONTHDAY-SL(EMP)-NO</label>
                                                      </div>
                                                    </div>

<!- Refund Date  ->
                          <div class="control-group">
                            <label class="control-label">Refund/Claim Date</label>
                            <div class="controls">

                                <input style="background-color: yellow;" name="refund_date" type="date" value="<?php echo !empty($refund_date)?$refund_date:'';?>">


                            </div>
                          </div>

<p> -------------------------------------------------------------------------------------------------------------</p>

                                                    <div class="control-group <?php echo !empty($CheqNoError)?'error':'';?>">
                                                                                <label class="control-label">CheqNo</label>
                                                                                <div class="controls">
                                                      <input id="inputbackcolor" maxlength="25" name="CheqNo" type="text"  placeholder="NA for no CheqNo" value="<?php echo !empty($CheqNo)?$CheqNo:'';?>">
                                                        <?php if (!empty($CheqNoError)):?>
                                                            <span class="help-inline"><?php echo $CheqNoError;?></span>
                                                        <?php endif;?>

                                                      </div>
                                                    </div>

                                                    <div class="control-group <?php echo !empty($deduction_descError)?'error':'';?>">
                                                                                <label class="control-label">Deduction Description</label>
                                                                                <div class="controls">
                                                      <input id="inputbackcolor" maxlength="25" name="deduction_desc" type="text"  placeholder="NA for No CheckNo" value="<?php echo !empty($deduction_desc)?$deduction_desc:'';
                                                      ?>">
                                                        <?php if (!empty($deduction_descError)): ?>
                                                            <span class="help-inline"><?php echo $deduction_descError;?></span>
                                                        <?php endif;?>

                                                      </div>
                                                    </div>


                                                    <div class="control-group <?php echo !empty($cheq_deductionError)?'error':'';?>">
                                                                                <label class="control-label">Cheq Deduction</label>
                                                                                <div class="controls">
                                                      <input id="inputbackcolor" maxlength="50" name="cheq_deduction" type="text"  placeholder="0" value="<?php echo !empty($cheq_deduction)?$cheq_deduction:'';
                                                      ?>">
                                                        <?php if (!empty($cheq_deductionError)): ?>
                                                            <span class="help-inline"><?php

                                                            echo $cheq_deductionError;?></span>
                                                        <?php endif;?>

                                                      </div>
                                                    </div>

                                                    <?php
                                                    $pdo = Database::connect();
                                                    $smt = $pdo->prepare('SELECT depstatus From tbl_depstatus');
                                                    $smt->execute();
                                                    $data = $smt->fetchAll();
                                                    ?>

                                                    <div class="control-group <?php echo !empty($DepStatusError)?'error':'';?>">
                                                                                <label class="control-label">DepStatus</label>
                                                                                <div class="controls">
                                                      <SELECT name="DepStatus" type="text"  placeholder="Enter Deposit Status" value="<?php echo !empty($DepStatus)?$DepStatus:'';?>">
                                                        <option value="<?php echo $DepStatus;?>" selected><?php echo $DepStatus;?></option>
                                                        <?php foreach ($data as $row): ?>
                                                       <option>  <?=$row["depstatus"]; ?></option>
                                                     <?php  endforeach
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
                            <input readonly style="display: none;" name="id_BLNo" type="text"  placeholder="id_BLNo" value="<?php echo !empty($id_BLNo)?$id_BLNo:'';?>">
                            <?php if (!empty($id_BLNoError)): ?>
                                <span class="help-inline"><?php echo $id_BLNoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group ">
                        <label class="control-label">Encodedby </label>
                        <div class="controls">
                            <input Readonly name="" type="text"  placeholder="Encodedby" value="<?php echo !empty($Encodedby)?$Encodedby: '';?>">

                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">EncodedDateDeposit </label>
                        <div class="controls">
                            <input Readonly name="" type="text"  placeholder="EncodedDateDeposit" value="<?php echo !empty($EncodedDateDeposit)?$EncodedDateDeposit: '';?>">

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

                      <div style="display: none;" class="control-group <?php echo !empty($EncodedDateDepositError)?'error':'';?>">
                        <label class="control-label">EncodedDateDeposit NOW</label>
                        <div class="controls">
                            <input Readonly name="EncodedDateDeposit" type="text"  placeholder="EncodedDateDeposit" value="<?php $currentDateTime = date('Y-m-d');
                            echo $currentDateTime;
                            ?>">
                            <?php if (!empty($EncodedDateDepositError)): ?>
                                <span class="help-inline"><?php echo $EncodedDateDepositError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

<?php

?>
                      <div id="form-transparent" class="form-actions span=4" >
                        <?php
                          if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                          }else{
                          echo '<button type="submit" class="btn btn-success">Save Changes</button>';
                          }

                      echo '<a class="btn" href="ViewDeposit.php?id_BLNo = '. $_SESSION['id_BLNo'].'&textBL='.$_SESSION['textBL'].'">Back</a>'
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


  </body>
</html>
