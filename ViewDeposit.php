<?php

include_once 'header.php';
include_once 'logstat.php';


  $textBL = null;
  $id_BLNo = null;

if ( !empty($_GET['textBL'])) {
  $textBL = $_REQUEST['textBL'];
}else{
  $textBL = $_SESSION['textBL'];
}
/*
if ( !empty($_POST)) {
    // keep track post values
    $textBL = $_POST['textBL'];
 }


if(isset($_POST['textBL'])){
$textBL = $_POST['textBL'];

}

if(isset($_SESSION['textBL'])) {
$textBL = $_SESSION['textBL'];
}
*/

if (!empty($_GET['id_BLNo'])) {
    $id_BLNo = $_REQUEST['id_BLNo'];
}
else{
$id_BLNo = $_SESSION['id_BLNo'];
}



               ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="dist/number-divider.min.js"></script>



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
    <div class="container-fluid offset2">
            <div class="row"><br><br><br>
                <h3>Container Deposits from BLNo. <?php echo $textBL; ?></h3>
            </div>
            <div class="row">


                    <form method="post" action="createdeposit.php" >
                        <input type="hidden" name="textBL" value="<?php echo $textBL; ?>"><BR/>
                          <?php
                            if(isset($_SESSION['textBL'])) {
                            $textBL = $_SESSION['textBL'];
                          }else{
                            $textBL = $_POST['textBL'];
                          }

                          if(isset($_SESSION['id_BLNo'])) {
                          $textBL = $_SESSION['id_BLNo'];
                        }else{
                        $_POST['id_BLNo'] =   $textBL;
                        }

                        ?>




                      <button class="btn btn-success" type="submit">Add Container Deposit</button>

                              <a class="btn btn-warning" href="viewbl.php">Home</a>
                              <a class="btn" href="ViewAllDepositJoin.php">Print Deposits</a>




                            </form>




                <table class="table table-striped table-bordered table-hover" style="width:85%">
                  <thead>
                    <tr id="trbg">
                      <th>id</th>
                      <th style="display: none;">DepositBLNo</th>
                      <th bgcolor="Khaki">ContainerNo</th>
                      <th >housebl</th>
                      <th>DateOfDeposit</th>
                      <th>ReceiptNo</th>
                      <th>StubNo/ Invoice No</th>
                      <th>DepAmount</th>
                      <th>Deposit Date</th>
                      <th>Deposit Status</th>
                      <th style="display: none;">Encodedby&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="display: none;">EncodedDate</th>
              <?php        if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                        }else{
                    echo '<th style="width:130px">Update</th>';
                  }
                  ?>
                  <th style="width:100px">Requirements</th>


                      <?php if ($_SESSION['u_ulevel']=="Admin" || $_SESSION['u_ulevel']=="ADMIN" ){
                      echo '<th style=\'width:80px\'><center>Delete</center></th>';
                       }
                      ?>
                    </tr>
                  </thead>
                  <tbody align=left>

                  <?php

                //   include 'database.php';

                   $pdo = Database::connect();

                if(isset($_SESSION['textBL'])) {

                  $textBL = $_SESSION['textBL'];

                }
            //       $DepBLNo = $_POST['textBL'];
        //    $textBL=0;
            if ( !empty($_POST['txtBL'])) {

      //          $textBL = $_SESSION['textBL'];
                $sqlDep = "SELECT * FROM `tbl_deposit` WHERE id_BLNo = '".  $id_BLNo  ."' ";
                $sqlDep .= "ORDER BY `id_Deposit` DESC";




            } else {




              $sqlDep = "SELECT * FROM `tbl_deposit` WHERE id_BLNo = '".  $id_BLNo  ."'" ;
              $sqlDep .= "ORDER BY `id_Deposit` DESC";




            }
              $_SESSION['id_BLNo'] = $id_BLNo;
               foreach ($pdo->query($sqlDep) as $row) {
		            echo '<tr>';
                echo '<td >'. $row['id_Deposit'] . '</td>';
		            echo '<td style=\'display: none;\'>'. $row['DepBLNo'] . '</td>';
		            echo '<td>'. $row['ContainerNo'] . '</td>';
                echo '<td>'. $row['housebl'] . '</td>';
                echo '<td>'. $row['DateOfDeposit'] . '</td>';
                echo '<td>'. $row['ReceiptNo'] . '</td>';
                echo '<td>'. $row['StubNoRefNo'] . '</td>';
                echo '<td><div class=\'number\'> '. $row['DepAmount'] . '</div></td>';
                echo '<td><div > '. $row['DateOfDeposit'] . '</div></td>';
                echo '<td><div > '. $row['DepStatus'] . '</div></td>';



                echo '<td style=\'display: none;\'>'. $row['Encodedby'] . '</td>';
                echo '<td style=\'display: none;\'>'. $row['EncodedDateDeposit'] . '</td>';
                if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                  }else{
      			    echo '<td>';
      			    echo '<a class="btn btn-success" href="update_deposit.php?id_Deposit='.$row['id_Deposit'].'&id_BLNo='.$id_BLNo.'">Update Deposit</a>';
      			    echo '</td>';
                }
                echo '<td>';
                echo '<a class="btn btn-warning" href="read_deposit.php?id_Deposit='.$row['id_Deposit'].'">Cont. Req.</a>';
                echo '</td>';
                	if ($_SESSION['u_ulevel']=="Admin" || $_SESSION['u_ulevel']=="ADMIN" ){
                echo '<td><center>';
      			    echo '<a class="btn btn-danger" href="delete_deposit.php?id_Deposit='.$row['id_Deposit'].'&textBL='.$row['DepBLNo'].'">Delete</a>';
      			    echo '</center></td>';
              }
		            echo '</tr>';
                   }
                   Database::disconnect();

          //      unset $_SESSION['textBL'][];
          //      unset $_SESSION['idBLNo'][];

            //    $_SESSION['id_BLNo']=$id_BLNo;
                  ?>

                  </tbody>

            </table>
        </div>
    </div> <!-- /container -->

    <script src="js/number-divider.min.js"></script>
    <script>
    $('.number').divide({
      delimiter: ','
    	});

    </script>



  </body>
</html>
