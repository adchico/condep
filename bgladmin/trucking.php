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
                <h3>Trucking Companies </h3>
            </div>
            <div class="row">
              <p>
                   <a href="create_trucking.php" class="btn btn-primary">Create</a>
                   <a href="../index.php " class="btn btn-warning">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:40%">
                  <thead>
                    <tr id="trbg">
                      <th width="30px">id</th>
                      <th width="180px">truckingcode</th>
                        <th width="150px">contactperson</th>
                          <th width="150px">contact no</th>
                        <th width="50"><center>Update</center></th>
                        <?php
                        if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                        echo '<th width="50"><center>Delete</center></th>';
                        }
                        ?>


                    </tr>
                  </thead>
                  <tbody>
                  <?php
      //             include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tbl_trucking ORDER BY truckingcode ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id_trucking'] . '</td>';
                            echo '<td>'. $row['truckingcode'] . '</td>';
                            echo '<td>'. $row['contactperson'] . '</td>';
                            echo '<td>'. $row['contact'] . '</td>';

                            echo '<td><center>';
                            echo '<a class="btn btn-success" href="update_trucking.php?id_trucking='.$row['id_trucking'].'">Update</a>';
                            echo '</center></td>';
                            if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<td><center>';
                            echo '<a class="btn btn-danger" href="delete_trucking.php?id_trucking='.$row['id_trucking'].'">Delete</a>';
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
