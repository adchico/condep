<?php
//  include_once 'top.php';
include_once 'header.php';
include_once 'logstat.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>

		<style>
		.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
		 background-color: #aeb6bf;
		}
		#trbg{
		background-color:  #212f3d;
		color:white;
		}

}

		</style>


</head>

<body>

    <div class="container-fluid" style= "padding-left: 500px;padding-right: 500px;">
    		<div class="row">

                <div class="span6">
    			    <h3>Bill of Lading Information</h3>
                </div>

    		</div>
        <br>
			<div class="row">

                <div class="span6">
                    <p>


                   <a href="createbl.php" class="btn btn-primary">Create BL</a>

									<?php
									$username = $_SESSION['u_uid'];
									 ?>

												<a href="ViewAllDepositJoin.php" class="btn btn-warning">View/Print All</a>
                      <!--  <a href="add_cheq.php" class="btn btn-success">Create Cheq</a> -->
                        <a href="view_cheq.php" class="btn btn-dark"> << Cheqs >> </a>
												  <a href="/betty/contgua/view_contgua.php" class="btn btn-info">Guarantee</a>
                    </p>
                </div>

                <div  class="span10">
                    <form class="form-search pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                        <input type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
												  <input type="text" name="query2" class="input-medium search-query" value="<?php echo isset($username)?$username:'';?>">
                        <button type="submit" class="btn btn-info">Search</button>
                    </form>
                </div>

                <div class="container-fluid" >
										<div class="row">
				  <table class="table table-striped table-bordered table-hover" width="70%" >
		              <thead >
		                <tr id="trbg"  >
                      <th>id</th>
                      <th >BLNo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>Consignee</th>
                      <th>ShippingLine</th>
                      <th>Forwarder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											  <th>Encodedby</th>
                        <th style="display: none;">EncodedDateBLNo</th>
                      <th align="center">Deposit</th>

										 <th align="center">Update</th>
										 <?php

											if ($_SESSION['u_ulevel']=="Admin" || $_SESSION['u_ulevel']=="ADMIN" ){
											echo '<th align=\'center\'>Delete</th>';
										   }
											?>

		                </tr>
		              </thead>
		              <tbody>
		              <?php

                      $username = $_SESSION['u_uid'];


                       include 'paginator.php';
                 //      include 'database.php';
                       $pdo = Database::connect();

                       $paginator = new Paginator();
                       $sql = "SELECT count(*) FROM tbl_blcreate";
                       $paginator->paginate($pdo->query($sql)->fetchColumn());

                       $sql = "SELECT * FROM tbl_blcreate";

                       $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
											 $query2 = isset($_GET['query2'])?('%'.$_GET['query2'].'%'):'%';

                    $sql .= " WHERE (BLNo LIKE :query
                            OR Consignee LIKE :query
                            OR Forwarder LIKE :query
                            OR ShippingLine LIKE :query
                            OR Encodedby LIKE :query
                            OR EncodedDateBLNo LIKE :query)

														AND (BLNo LIKE :query2
				                    OR Consignee LIKE :query2
				                    OR Forwarder LIKE :query2
				                    OR ShippingLine LIKE :query2
				                    OR Encodedby LIKE :query2
				                    OR EncodedDateBLNo LIKE :query2)";

                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       $sql .= "ORDER BY id_BLNo DESC limit :start, :length ";

                       $sth = $pdo->prepare($sql);
                       $sth->bindParam(':start',$start,PDO::PARAM_INT);
                       $sth->bindParam(':length',$length,PDO::PARAM_INT);

                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
											 $sth->bindParam(':query2',$query2,PDO::PARAM_STR);
                       $sth->execute();

	 				   foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
						   		echo '<tr>';
                  echo '<td>'. $row['id_BLNo'] . '</td>';
                  echo '<td>'. $row['BLNo'] . '</td>';
                  echo '<td>'. $row['Consignee'] . '</td>';
                  echo '<td>'. $row['ShippingLine'] . '</td>';
                  echo '<td>'. $row['Forwarder'] . '</td>';


                  echo '<td width=60>'. $row['Encodedby'] . '</td>';
                  echo '<td style=\'display: none;\'>'. $row['EncodedDateBLNo'] . '</td>';
							   	echo '<td width=160>';
							   	echo '<a class="btn" href="read.php?id_BLNo='.$row['id_BLNo'].'">Container Deposit</a>';

									echo '</td>';


											echo '<td><center>';
										echo '<a class=\'btn btn-success\' href=\'update.php?id_BLNo='.$row['id_BLNo'].'\'>Update</a>';


									echo '</center></td>';


									if ($_SESSION['u_ulevel']=="Admin" || $_SESSION['u_ulevel']=="ADMIN" ){
									echo '<td><center>';
							   	echo '<a class="btn btn-danger" href="delete.php?id_BLNo='.$row['id_BLNo'].'">Delete</a>';
									echo '</center></td>';
								  }

							   	echo '</tr>';
					   }

             $uuid = $_SESSION['u_uid'];
             $_SESSION['u_uid'] = $uuid;
						// $_SESSION['id_BLNo'] = $row['id_BLNo'];
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
                <?php
                echo $paginator->pageNav();
                ?>
                </div>
    	    </div>
    </div> <!-- /container -->

  </body>
</html>
