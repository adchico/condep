<?php
include "../header.php";
 
require "../uploader.php";

include_once '../logstat.php';


    if ( !empty($_POST)) {

        // keep track validation errors
        $ConsigneeError = null;
     
    

        $EncodedbyError = null;
        $EncodedDateError = null;

        // keep track post values
        $Consignee = $_POST['Consignee'];
       
      

        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];



        // validate input
        $valid = true;
        if (empty($Consignee)) {
            $ConsigneeError = 'Please enter Consignee';
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
            $sql = "INSERT INTO tbl_consignee (Consignee, Encodedby, EncodedDate) values(?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Consignee,$Encodedby,$EncodedDate));

            $message = 'You Have Successfully Added Image to '. $Consignee . '!';
            Database::disconnect();
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\consignee.php';\",1500);</script>";


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
                        <h3 class="offset2">Create a Consignee</h3>
                    </div>
                    <br>

                    <form class="form-horizontal" action="create_consignee_images.php" method="post"  >

                      <div class="control-group <?php echo !empty($ConsigneeError)?'error':'';?>">
                        <label class="control-label">Consignee</label>
                        <div class="controls">
                            <input name="Consignee" type="text"  placeholder="Consignee" value="<?php echo !empty($Consignee)?$Consignee:'';?>">
                            <?php if (!empty($ConsigneeError)): ?>
                                <span class="help-inline"><?php echo $ConsigneeError;?></span>
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








                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="consignee.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
