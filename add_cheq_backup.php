<?php
error_reporting(1);


    require 'database.php';
    require 'uploader.php';
    include_once 'header.php';
    include_once 'logstat.php';




    if ( !empty($_POST)) {
        // keep track validation errors
        $uploader = new Uploader();

        $ShippingLine = null;
        $Consignee = null;
        $cheqno = null;
        $cheqamount = null;
        $cheqdate = null;
        $BankInfo = null;
        $Encodedby = null;
        $EncodedDate = null;
        $imageError = null;


        // keep track post values

        $ShippingLine = $_POST['ShippingLine'];
        $Consignee = $_POST['Consignee'];
        $cheqno = $_POST['cheqno'];
        $cheqamount = $_POST['cheqamount'];
        $cheqdate = $_POST['cheqdate'];
        $BankInfo = $_POST['BankInfo'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

        if (empty($ShippingLine)) {
            $ShippingLineError = 'Please enter ShippingLine';
            $valid = false;
        }
        if (empty($Consignee)) {
            $ConsigneeError = 'Please enter Consignee';
            $valid = false;
        }

        if (empty($cheqno)) {
            $cheqnoError = 'Please enter cheqno Address';
            $valid = false;
        }

        if (empty($cheqamount)) {
            $cheqamountError = 'Please enter cheqamount Number';
            $valid = false;
        }

        if (empty($cheqdate)) {
            $cheqdateError = 'Please enter cheqdate';
            $valid = false;
        }

        if (empty($BankInfo)) {
            $BankInfoError = 'Please enter BankInfo';
            $valid = false;
        }

        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby';
            $valid = false;
        }

        if (empty($EncodedDate)) {
            $cEncodedDateError = 'Please enter cheqamount Number';
        //    $valid = false;

        }






       if (!empty($_FILES['image']['name']) && !$uploader->valid($_FILES['image']))
    {
        $imageError = 'Invalid file uploaded';
        $valid = false;
    }


/* Starts Here */
        if (!empty($cheqno)){
        $pdo = Database::connect();
        //    $stmt = $pdo->prepare("SELECT * FROM tbl_deposit WHERE ? = ContainerNo AND ? = DepBLNo ");
        $stmt = $pdo->prepare("SELECT * FROM tbl_cheq WHERE cheqno=?");
        $stmt->execute(array($cheqno));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
        $valid = false;
        echo "<script type='text/javascript'>alert(' Cheq No Already Exist!!'); setTimeout(\"location.href = '\cheq_msg.php';\",1000,);</script></script>";
        Database::disconnect();
    //    exit();
        }
        }

/* Ends Here */
if (!empty($_FILES['image']['name']) && !$uploader->valid($_FILES['image']))
{
 $imageError = 'Invalid file uploaded';
 $valid = false;
}

        // insert data
  //     if ($valid) {
            $image = $uploader->upload($_FILES['image']);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tbl_cheq(ShippingLine,Consignee, cheqno,cheqamount,cheqdate,BankInfo,image,Encodedby,EncodedDate)values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($ShippingLine,$Consignee,$cheqno,$cheqamount,$cheqdate,$BankInfo,$image, $Encodedby,$EncodedDate));
            // Set Messagebox and delay before redirecting to next page using javascript//
            $message = 'Cheq No.'. $cheqno . ' Sucessfully Created!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href ='view_cheq.php';\",1500);</script>";
            Database::disconnect();
        //    header("Location: viewbl.php");
  //     }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<style>

#inputbackcolor {


    background-color: #3CBC8D;
    color: white;
}

</style>










</head>

<body>
    <div class="container">

                <div class="span12 offset1">
                  <br>
                    <div >
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create a Cheq</h3>
                    </div>
<br>
                    <form class="form-horizontal" action="add_cheq.php" method="post" enctype="multipart/form-data">

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
                            <SELECT name="ShippingLine" type="text"  placeholder="ShippingLine" value="<?php echo !empty($ShippingLine)?$ShippingLine:'';?>">
                              <option Readonly selected>--Select Shipping Line--</option>
                          <?php
//Combo box  of ShippingLine
                            foreach ($data_ShippingLine as $row): ?>
                              <option><?=$row["ShippingLine"]?></option>
                            <?php endforeach;

// end of combo box of ShippingLine
                                                        ?>
                              </SELECT>
                              <?php if (!empty($ShippingLineError)): ?>
                                  <span class="help-inline"><?php echo $ShippingLineError;?></span>
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
                                                  <SELECT name="Consignee" type="text"  placeholder="Consignee" value="<?php echo !empty($Consignee)?$Consignee:'';?>">
                                                    <option Readonly selected>--Select Consignee--</option>
                                                <?php
                      //Combo box  of Consignee
                                                  foreach ($data_Consignee as $row): ?>
                                                    <option><?=$row["Consignee"]?></option>
                                                  <?php endforeach;

                      // end of combo box of Consignee
                                                                              ?>
                                                    </SELECT>
                                                    <?php if (!empty($ConsigneeError)): ?>
                                                        <span class="help-inline"><?php echo $ConsigneeError;?></span>
                                                    <?php endif;?>

                                              </div>
                                            </div>


                      <div class="control-group <?php echo !empty($cheqnoError)?'error':'';?>">
                        <label class="control-label">Cheq No</label>
                        <div class="controls">
                            <input id="inputbackcolor" name="cheqno" type="text" placeholder="cheqno" value="<?php echo !empty($cheqno)?$cheqno:'';?>">
                            <?php if (!empty($cheqnoError)): ?>
                                <span class="help-inline"><?php echo $cheqnoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
<!- Check Amount ->
                      <div class="control-group <?php echo !empty($cheqamountError)?'error':'';?>">
                        <label class="control-label">Cheq Amount</label>
                        <div class="controls">
                            <input id="inputbackcolor" class="inputNumberDot" maxlength="8" name="cheqamount" type="text"  placeholder="cheqamount" value="<?php echo !empty($cheqamount)?$cheqamount:'';?>">
                            <?php if (!empty($cheqamountError)): ?>
                                <span class="help-inline"><?php echo $cheqamountError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($cheqdateError)?'error':'';?>">
                        <label class="control-label">Cheq Date</label>
                        <div class="controls">
                            <input name="cheqdate" type="date"  placeholder="cheqdate" value="<?php echo !empty($cheqdate)?$cheqdate:'';?>">
                            <?php if (!empty($cheqdateError)): ?>
                                <span class="help-inline"><?php echo $cheqdateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($BankInfoError)?'error':'';?>">
                        <label class="control-label">Bank Info</label>
                        <div class="controls">
                            <input name="BankInfo" type="text"  placeholder="BankInfo" value="<?php echo !empty($BankInfo)?$BankInfo:'';?>">
                            <?php if (!empty($BankInfoError)): ?>
                                <span class="help-inline"><?php echo $BankInfoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

<!-image upload code     ->

                      <div class="control-group <?php echo !empty($imageError) ? 'error' : ''; ?>">
                        <label class="control-label">Image</label>
                          <div class="controls">
                          <input name="image" type="file" placeholder="File">
                            <?php if (!empty($imageError)): ?>
                                <span class="help-inline"><?php echo $imageError; ?></span>
                            <?php endif; ?>
                          </div>
                    </div>

<!-End image upload code     ->

                      <div class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                        <label class="control-label">Encoded by</label>
                        <div class="controls">
                            <input Readonly name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                            <?php if (!empty($EncodedbyError)): ?>
                                <span class="help-inline"><?php echo $EncodedbyError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($EncodedDateError)?'error':'';?>">
                        <label class="control-label">Encoded Date</label>
                        <div class="controls">
                            <input Readonly name="EncodedDate" type="date"  placeholder="EncodedDate" value="<?php
                            $currentDateTime = date('Y-m-d');
                            echo $currentDateTime;
                            ?>">
                            <?php if (!empty($EncodedDateError)): ?>
                                <span class="help-inline"><?php echo $EncodedDateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="view_cheq.php">View All Cheq</a>
                          <a class="btn btn-warning" href="viewbl.php">Home</a>
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
