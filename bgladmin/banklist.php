<?php
include "../header.php";
//include "../database.php";
include_once '../logstat.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link   href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap.min.js"></script>
  <style>
  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
   background-color: #aeb6bf;
  }
  #trbg{
  background-color:  #212f3d;
  color:white;
  }
  </style>

</head>

<body>
  <br>  <br>  <br>
    <div class="container-fluid offset8">
            <div class="row">
                <h3>Table Bank List </h3>
            </div>
            <div class="row">
              <p>
                   <a href="create_banklist.php" class="btn btn-primary">Create</a>

                   <a href="index.php" class="btn btn-warning">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:30%">
                  <thead>
                    <tr id="trbg">
                      <th>id_bank</th>
                      <th>BankCode</th>
                      <th><center>Update</center></th>
                      <?php
                      if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                       echo  '<th><center>Delete</center></th>';
                      }
                      ?>

                    </tr>
                  </thead>
                  <tbody>
                  <?php
      //             include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tbl_banklist ORDER BY BankCode ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id_bank'] . '</td>';
                            echo '<td>'. $row['BankCode'] . '</td>';


                        //    echo '<a class="btn btn-default btn-mini" href="read.php?id='.$row['id_BankCode'].'">Full Details</a>';
                            echo '<td><center>';
                            echo '<a class="btn btn-success" href="update_banklist.php?id_bank='.$row['id_bank'].'">Update</a>';
                            echo '<center></td>';
                            if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<td><center>';
                            echo '<a class="btn btn-danger" href="delete_banklist.php?id_bank='.$row['id_bank'].'">Delete</a>';
                            echo '</center></td>';
                            }
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
