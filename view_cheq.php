<?php

include_once 'header.php';
include_once 'logstat.php';

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
    <div class="container">
            <div class="row">
                <h3>ADD CHEQ DETAILS</h3>
            </div>
            <div class="span10">
                <p>
                  <?php		if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                    }else{
                    echo '<a href="add_cheq.php" class="btn btn-success">ADD CHEQ</a>';
                  }
                  ?>
                    <a class="btn btn-warning" href="viewbl.php">Home</a>
                </p>

                <div class="row">
                <br/>      <br/>
    <form class="form-search pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        <input type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
        <button type="submit" class="btn">Search</button>
    </form>
</div>
                  <table class="table table-striped table-bordered table-hover" style="width:70%">
                      <thead>
                        <tr id="trbg" >
                          <th>id_cheq</th>
                          <th>ShippingLine</th>
                          <th>Consignee</th>
                          <th>cheqno</th>
                          <th>cheqamount</th>
                          <th>cheqdate</th>
                          <th>BankInfo</th>
                          <th>Encoded Date</th>
                          <?php
                          if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                            }else{
                          echo '<th>Update</th>';   }
                          ?>
                          <th>View</th>
                          <?php
                          if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                            echo '<th>Delete</th>';

                          }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                    //   include 'database.php';
                       include 'paginator.php';

                       $pdo = Database::connect();
                       $paginator = new Paginator();

                      $sql = "SELECT COUNT(*) FROM tbl_cheq ORDER BY id_cheq DESC";
                      $paginator->paginate($pdo->query($sql)->fetchColumn());

                      $sql = "SELECT * FROM tbl_cheq ";
                      $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
                      $sql .= " WHERE ShippingLine LIKE :query
                      OR Consignee LIKE :query
                      OR cheqno LIKE :query
                      OR cheqamount LIKE :query
                      OR cheqdate  LIKE :query
                      OR BankInfo  LIKE :query
                      OR Encodedby LIKE :query
                      OR EncodedDate LIKE :query ";

                      $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                      $length = ($paginator->itemsPerPage);
                      $sql .= " ORDER BY id_cheq DESC limit :start, :length ";

                      $sth = $pdo->prepare($sql);
                      $sth->bindParam(':start',$start,PDO::PARAM_INT);
                      $sth->bindParam(':length',$length,PDO::PARAM_INT);
                      $sth->bindParam(':query',$query,PDO::PARAM_STR);
                      $sth->execute();

                       foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row){
                                echo '<tr>';
                                echo '<td>'. $row['id_cheq'] . '</td>';
                                echo '<td>'. $row['ShippingLine'] . '</td>';
                                  echo '<td>'. $row['Consignee'] . '</td>';
                                echo '<td>'. $row['cheqno'] . '</td>';
                                echo '<td class=\'number\' >'. $row['cheqamount'] . '</td>';
                                echo '<td>'. $row['cheqdate'] . '</td>';
                                echo '<td>'. $row['BankInfo'] . '</td>';
                                echo '<td>'. $row['EncodedDate'] . '</td>';




                                $id_cheq = $row['id_cheq'].' ';

                                if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                                  }else{
                                echo '<td><a class="btn btn-primary" href="update_cheq.php?id_cheq='.$id_cheq.'">Update</a></td>';
                              }
                                echo '<td><a class="btn btn-info" href="read_cheq.php?id_cheq='.$id_cheq.'">View</a></td>';

                                if ($_SESSION['u_ulevel']=="Admin" OR $_SESSION['u_ulevel']=="ADMIN"){
                                echo '<td><a class="btn btn-danger" href="delete_cheq.php?id_cheq='.$id_cheq.'">Delete</a></td>';
                                }
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <?php echo $paginator->pageNav();?>
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
