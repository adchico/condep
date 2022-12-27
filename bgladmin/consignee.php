
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
    <div class="container-fluid offset2">
            <div class="row">
                <h3>Table Consignee </h3>
            </div>
            <div class="row">
              <p>
                   <a href="create_consignee.php" class="btn btn-primary">Create</a>
                   <a href="../index.php " class="btn btn-warning">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:80%">
                  <thead>
                    <tr id="trbg">
                      <th>Consignee</th>
                      <th width=180>Company Full Name</th>
                      <th>Contact Person</th>
                      <th>Designation</th>
                      <th>Tel No</th>
                      <th>Fax</th>
                      <th width=180>Email</th>
                      <th>Details</th>
                      <th>Update</th>
                       <th>Images</th>
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
                   $sql = 'SELECT * FROM tbl_consignee ORDER BY Consignee ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Consignee'] . '</td>';
                            echo '<td>'. $row['Consigneefull'] . '</td>';
                            echo '<td>'. $row['ContactPerson'] . '</td>';
                            echo '<td>'. $row['Designation'] . '</td>';
                            echo '<td>'. $row['TelNo'] . '</td>';
                            echo '<td>'. $row['Fax'] . '</td>';
                            echo '<td>'. $row['Email'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-default" href="read_consignee.php?id_Consignee='.$row['id_Consignee'].'">Details</a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-success" href="update_consignee.php?id_Consignee='.$row['id_Consignee'].'">Update</a>';
                            echo '</td>';
                            
                             echo '<td>';
                            echo '<a class="btn btn-primary" href="consignee_images.php">Images</a>';
                            echo '</td>';
                            
                            
                            if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<td>';
                            echo '<a class="btn btn-danger" href="delete_consignee.php?id_Consignee='.$row['id_Consignee'].'">Delete</a>';
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
