
<?php

error_reporting(E_ALL);
include "../header.php";
require 'uploader.php';
include_once '../logstat.php';

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
   background-color: #aeb6bf;

 }
 #trbg{
   background-color: #212f3d;
   color: white;
}


 </style>


 </head>
<body>
  <br>  <br>  <br>
    <div class="container-fluid offset5">
            <div class="row">
                <h3>Table Users</h3>
            </div>
            <div class="row">
              <p>
                   <a href="create_users.php" class="btn btn-primary">Create</a>
                   <a href="../index.php" class="btn btn-warning">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:75%" >
                  <thead>
                    <tr id="trbg">  <th><center>user_id</center></th>
                      <th><center>First Name</center></th>
                      <th><center>Last Name</center></th>
                      <th><center>email</center></th>
                      <th><center>username</center></th>
                      <th style='display:none'><center>user_pwd</center></th>
                      <th><center>userlevel</center></th>
                      <th><center>image</center></th>

                      <th width="80px"><center>Update</center></th>
                       
                      <th width="80px"><center>Delete</center></th>


                    </tr>
                  </thead>
                  <tbody>
                  <?php
      //             include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM users ORDER BY user_last ASC';
                   foreach ($pdo->query($sql) as $row) {
                            
                            $image = $row['image'];
                            echo '<tr>';
                            echo '<td>'. $row['user_id'] . '</td>';
                           
                            echo '<td width="300px">'. $row['user_first'] . '</td>';
                            echo '<td width="300px">'. $row['user_last'] . '</td>';
                            
                           
                            echo '<td>'. $row['user_email'] . '</td>';
                            echo '<td>'. $row['user_uid'] . '</td>';
                            echo '<td style=\'display:none\'>'. $row['user_pwd'] . '</td>';
                            echo '<td>'. $row['userlevel'] . '</td>'; 
                            if (!empty($image)){
                            echo '<td><img src='. $image .' class=\'img-circle\' width=\'30px\' height=\'30px\' ></td>';
                            }else{
                            echo '<td><img src="/betty/bgladmin/users_images/noimage.jpg" class=\'img-circle\' width=\'30px\' height=\'30px\' ></td>';  
                            }
                            echo '<td><center>';
                            echo '<a class="btn btn-success " href="update_users.php?user_id='.$row['user_id'].'">Update</a>';
                            echo '</center></td>';
                           
                            echo '<td><center>';
                            echo '<a class="btn btn-danger " href="delete_users.php?user_id='.$row['user_id'].'">Delete</a>';
                            echo '</center></td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
