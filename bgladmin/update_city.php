<?php
include "../header.php";
include_once '../logstat.php';


    if (!empty($_GET['id_city'])) {
        $id_city = $_REQUEST['id_city'];
    //    echo $id_city;
    }


    if ( !empty($_POST)) {

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
            $zipcodeError = 'Please enter zipcode Address';
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
            $sql = "UPDATE tbl_city SET city = ?, zipcode = ?, Encodedby = ?, EncodedDate = ? WHERE id_city = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($city,$zipcode,$Encodedby,$EncodedDate,$id_city));
            $message = 'Congratulations! You have Sucessfully Updated the '. $city .' city Info';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'city.php';\",1000);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\city.php?id_city=' . $id_city . '';\",1000,);</script>";
        //    header("Location: read_deposit.php");
            Database::disconnect();
            exit();
          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_city where id_city = '".$id_city."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_city));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $city = $data['city'];
        $zipcode = $data['zipcode'];
     
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
                        <h3>Update City Info</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_city.php?id_city=<?php echo $id_city?>" method="post">


                      <div class="control-group <?php echo !empty($cityError)?'error':'';?>">
                        <label class="control-label">city</label>
                        <div class="controls">
                            <input name="city" type="text"  placeholder="city" value="<?php echo !empty($city)?$city:'';?>">
                            <?php if (!empty($cityError)): ?>
                                <span class="help-inline"><?php echo $cityError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($zipcodeError)?'error':'';?>">
                        <label class="control-label">zipcode</label>
                        <div class="controls">
                            <input name="zipcode" type="text"  placeholder="zipcode" value="<?php echo !empty($zipcode)?$zipcode:'';?>">
                            <?php if (!empty($zipcodeError)): ?>
                                <span class="help-inline"><?php echo $zipcodeError;?></span>
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
                        <a class="btn" href="city.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
