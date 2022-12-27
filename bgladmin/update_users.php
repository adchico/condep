<?php

include "../header.php";
require 'uploader.php';
 
include_once '../logstat.php';

  $user_id = null;

    if ( !empty($_GET['user_id'])) {
        $user_id = $_REQUEST['user_id'];
        echo $user_id;
    }

    if ( null==$user_id) {
       header("Location: users.php");
    }

    if ( !empty($_POST)) {
      $uploader = new Uploader();

        $user_firstError = null;
        $user_lastError = null;
        $user_emailError = null;
        $user_uidError = null;
        $user_pwdError = null;
        $userlevelError = null;
        $EncodedbyError = null;
        $EncodedDateError = null;
        $imageError = null;

        // keep track post values
        $user_first = $_POST['user_first'];
        $user_last = $_POST['user_last'];
        $user_email = $_POST['user_email'];
        $user_uid = $_POST['user_uid'];
        $user_pwd = $_POST['user_pwd'];
        $userlevel = $_POST['userlevel'];

        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];
        $image = $_POST['image'];

        // validate input
        $valid = true;

        if (empty($user_first)) {
            $user_firstError = 'Please enter user_first';
            $valid = false;
        }

        if (empty($user_last)) {
            $user_lastError = 'Please enter user_last Address';
            $valid = false;
        }

        if (empty($user_email)) {
            $user_emailError = 'Please enter user_email Address';
            $valid = false;
        }

        if (empty($user_uid)) {
            $user_uidError = 'Please enter user_uid Number';
           $valid = false;
        }
                // 11 starts here

        if (empty($user_pwd)) {
            $user_pwdError = 'Please enter user_pwd Number';
           $valid = false;
        }

        if (empty($userlevel)) {
            $userlevelError = 'Please enter userlevel Number';
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

        if (!empty($_FILES['image']['name']) && !$uploader->valid($_FILES['image']))
            {
                $imageError = 'Invalid file uploaded';
                $valid = false;
            }


        // update data
        if ($valid) {

          // upload file
                 // delete old
          if (!empty($image)) {
            $uploader->delete($image);
          }
            $image = $uploader->upload($_FILES['image']);

            $hashedpwd = password_hash($user_pwd, PASSWORD_DEFAULT);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users SET user_first = ?, user_last = ?, user_email = ?, user_uid = ?, user_pwd = ?, userlevel = ?, image = ?, Encodedby = ?, EncodedDate = ? WHERE user_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($user_first, $user_last, $user_email, $user_uid, $hashedpwd, $userlevel, $image, $Encodedby, $EncodedDate, $user_id));

            $message = 'Congratulations! You have Sucessfully Updated the user_first ' . $user_first;
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\users.php';\",1000);</script>";
        //    echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\user_first.php?user_id=' . $user_id . '';\",1000,);</script>";

            Database::disconnect();
            header("Location: users.php");
            //exit();
          }
   // keep track validation errors
        }else{

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_id));
        $data = $q->fetch(PDO::FETCH_ASSOC);

    //    $user_id = $data['user_id'];
        $user_first = $data['user_first'];
        $user_last = $data['user_last'];
        $user_email = $data['user_email'];
        $user_uid = $data['user_uid'];
        $user_pwd = $data['user_pwd'];
        $userlevel = $data['userlevel'];
        $Encodedby = $data['Encodedby'];
        $EncodedDate = $data['EncodedDate'];
        $image = $data['image'];

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



</head>

<body>
    <div class="container">

                <div class="span11 offset1">
                    <div class="row"><br/>
                        <h3>Update Container Requirements</h3><br/>
                    </div>

                    <form class="form-horizontal" action="update_users.php?user_id=<?php echo $user_id?>" method="post" enctype="multipart/form-data">


                      <div class="control-group <?php echo !empty($user_firstError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="user_first" type="text"  placeholder="user_first" value="<?php echo !empty($user_first)?$user_first:'';?>">
                            <?php if (!empty($user_firstError)): ?>
                                <span class="help-inline"><?php echo $user_firstError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($user_lastError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="user_last" type="text"  placeholder="user_last" value="<?php echo !empty($user_last)?$user_last:'';?>">
                            <?php if (!empty($user_lastError)): ?>
                                <span class="help-inline"><?php echo $user_lastError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($user_emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="user_email" type="text"  placeholder="user_email" value="<?php echo !empty($user_email)?$user_email:'';?>">
                            <?php if (!empty($user_emailError)): ?>
                                <span class="help-inline"><?php echo $user_emailError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($user_uidError)?'error':'';?>">
                        <label class="control-label">User Name</label>
                        <div class="controls">
                            <input name="user_uid" type="text"  placeholder="user_uid" value="<?php echo !empty($user_uid)?$user_uid:'';?>">
                            <?php if (!empty($user_uidError)): ?>
                                <span class="help-inline"><?php echo $user_uidError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

<!- 11 Starts Here ->

                    <div class="control-group <?php echo !empty($user_pwdError)?'error':'';?>">
                      <label class="control-label">Password</label>
                      <div class="controls">
                          <input name="user_pwd" type="password"  placeholder="user_pwd" value="<?php echo !empty($user_pwd)?$user_pwd:'';?>">
                          <?php if (!empty($user_pwdError)): ?>
                              <span class="help-inline"><?php echo $user_pwdError;?></span>
                          <?php endif; ?>
                      </div>
                    </div>

                    <div class="control-group <?php echo !empty($userlevelError)?'error':'';?>">
                      <label class="control-label">User Level</label>
                      <div class="controls">
                          <input name="userlevel" type="text"  placeholder="userlevel" value="<?php echo !empty($userlevel)?$userlevel:'';?>">
                          <?php if (!empty($userlevelError)): ?>
                              <span class="help-inline"><?php echo $userlevelError;?></span>
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

                    <div class="control-group <?php echo !empty($imageError) ? 'error' : ''; ?>">
                    <label class="control-label">Image</label>
                    <div class="controls">
                    <input name="image" type="file" placeholder="File">
                    <input name="image" type="hidden" value="<?php echo $image; ?>">
                    <?php if (!empty($imageError)): ?>
                    <span class="help-inline"><?php echo $imageError; ?></span>
                    <?php endif; ?>
                    </div>
                    </div>


                    <?php if (!empty($image)): ?>
                    <div class="control-group">
                    <div class="controls">
                    <img src="<?php echo $image; ?>" class="thumbnail" style="width:80px; height:80px;" />
                    </div>
                    </div>
                    <?php endif; ?>

<!- 11 ends Here ->

                      <div class="form-actions">
                        <a class="btn" href="users.php">Back</a>
                        <button type="submit" class="btn btn-success">Save Changes</button>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
