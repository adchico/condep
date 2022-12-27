
<?php
	session_start();
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
                <h3>Upload Consignee Images</h3>
            </div>
            <div class="row">
              <p>
                  
                   <a href="../index.php " class="btn ">Home</a>
               </p>
                <table class="table table-striped table-bordered table-hover" style="width:60%">
                  <thead>
                    <tr id="trbg">
                      <th>Consignee</th>
                     
                      
                      <th width=130px>Upload 1</th>
                      
                       <th width=130px>Upload 2</th>
                      <?php
                      if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                        echo '<th width=280px>';
                        echo '                                ';
                        echo '</th>'; 
                      echo '<th width=130px>Delete L Head</th>';
                      echo '<th width=130px>Delete Footer</th>';
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
                           
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="consignee_addhead.php?consignee= ' . $row['Consignee'] . '">Letter Head</a>';
                            echo '</td>';
                            
                           
                            
                            echo '<td>';
                            echo '<a class="btn btn-success" href="consignee_addfooter.php">Upload Footer</a>';
                            echo '</td>';
                            
                        
                            
                            
                            if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<center>';    
                            echo '<td>';
                            echo '';
                            echo '</td>'; 
                            echo '<td>';
                            echo '<a class="btn btn-danger" href="consignee_images.php" align=center>Delete LHead</a>';
                            echo '</td>';    
                                
                            echo '<td>';
                            echo '<a class="btn btn-warning" href="consignee_images.php" align=center>Delete Footer</a>';
                            echo '</td>';
                            echo '</center>';
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
