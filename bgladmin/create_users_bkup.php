<?php
include "bgladmin_header.php";
include "../database.php";
include_once '../logstat.php';


    if ( !empty($_POST)) {
        // keep track validation errors
        $user_firstError = null;
        $user_lastError = null;
        $user_emailError = null;
        $user_uidError = null;
        $user_pwdError = null;
        $userlevelError = null;
       

        $EncodedbyError = null;
        $EncodedDateError = null;

        // keep track post values
        $user_first = $_POST['user_first'];
        $user_last = $_POST['user_last'];
        $user_email = $_POST['user_email'];
        $user_uid = $_POST['user_uid'];
        $user_pwd = $_POST['user_pwd'];
        $userlevel = $_POST['userlevel'];


        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];



        // validate input
        $valid = true;
        if (empty($user_first)) {
            $user_firstError = 'Please enter user_first';
            $valid = false;
        }

        if (empty($user_last)) {
            $user_lastError = 'Please enter user_last';
            $valid = false;
        }


        if (empty($user_email)) {
            $user_emailError = 'Please enter user_email';
            $valid = false;
        }

        if (empty($user_uid)) {
            $user_uidError = 'Please enter user_uid';
            $valid = false;
        }

        if (empty($user_pwd)) {
            $user_pwdError = 'Please enter user_pwd';
            $valid = false;
        }

        if (empty($userlevel)) {
            $userlevelError = 'Please enter userlevel';
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

            $hashedpwd = password_hash($user_pwd, PASSWORD_DEFAULT);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (user_first,user_last,user_email,user_uid,user_pwd,userlevel,Encodedby,EncodedDate) values(?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($user_first,$user_last,$user_email,$user_uid,$hashedpwd,$userlevel,$Encodedby,$EncodedDate));

            $message = 'You Have Successfully Added '. $user_first . '!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'users.php';\",600);</script>";
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

     

 <style>
 .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
   background-color: Beige;

{ margin: 0; padding: 0; }
 }
 #body-background {
     background-color: #dfe3ee;
 }
 #div-background {
     background-color: #ffffff;
 }

 #form-transparent
 {
 background-color: transparent;
 }




 </style>


 </head>




<body id="body-background">
    <div id="div-background" class="container">

                <div class="span10 offset1">
                  <br>
                    <div class="row">
                        <h3 class="offset2">Create a User Account</h3>
                    </div>
                    <br>

                    <form class="form-horizontal" action="create_users.php" method="post">

                      <div class="control-group <?php echo !empty($user_firstError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="user_first" type="text"  placeholder="First Name" value="<?php echo !empty($user_first)?$user_first:'';?>">
                            <?php if (!empty($user_firstError)): ?>
                                <span class="help-inline"><?php echo $user_firstError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($user_lastError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="user_last" type="text" placeholder="Last Name" value="<?php echo !empty($user_last)?$user_last:'';?>">
                            <?php if (!empty($user_lastError)): ?>
                                <span class="help-inline"><?php echo $user_lastError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($user_emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="user_email" type="text"  placeholder="Email" value="<?php echo !empty($user_email)?$user_email:'';?>">
                            <?php if (!empty($user_emailError)): ?>
                                <span class="help-inline"><?php echo $user_emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
<!- Begin Here -->

<div class="control-group <?php echo !empty($user_uidError)?'error':'';?>">
  <label class="control-label">Username</label>
  <div class="controls">
      <input name="user_uid" type="text"  placeholder="Username" value="<?php echo !empty($user_uid)?$user_uid:'';?>">
      <?php if (!empty($user_uidError)): ?>
          <span class="help-inline"><?php echo $user_uidError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($user_pwdError)?'error':'';?>">
  <label class="control-label">user_pwd</label>
  <div class="controls">
      <input name="user_pwd" type="password"  placeholder="Password" value="<?php echo !empty($user_pwd)?$user_pwd:'';?>">
      <?php if (!empty($user_pwdError)): ?>
          <span class="help-inline"><?php echo $user_pwdError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($userlevelError)?'error':'';?>">
  <label class="control-label">User Level</label>
  <div class="controls">
      <SELECT name="userlevel" type="text"  placeholder="User Level" value="<?php echo !empty($userlevel)?$userlevel:'';?>">
        <option value="<?php echo !empty($userlevel)?$userlevel:'';?>" Selected Readonly></option>
        <option>EMPLOYEE</option>
        <option>ADMIN</option>
        <option>VIEWER</option>
        <option>ENCODER</option>
      </SELECT>



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
                      <div class="form-actions" id="form-transparent">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href=" /bgladmin/users.php">Back</a>
                        </div>
                    </form>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>

    </div> <!-- /container -->

  </body>
</html>
