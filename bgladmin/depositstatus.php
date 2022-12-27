<?php
include "../header.php";
 
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
                <h3>Table Deposit Status</h3>
            </div>
            <div class="row">
              <p>
                   <a href="create_depositstatus.php" class="btn btn-primary">Create</a>
                   <a href="../index.php" class="btn btn-warning">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:40%">
                  <thead>
                    <tr id="trbg">
                      <th width="30px">id</th>
                      <th width="800px">depstatus</th>



                      <th width="50px"><center>Update</center></th>
                      <?php
                      if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                      echo '<th width="50px"><center>Delete</center></th>';

                      }
                      ?>


                    </tr>
                  </thead>
                  <tbody>
                  <?php
      //             include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tbl_depstatus ORDER BY depstatus ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id_depstatus'] . '</td>';
                            echo '<td>'. $row['depstatus'] . '</td>';

                            echo '<td><center>';
                            echo '<a class="btn btn-success" href="update_depositstatus.php?id_depstatus='.$row['id_depstatus'].'">Update</a>';
                            echo '</center></td>';
                            if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<td><center>';
                            echo '<a class="btn btn-danger" href="delete_depositstatus.php?id_depstatus='.$row['id_depstatus'].'">Delete</a>';
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
