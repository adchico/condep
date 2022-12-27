<?php
include "../header.php";
 
include_once '../logstat.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $truckingcodeError = null;
        $truckingcompanyError = null;
        $contactError = null;
        $contactpersonError = null;
        $EncodedbyError = null;
        $EncodedDateError = null;

        // keep track post values
        $truckingcode = $_POST['truckingcode'];
        $truckingcompany = $_POST['truckingcompany'];
        $contact = $_POST['contact'];
        $contactperson = $_POST['contactperson'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;
        if (empty($truckingcode)) {
            $truckingcodeError = 'Please enter truckingcode';
            $valid = false;
        }

        if (empty($truckingcompany)) {
            $truckingcompanyError = 'Please enter truckingcompany';
            $valid = false;
        }

        if (empty($contact)) {
            $contactError = 'Please enter contact';
            $valid = false;
        }

        if (empty($contactperson)) {
            $contactpersonError = 'Please enter contact';
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
            $sql = "INSERT INTO tbl_trucking(truckingcode,truckingcompany,contactperson,contact,Encodedby,EncodedDate) values(?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($truckingcode,$truckingcompany,$contactperson,$contact,$Encodedby,$EncodedDate));

            $message = 'You Have Successfully Added '. $truckingcode . '!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'trucking.php';\",1500);</script>";
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
                        <h3 class="offset2">Create a truckingcode</h3>
                    </div>
                    <br>

                    <form class="form-horizontal" action="create_trucking.php" method="post">

                      <div class="control-group <?php echo !empty($truckingcodeError)?'error':'';?>">
                        <label class="control-label">truckingcode</label>
                        <div class="controls">
                            <input name="truckingcode" type="text"  placeholder="truckingcode" value="<?php echo !empty($truckingcode)?$truckingcode:'';?>">
                            <?php if (!empty($truckingcodeError)): ?>
                                <span class="help-inline"><?php echo $truckingcodeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($truckingcompanyError)?'error':'';?>">
                        <label class="control-label">truckingcode full Name</label>
                        <div class="controls">
                            <input name="truckingcompany" type="text" placeholder="truckingcompany" value="<?php echo !empty($truckingcompany)?$truckingcompany:'';?>">
                            <?php if (!empty($truckingcompanyError)): ?>
                                <span class="help-inline"><?php echo $truckingcompanyError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($contactError)?'error':'';?>">
                        <label class="control-label">contact</label>
                        <div class="controls">
                            <input name="contact" type="text"  placeholder="Contact" value="<?php echo !empty($contact)?$contact:'';?>">
                            <?php if (!empty($contactError)): ?>
                                <span class="help-inline"><?php echo $contactError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($contactpersonError)?'error':'';?>">
                        <label class="control-label">contact person</label>
                        <div class="controls">
                            <input name="contactperson" type="text"  placeholder="contactperson" value="<?php echo !empty($contactperson)?$contactperson:'';?>">
                            <?php if (!empty($contactpersonError)): ?>
                                <span class="help-inline"><?php echo $contactpersonError;?></span>
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
                          <a class="btn" href="trucking.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
