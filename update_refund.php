<?php

include_once 'header.php';
include_once 'logstat.php';

?>


<!DOCTYPE html>


<?php


 // include 'database.php';







//    echo 'id_BLNo: ' . $id_BLNo;

//$_POST['id_BLNo'] = $id_BLNo;
//$id_BLNo = $_SESSION['id_BLNo'];







   if ( !empty($_POST)) {
        // keep track validation errors

        $StubNoRefNoError = null;
        $CtrlFormNoError = null;
        $refund_dateError = null;
        $DepStatusError = null;
        $CheqNoError = null;

        $StubNoRefNo = $_POST['StubNoRefNo'];
        $CtrlFormNo = $_POST['CtrlFormNo'];
        $refund_date = $_POST['refund_date'];
        $DepStatus = $_POST['DepStatus'];
        $CheqNo= $_POST['CheqNo'];

        $valid = true;

        if (empty($StubNoRefNo)) {
            $StubNoRefNotNoError = 'Please enter StubNoRefNo';
            $valid = false;
        }

        if (empty($CtrlFormNo)) {
            $CtrlFormNoError = 'Please enter CtrlFormNo';
            $valid = false;
        }

        if (empty($DepStatus)) {
            $DepStatusError = 'Please enter DepStatus';
            $valid = false;
        }

        if (empty($CheqNo)) {
            $CheqNoError = 'Please enter CheqNo';
            $valid = false;
        }
        // update data

            if (empty($StubNoRefNo)){
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "UPDATE tbl_deposit
              SET refund_date = :refund_date, DepStatus = :DepStatus, CheqNo = :CheqNo
              WHERE CtrlFormNo= :CtrlFormNo";
              try{
                  $query = $pdo->prepare($sql);
                  $result = $query->execute(array(':refund_date' => $refund_date, ':DepStatus' => $DepStatus, ':CtrlFormNo' => $CtrlFormNo, ':CheqNo' => $CheqNo));
                }

            catch(PDOException $exception){
               return $exception->getMessage();
            }
            $message = 'Congratulations! You have Sucessfully Updated All Containers Refund Info under CtrlFormNo '. $CtrlFormNo;
            echo "<script type='text/javascript'>alert(' $message '); </script>";
            Database::disconnect();
          }
            else {

              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "UPDATE tbl_deposit
              SET StubNoRefNo = :StubNoRefNo, refund_date = :refund_date, DepStatus = :DepStatus, CheqNo = :CheqNo
              WHERE CtrlFormNo= :CtrlFormNo";
              try{
                  $query = $pdo->prepare($sql);
                  $result = $query->execute(array(':StubNoRefNo' => $StubNoRefNo, ':refund_date' => $refund_date, ':DepStatus' => $DepStatus, ':CtrlFormNo' => $CtrlFormNo, ':CheqNo' => $CheqNo));
                }
                catch(PDOException $exception){
                   return $exception->getMessage();
                }
                $message = 'Congratulations! You have Sucessfully Updated All Containers Refund Info under CtrlFormNo '. $CtrlFormNo;
                echo "<script type='text/javascript'>alert(' $message '); </script>";
                Database::disconnect();
            }












}

    //    $id_Deposit = $data['id_Deposit'];



        Database::disconnect();




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
                         <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Update Container Refund Details</h3>
                          <br/>
                    </div>
                    <form class="form-horizontal" action="update_refund.php" method="post">




<p> -------------------------------------------------------------------------------------------------------------</p>
                                          <div class="control-group ">
                                                                  <label class="control-label">StubNo/Invoice No</label>
                                                                  <div class="controls">
                                                                      <input   name="StubNoRefNo" type="text"  placeholder="No for no Reference No" value="<?php echo !empty($StubNoRefNo)?$StubNoRefNo:'';?>">
                                                                  </div>
                                                                </div>

                            <div class="control-group <?php echo !empty($CtrlFormNoError)?'error':'';?>">
                                                      <label class="control-label">CtrlFormNo</label>
                                                      <div class="controls">
                                                          <input id="inputbackcolor2" maxlength = "22" name="CtrlFormNo" type="text"  placeholder="NA for No CtrlNo" value="<?php echo !empty($CtrlFormNo)?$CtrlFormNo:'';?>">
                                                          <?php if (!empty($CtrlFormNoError)): ?>
                                                              <span class="help-inline"><?php echo $CtrlFormNoError;?></span>
                                                          <?php endif;?><label>YRMONTHDAY(Consignee)-SL(TIN/DON)-NO</label>
                                                      </div>
                                                    </div>

<!- Refund Date  ->
                          <div class="control-group">
                            <label class="control-label">Refund/Claim Date</label>
                            <div class="controls">

                                <input style="background-color: yellow;" name="refund_date" type="date" value="<?php echo !empty($refund_date)?$refund_date:'';?>">


                            </div>
                          </div>




                          <div class="control-group <?php echo !empty($DepStatusError)?'error':'';?>">
                                                      <label class="control-label">DepStatus</label>
                                                      <div class="controls">
                            <SELECT name="DepStatus" type="text"  placeholder="Enter Deposit Status" value="<?php echo !empty($DepStatus)?$DepStatus:'';?>">
                              <option selected>FOR REFUND FOLLOW UP</option>
                                <option>CHEQ STALLED</option>
                                <option>SENT FOR REFUND</option>
                                <option>REFUNDED</option>
                                <option>FOR EMAIL</option>
                                <option>EMAILED</option>



                            </SELECT>

                              <?php if (!empty($DepStatusError)): ?>
                                  <span class="help-inline"><?php echo $DepStatusError;?></span>
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



<p> -------------------------------------------------------------------------------------------------------------</p>




                      <div id="form-transparent" class="form-actions span=4" >
                        <?php
                          if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                          }else{
                          echo '<button type="submit" class="btn btn-success">Save Changes</button>';
                          }
                        ?>
                          <a class="btn" href="ViewAllDepositJoin.php">Back</a>
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
