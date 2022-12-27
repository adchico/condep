<?php
include "../header.php";
include_once '../logstat.php';


    if (!empty($_GET['id_trucking'])) {
        $id_trucking = $_REQUEST['id_trucking'];
    //    echo $id_truckingcode;
    }


    if ( !empty($_POST)) {

        $truckingcodeError = null;
        $truckingcompanyError = null;
        $contactError = null;
        $EncodedbyError = null;
        $EncodedDateError = null;


        // keep track post values
        $truckingcode = $_POST['truckingcode'];
        $truckingcompany = $_POST['truckingcompany'];
        $contact = $_POST['contact'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

        if (empty($truckingcode)) {
            $truckingcodeError = 'Please enter truckingcode';
            $valid = false;
        }

        if (empty($truckingcompany)) {
            $truckingcompanyError = 'Please enter truckingcompany Address';
            $valid = false;
        }

        if (empty($contact)) {
            $contactError = 'Please enter contact Address';
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
            $sql = "UPDATE tbl_trucking SET truckingcode = ?, truckingcompany = ?, contact = ?, Encodedby = ?, EncodedDate = ? WHERE id_trucking = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($truckingcode,$truckingcompany,$contact,$Encodedby,$EncodedDate,$id_trucking));
            $message = 'Congratulations! You have Sucessfully Updated the trucking Info';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'trucking.php';\",1000);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\truckingcode.php?id_truckingcode=' . $id_truckingcode . '';\",1000,);</script>";
        //    header("Location: read_deposit.php");
            Database::disconnect();
            exit();
          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_trucking where id_trucking = '".$id_trucking."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_trucking));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $truckingcode = $data['truckingcode'];
        $truckingcompany = $data['truckingcompany'];
        $contact = $data['contact'];
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
                        <h3>Update Trucking Info</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_trucking.php?id_trucking=<?php echo $id_trucking?>" method="post">


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
                        <label class="control-label">truckingcompany</label>
                        <div class="controls">
                            <input name="truckingcompany" type="text"  placeholder="truckingcompany" value="<?php echo !empty($truckingcompany)?$truckingcompany:'';?>">
                            <?php if (!empty($truckingcompanyError)): ?>
                                <span class="help-inline"><?php echo $truckingcompanyError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($contactError)?'error':'';?>">
                        <label class="control-label">contact</label>
                        <div class="controls">
                            <input name="contact" type="text"  placeholder="contact" value="<?php echo !empty($contact)?$contact:'';?>">
                            <?php if (!empty($contactError)): ?>
                                <span class="help-inline"><?php echo $contactError;?></span>
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
                        <a class="btn" href="trucking.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
