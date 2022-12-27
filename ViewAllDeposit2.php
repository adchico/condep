<?php
session_start();

if ( !empty($_GET['textBL'])) {
    $textBL = $_REQUEST['textBL'];
}

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


               ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="dist/number-divider.min.js"></script>

</head>

<body>
    <div class="container-fluid">
            <div class="row"><br>
                <h3>Create Container Deposits from BL</h3>
            </div>
            <div class="row">


                    <form method="post" action="createdeposit.php" >
                          <?
                            if(isset($_SESSION['textBL'])) {
                            $textBL = $_SESSION['textBL'];
                          }else{
                            $textBL = $_POST['textBL'];
                          }

                            ?>
                              <input type="hidden" name="textBL" value="<?php echo $textBL; ?>"><BR/>
                      <!--        <button class="btn btn-success" type="submit">Add Container Deposit</button> -->
                              <a class="btn btn-warning" href="viewbl.php">Home</a>




                            </form>


                            <div  class="span12">
                                <form class="form-search pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                                    <input type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </form>
                            </div>

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>DepositBLNo</th>
                      <th bgcolor="Khaki">ContainerNo</th>
                      <th>DateOfDeposit</th>
                      <th>ReceiptNo</th>
                      <th>DepAmount</th>
                      <th>CtrlFormNo</th>
                      <th>CheqNo</th>
                      <th>DepStatus</th>

                      <th style="display: none;">Encodedby&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="display: none;">EncodedDate</th>
                      <th>Commands</th>

                    </tr>
                  </thead>
                  <tbody align=left>

              <?php
               include 'paginator.php';
               include 'database.php';
               $pdo = Database::connect();
               $paginator = new Paginator();

                $sqlDep = "SELECT * FROM `tbl_deposit`" ;
                $sqlDep .= "ORDER BY `id_Deposit` DESC";

                $sqlDep = "SELECT count(*) FROM tbl_deposit ";
                $paginator->paginate($pdo->query($sqlDep)->fetchColumn());

                $sqlDep = "SELECT * FROM tbl_deposit ";

                $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';

                $sqlDep .= "WHERE id_Deposit LIKE :query
                     OR DepBLNo LIKE :query
                     OR ContainerNo LIKE :query
                     OR DateOfDeposit LIKE :query
                     OR ReceiptNo LIKE :query
                     OR DepAmount LIKE :query
                     OR CtrlFormNo LIKE :query
                     OR CheqNo LIKE :query
                     OR DepStatus LIKE :query

                     OR Encodedby LIKE :query
                     OR EncodedDateDeposit LIKE :query ";

                $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                $length = ($paginator->itemsPerPage);
                $sqlDep .= "ORDER BY id_Deposit DESC limit :start, :length ";

                $sth = $pdo->prepare($sqlDep);
                $sth->bindParam(':start',$start,PDO::PARAM_INT);
                $sth->bindParam(':length',$length,PDO::PARAM_INT);
                $sth->bindParam(':query',$query,PDO::PARAM_STR);
                $sth->execute();

                foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
		            echo '<tr>';
                echo '<td >'. $row['id_Deposit'] . '</td>';
		            echo '<td >'. $row['DepBLNo'] . '</td>';
		            echo '<td>'. $row['ContainerNo'] . '</td>';
                echo '<td>'. $row['DateOfDeposit'] . '</td>';
                echo '<td>'. $row['ReceiptNo'] . '</td>';
                echo '<td><div class=\'number\'> '. $row['DepAmount'] . '</div></td>';
                echo '<td>'. $row['CtrlFormNo'] . '</td>';
                echo '<td>'. $row['CheqNo'] . '</td>';
                echo '<td>'. $row['DepStatus'] . '</td>';
                echo '<td style=\'display: none;\'>'. $row['Encodedby'] . '</td>';
                echo '<td style=\'display: none;\'>'. $row['EncodedDateDeposit'] . '</td>';

      			    echo '<td>';
      			    echo '<a class="btn btn-sm" href="read_deposit.php?id_Deposit='.$row['id_Deposit'].'">ContReq</a>';
		            echo ' ';
              //  echo '<a class="btn btn-primary" href="add_cheq.php?id_Deposit='.$row['id_Deposit'].'">CheqInfo</a>';
      			    echo ' ';
      			    echo '<a class="btn btn-success btn-sm" href="update_deposit.php?id_Deposit='.$row['id_Deposit'].'">Update</a>';
      			    echo ' ';
      			  //  echo '<a class="btn btn-danger btn-sm" href="delete_deposit.php?id_Deposit='.$row['id_Deposit'].'&textBL='.$row['DepBLNo'].'">Delete</a>';
      			    echo '</td>';
		            echo '</tr>';
                   }
                   Database::disconnect();
              //     session_destroy();
                  ?>

                  </tbody>

            </table>
            <?php
            echo $paginator->pageNav();
            ?>
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
