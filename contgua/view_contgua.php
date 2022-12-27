<?php
//  include_once 'top.php';





include_once 'header.php';
include_once 'logstat.php';

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

}

		</style>


</head>

<body>

	<div class="container-fluid" style= "padding-left: 200px;padding-right: 200px; ">

					<div class="row"><br>


						  <div>
    			    <h3>Containers Guarantee Generator</h3>
                </div>

    		</div>
        <br>
			<div class="row">

                <div class="span3">
                    <p>

                      <a href="/betty/viewbl.php" class="btn btn-warning"> << Back</a>
                   <a href="create_contgua.php" class="btn btn-info">GENERATE</a>



            <!--            <a href="ViewAllDepositJoin.php" class="btn btn-warning">Printing</a>
                        <a href="add_cheq.php" class="btn btn-success">Create Cheq</a>
                        <a href="view_cheq.php" class="btn btn-danger">Vew All Cheq</a> -->
                    </p>
                </div>

                <div "container-fluid">
                    <form class="form-search pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                        <input type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
                        <button type="submit" class="btn btn-info">Search</button>
                    </form>
                </div>

                <div class="container-fluid" >
										<div class="row">
				  <table class="table table-striped table-bordered table-hover" >
		              <thead >
		                <tr id="trbg"  >
                      <th>id</th>
                      <th>Consignee</th>
                      <th>ShippingLine</th>
                      <th>Forwarder</th>
											<th >LetterDate</th>
											<th >BLNo</th>
											<th> VesselName </th>
											<th> VoyageNo </th>
											<th> ContainerNo </th>


                      <th  align="center">Guarantee</th>
											<th  align="center">LOA</th>

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
                       include '../paginator.php';
                       include '../database.php';
                       $pdo = Database::connect();

                       $paginator = new Paginator();
                       $sql = "SELECT count(*) FROM tbl_contgua";
                       $paginator->paginate($pdo->query($sql)->fetchColumn());

                       $sql = "SELECT * FROM tbl_contgua ";

                       $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';

                    $sql .= "WHERE Consignee LIKE :query
														OR ShippingLine LIKE :query
                            OR Forwarder LIKE :query
														OR LetterDate LIKE :query
														OR BLNo LIKE :query
				                    OR VesselName LIKE :query
														OR VoyageNo LIKE :query
														OR ContainerNo LIKE :query
                            OR Encodedby LIKE :query
                            OR EncodedDateBLNo LIKE :query ";

                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       $sql .= "ORDER BY id_contgua DESC limit :start, :length ";

                       $sth = $pdo->prepare($sql);
                       $sth->bindParam(':start',$start,PDO::PARAM_INT);
                       $sth->bindParam(':length',$length,PDO::PARAM_INT);
                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
                       $sth->execute();


	 				   foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
						   		echo '<tr>';
									echo '<td>'. $row['id_contgua'] . '</td>';
                  echo '<td>'. $row['Consignee'] . '</td>';
                  echo '<td>'. $row['ShippingLine'] . '</td>';
                  echo '<td>'. $row['Forwarder'] . '</td>';
									echo '<td>'. $LetterDate= date("F j, Y", strtotime($row['LetterDate'])) . '</td>';
									echo '<td>'. $row['BLNo'] . '</td>';
									echo '<td>'. $row['VesselName'] . '</td>';
									echo '<td>'. $row['VoyageNo'] . '</td>';
									echo '<td>'. $row['ContainerNo'] . '</td>';




							   	echo '<td width=90>';
							   	echo '<a class="btn btn-warning" href="/betty/reports/guarantee.php?id_contgua='.$row['id_contgua'].'">Guarantee</a>';

									echo '</td>';

									echo '<td width=60>';
							   	echo '<a class="btn btn-primary" href= "/betty/reports/LOA.php?id_contgua='.$row['id_contgua'].'">LOA</a>';
									echo '</td>';



											echo '<td width=80><center>';
										echo '<a class=\'btn btn-success\' href=\'update_contgua.php?id_contgua='.$row['id_contgua'].'\'>Update</a>';


									echo '</center></td>';


									if ($_SESSION['u_ulevel']=="Admin" || $_SESSION['u_ulevel']=="ADMIN" ){
									echo '<td width=60><center>';
							   	echo '<a class="btn btn-danger" href="delete_contgua.php?id_contgua='.$row['id_contgua'].'">Delete</a>';
									echo '</center></td>';
								  }

							   	echo '</tr>';
					   }

             $uuid = $_SESSION['u_uid'];
             $_SESSION['u_uid'] = $uuid;
						// $_SESSION[''] = $row[''];
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
