<?php
 try {
   $handler = new PDO('mysql:host=127.0.0.1;dbname=loginsytem', 'root', '');
   $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e){
   echo $e->getName();
   die();
 }

 session_start();

 //$query = $handler->query('SELECT * FROM users');

 if (isset($_POST['submit'])) {

   //Error Handlers
   //Check if inputs are empty
   $uid = $_POST['uid'];
   $pwd = $_POST['pwd'];

   if (empty($uid)) || empty($pwd)) {
     header("location: ../index.php?login=empty");
     exit();
   }
 }   else {

     $stmt = $db->prepare("SELECT * FROM users WHERE user_uid=:uid");
     $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);

     if ($stmt->execute()) {
       header("location: ../index.php?login=error");
       exit();
     } else {
       if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         //de-hashing the password
         $hashedPwdCheck = password_verify($pwd, $row['user_pdw']);
         if ($hashedPwdCheck == false) {
           header("location: ../index.php?login=error");
           exit();

         } elseif ($hashedPwdCheck == true) {
           //Log in the user here
           $_SESSION['u_id'] = $row['user_id'];
           $_SESSION['u_uid'] = $row['user_uid'];
           header("location: ../index.php?login=success");
           exit();
         }
       }
     }
   }

   else {
   header("location: ../index.php?login=error");
   exit();
 }


 ?>
