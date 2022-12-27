<?php
include "../header.php";
 
include_once '../logstat.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $cityError = null;
        $zipcodeError = null;

        $EncodedbyError = null;
        $EncodedDateError = null;






        // keep track post values
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];

        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];




        // validate input
        $valid = true;
        if (empty($city)) {
            $cityError = 'Please enter city';
            $valid = false;
        }

        if (empty($zipcode)) {
            $zipcodeError = 'Please enter zipcode';
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
            $sql = "INSERT INTO tbl_city(city,zipcode,Encodedby,EncodedDate) values(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($city,$zipcode,$Encodedby,$EncodedDate));

            $message = 'You Have Successfully Added '. $city . '!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'city.php';\",600);</script>";
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
                        <h3 class="offset2">Create a City</h3>
                    </div>
                    <br>

                    <form class="form-horizontal" action="create_city.php" method="post">

                      <div class="control-group <?php echo !empty($cityError)?'error':'';?>">
                        <label class="control-label">City</label>
                        <div class="controls">
                            <input name="city" type="text"  placeholder="city" value="<?php echo !empty($city)?$city:'';?>">
                            <?php if (!empty($cityError)): ?>
                                <span class="help-inline"><?php echo $cityError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($zipcodeError)?'error':'';?>">
                        <label class="control-label">Zip Code</label>
                        <div class="controls">
                            <input name="zipcode" type="text" placeholder="zipcode" value="<?php echo !empty($zipcode)?$zipcode:'';?>">
                            <?php if (!empty($zipcodeError)): ?>
                                <span class="help-inline"><?php echo $zipcodeError;?></span>
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
                          <a class="btn" href="city.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
