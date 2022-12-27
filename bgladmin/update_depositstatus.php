<?php
include "../header.php";
include_once '../logstat.php';


    if (!empty($_GET['id_depstatus'])) {
        $id_depstatus = $_REQUEST['id_depstatus'];
    //    echo $id_depstatus;
    }


    if ( !empty($_POST)) {

        $depstatusError = null;
       
       
        $EncodedbyError = null;
        $EncodedDateError = null;


        // keep track post values
        $depstatus = $_POST['depstatus'];
       
       
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

        if (empty($depstatus)) {
            $depstatusError = 'Please enter depstatus';
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
            $sql = "UPDATE tbl_depstatus SET depstatus = ?, Encodedby = ?, EncodedDate = ? WHERE id_depstatus = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($depstatus,$Encodedby,$EncodedDate,$id_depstatus));
            $message = 'Congratulations! You have Sucessfully Updated the '. $depstatus .' depstatus Info';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'depositstatus.php';\",1000);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\depstatus.php?id_depstatus=' . $id_depstatus . '';\",1000,);</script>";
        //    header("Location: read_deposit.php");
            Database::disconnect();
            exit();
          }
   // keep track validation errors
        }else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_depstatus where id_depstatus = '".$id_depstatus."'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_depstatus));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $depstatus = $data['depstatus'];
     
     
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
                        <h3>Update depstatus Info</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_depositstatus.php?id_depstatus=<?php echo $id_depstatus?>" method="post">


                      <div class="control-group <?php echo !empty($depstatusError)?'error':'';?>">
                        <label class="control-label">depstatus</label>
                        <div class="controls">
                            <input name="depstatus" type="text"  placeholder="depstatus" value="<?php echo !empty($depstatus)?$depstatus:'';?>">
                            <?php if (!empty($depstatusError)): ?>
                                <span class="help-inline"><?php echo $depstatusError;?></span>
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
                        <a class="btn" href="depositstatus.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
