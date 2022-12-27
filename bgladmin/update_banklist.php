<?php
include "../header.php";
include_once '../logstat.php';


    if (!empty($_GET['id_bank'])) {
        $id_bank = $_REQUEST['id_bank'];
    //    echo $id_BankCode;
    }


    if ( !empty($_POST)) {

        $BankCodeError = null;
        $BankNameError = null;
        $BranchError = null;
        $EncodedbyError = null;
        $EncodedDateError = null;


        // keep track post values
        $BankCode = $_POST['BankCode'];
        $BankName = $_POST['BankName'];
        $Branch = $_POST['Branch'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

        if (empty($BankCode)) {
            $BankCodeError = 'Please enter BankCode';
            $valid = false;
        }

        if (empty($BankName)) {
            $BankNameError = 'Please enter BankName Address';
            $valid = false;
        }

        if (empty($Branch)) {
            $BranchError = 'Please enter Branch Address';
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
            $sql = "UPDATE tbl_banklist SET BankCode = ?, BankName = ?, Branch = ?, Encodedby = ?, EncodedDate = ? WHERE id_bank = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($BankCode,$BankName,$Branch,$Encodedby,$EncodedDate,$id_bank));
            $message = 'Congratulations! You have Sucessfully Updated the banklist Info of ' . $BankCode;
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'banklist.php';\", 600);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\BankCode.php?id_BankCode=' . $id_BankCode . '';\",1000,);</script>";
        //    header("Location: read_deposit.php");
            Database::disconnect();
            exit();
          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_banklist where id_bank = '".$id_bank."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_bank));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $BankCode = $data['BankCode'];
        $BankName = $data['BankName'];
        $Branch = $data['Branch'];
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

    <script type="text/javascript" language="javascript">
          $(document).ready(function(){
            $("input").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            });
            });
    </script>

<style>
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: Beige;
}
</style>


</head>





<body>
    <div class="container">

                <div class="span11 offset1">
                    <div class="row"><br/>
                        <h3>Update bank List</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_banklist.php?id_bank=<?php echo $id_bank?>" method="post">


                      <div class="control-group <?php echo !empty($BankCodeError)?'error':'';?>">
                        <label class="control-label">BankCode</label>
                        <div class="controls">
                            <input name="BankCode" type="text"  placeholder="BankCode" value="<?php echo !empty($BankCode)?$BankCode:'';?>">
                            <?php if (!empty($BankCodeError)): ?>
                                <span class="help-inline"><?php echo $BankCodeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($BankNameError)?'error':'';?>">
                        <label class="control-label">BankName</label>
                        <div class="controls">
                            <input name="BankName" type="text"  placeholder="BankName" value="<?php echo !empty($BankName)?$BankName:'';?>">
                            <?php if (!empty($BankNameError)): ?>
                                <span class="help-inline"><?php echo $BankNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($BranchError)?'error':'';?>">
                        <label class="control-label">Branch</label>
                        <div class="controls">
                            <input name="Branch" type="text"  placeholder="Branch" value="<?php echo !empty($Branch)?$Branch:'';?>">
                            <?php if (!empty($BranchError)): ?>
                                <span class="help-inline"><?php echo $BranchError;?></span>
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
                        <a class="btn" href="banklist.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
