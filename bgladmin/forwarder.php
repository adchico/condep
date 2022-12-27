
<?php
include "../header.php";
 
include_once '../logstat.php';
include '../paginator.php';

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


             function toTitleCase(str) {
                 return str.replace(/\w\S*/g, function(txt){
                 return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
               });
            }






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
    <div class="container-fluid offset2">
            <div class="row">
                <h3>Table Forwarder </h3>
            </div>
            <div class="row">
              <p>
                   <a href="/bgladmin/create_forwarder.php" class="btn btn-primary">Create</a>
                   <a href="../index.php" class="btn btn-warning">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:85%">
                  <thead>
                    <tr id="trbg">
                      <th>Forwarder</th>
                      <th>Company Full Name</th>
                      <th>Address1</th>
                      <th>Address2</th>
                      <th>Address3</th>
                      <th>Contact1</th>
                      <th>Contact2</th>
                      <th>Details</th>
                      <th>Update</th>
                      <?php
                      if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                      echo '<th>Delete</th>';
                      }
                      ?>

                    </tr>
                  </thead>
                  <tbody>
                  <?php
      //             include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tbl_forwarder ORDER BY Forwarder ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Forwarder'] . '</td>';
                            echo '<td>'. $row['Forwarderfull'] . '</td>';
                            echo '<td>'. $row['Address1'] . '</td>';
                            echo '<td>'. $row['Address2'] . '</td>';
                            echo '<td>'. $row['Address3'] . '</td>';
                            echo '<td>'. $row['Contact1'] . '</td>';
                            echo '<td>'. $row['Contact2'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-default" href="read_forwarder.php?id_Forwarder='.$row['id_Forwarder'].'">Details</a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-success" href="update_forwarder.php?id_Forwarder='.$row['id_Forwarder'].'">Update</a>';
                            echo '</td>';
                            if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<td>';
                            echo '<a class="btn btn-danger" href="delete_forwarder.php?id_Forwarder='.$row['id_Forwarder'].'">Delete</a>';
                            echo '</td>';
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
