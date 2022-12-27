<?php
include "../header.php";
 
include_once '../logstat.php';

    if ( !empty($_POST)) {
        // keep track validation errors
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
            $BankNameError = 'Please enter BankName';
            $valid = false;
        }


        if (empty($Branch)) {
            $BranchError = 'Please enter Branch';
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



        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tbl_banklist(BankCode,BankName,Branch,Encodedby,EncodedDate) values(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($BankCode,$BankName,$Branch,$Encodedby,$EncodedDate));

            $message = 'You Have Successfully Added '. $BankCode . '!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'banklist.php';\",1500);</script>";
            Database::disconnect();

        }
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

                <div class="span10 offset1">
                    <div class="row">
                        <h3 class="offset2">Create a BankCode</h3>
                    </div>
                    <br>

                    <form class="form-horizontal" action="create_banklist.php" method="post">

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
                        <label class="control-label">Full Bank Name</label>
                        <div class="controls">
                            <input name="BankName" type="text" placeholder="BankName" value="<?php echo !empty($BankName)?$BankName:'';?>">
                            <?php if (!empty($BankNameError)): ?>
                                <span class="help-inline"><?php echo $BankNameError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($BranchError)?'error':'';?>">
                        <label class="control-label">Branch</label>
                        <div class="controls">
                            <input name="Branch" type="text"  placeholder="Branch" value="<?php echo !empty($Branch)?$Branch:'';?>">
                            <?php if (!empty($BranchError)): ?>
                                <span class="help-inline"><?php echo $BranchError;?></span>
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

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="banklist.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
