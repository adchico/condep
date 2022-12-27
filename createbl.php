<?php
  //  include_once 'top.php';
		include_once 'header.php';
		include_once 'logstat.php';

  //  require 'database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $BLNoError = null;
        $ConsigneeError = null;
        $ForwarderError = null;
				$ShipLineCodeError = null;
        $ShippingLineError = null;
				$DateOfDepositError = null;
				$ReceiptNoError = null;


        $Encodedby = null;
        $EncodedDateBLNo = null;

        // keep track post values
        $BLNo = $_POST['BLNo'];
        $Consignee = $_POST['Consignee'];
        $Forwarder = $_POST['Forwarder'];

        $ShippingLine = $_POST['ShippingLine'];




        $Encodedby = $_SESSION['u_uid'];
        $EncodedDateBLNo = $_POST['EncodedDateBLNo'];



        // validate input
        $valid = true;

        if (empty($BLNo)) {
            $BLNoError = 'Please enter BLNo';
            $valid = false;
        }

        if (empty($Consignee)) {
            $ConsigneeError = 'Please enter Consignee';
            $valid = false;

        }


        if (empty($Forwarder)) {
            $ForwarderError = 'Please enter Forwarder Number';
            $valid = false;
        }

        if (empty($ShippingLine)) {
            $ShippingLineError = 'Please enter ShippingLine';
            $valid = false;
        }


        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby';
            $valid = false;
        }

        if (empty($EncodedDateBLNo)) {
            $EncodedDateBLNoError = 'Please enter Encoded Date BLNo';
            $valid = false;
        }

       // check if there is database duplicate before adding new BL No
			 if (!empty($_POST['BLNo'])) {
			  $BLNo = $_POST['BLNo'];
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT BLNo FROM tbl_blcreate WHERE ? = BLNo");
        $params = array($BLNo);
        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
					$message = 'BL No.'. $BLNo . ' Already Existing!';
					echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'createbl.php';\",1500);</script>";
          $valid=false;
					Database::disconnect();
        	}
				}

        // insert data

        if ($valid) {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tbl_blcreate(BLNo,Consignee,Forwarder,ShippingLine,Encodedby,EncodedDateBLNo) values( ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($BLNo,$Consignee,$Forwarder,$ShippingLine,$Encodedby,$EncodedDateBLNo));


      // Set Messagebox and delay before redirecting to next page using javascript//
            $message = 'BL No. '. $BLNo . ' Sucessfully Created!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = 'viewbl.php';\",600);</script>";
            Database::disconnect();

        }
    }


?>

<!-- After PHP Code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript" language="javascript">
      $(document).ready(function(){
        $("input").keyup(function() {
        $(this).val($(this).val().toUpperCase());
        });
        });



			$(function () {

	    $('#selectFW').change(function () {

			if ( $('#selectSL').val() == "EVERGREEN") {
        $('#textSLcode').val('EGLV');
    	}
			else if ( $('#selectSL').val() == "COSCO" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('COSU');
			}
			else if ( $('#selectSL').val() == "HAPAG-LLOYD" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('HLCU');
			}
			else if ( $('#selectSL').val() == "KLINE" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('KKLU');
			}
			else if ( $('#selectSL').val() == "ZIM" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('ZIMU');
			}
			else if ( $('#selectSL').val() == "MOL (MITSUI)" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('MOLU');
			}
			else if ( $('#selectSL').val() == "OOCL" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('OOLU');
			}
			else if ( $('#selectSL').val() == "ONE" &&  $('#selectFW').val() == "NA") {
        $('#textSLcode').val('ONEY');
			}
			else{
			$('#textSLcode').val('');
			}
	    });
			});

				</script>

<style>
    { margin: 0; padding: 0; }

    #form-transparent
    {
    background-color: transparent;
    }
		#body-background {
				background-image: url("/betty/betty/img/background-trans.jpg");
				background-color: #dfe3ee;
		}
		#div-background {
				background-color: #ffffff;
		}

</style>


    </head>

<body id="body-background" >
  <br/><br/><br/>
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Bill of Lading Entry</h3>
                    </div>
                    <br/>

                <form class="form-horizontal" action="createbl.php" method="post">

									<div class="control-group <?php echo !empty($ShippingLineError)?'error':'';?>">
										<label class="control-label">Shipping Line</label>
										<div class="controls">
											<?php
									//Combo box of ShippingLine db connection

											$pdo = Database::connect();
											$smt_ShippingLine = $pdo->prepare('SELECT ShippingLine From tbl_shippingline ORDER BY ShippingLine ASC');
											$smt_ShippingLine->execute();
											$data_ShippingLine = $smt_ShippingLine->fetchAll();

											?>
									<!- Select of ShippingLine ->
												<SELECT id='selectSL' name="ShippingLine" type="text"  placeholder="ShippingLine" value="<?php echo !empty($ShippingLine)?$ShippingLine:'';?>">
											<?php
									//Combo box  of ShippingLine
												foreach ($data_ShippingLine as $row): ?>
													<option style="display:none"></option>
													<option><?=$row["ShippingLine"]?></option>
												<?php endforeach

									// end of combo box of ShippingLine
																										?>

													</SELECT>

													<?php if (!empty($ShippingLineError)): ?>
															<span class="help-inline"><?php echo $ShippingLineError;?></span>
													<?php endif;?>

										</div>
									</div>

									<div class="control-group <?php echo !empty($ForwarderError)?'error':'';?>">
										<label class="control-label">Forwarder</label>
										<div class="controls">


											<?php
								//Combo box of Consignee db connection

											$pdo = Database::connect();
											$smt_forwarder = $pdo->prepare('SELECT Forwarder From tbl_forwarder ORDER BY Forwarder ASC');
											$smt_forwarder->execute();
											$data_forwarder = $smt_forwarder->fetchAll();
											?>

								<!- Select of Forwarder ->
												<SELECT id='selectFW' name="Forwarder" type="text"  placeholder="Forwarder" value="<?php echo !empty($Forwarder)?$Forwarder:'';?>">
													<option style="display:none"></option>
												<?php
								//Combo box  of Forwarder
												foreach ($data_forwarder as $row): ?>
													<option><?=$row["Forwarder"]?></option>
												<?php endforeach
								// end of combo box of Forwarder
												?>
										</SELECT>
										<?php if (!empty($ForwarderError)): ?>
												<span class="help-inline"><?php echo $ForwarderError;?></span>
										<?php endif;?>
										</div>
									</div>





                      <div class="control-group <?php echo !empty($ConsigneeError)?'error':'';?>">
                        <label class="control-label">Consignee</label>
                        <div class="controls">




                              <?php
//Combo box of Consignee db connection
                              $pdo = Database::connect();
                              $smt = $pdo->prepare('SELECT Consignee From tbl_consignee ORDER BY Consignee ASC');
                              $smt->execute();
                              $data = $smt->fetchAll();
                              ?>
<!- Select of Consignee ->
                            <SELECT name="Consignee" id="Consignee" type="text" placeholder="Consignee" value="<?php echo !empty($Consignee)?$Consignee:'';?>">
                              <?php
//Combo box  of Consignee
                            foreach ($data as $row): ?>
                              <option style="display:none"></option>
                              <option><?=$row["Consignee"]?></option>
                            <?php endforeach
// end of combo box of Consignee
                            ?>

                          </SELECT>
                          <?php if (!empty($ConsigneeError)): ?>
                              <span class="help-inline"><?php echo $ConsigneeError;?></span>
                          <?php endif;?>

                        </div>
                      </div>



											<div class="control-group <?php echo !empty($BLNoError)?'error':'';?>">
												<label class="control-label">BLNo</label>
												<div class="controls">
														<input id='textSLcode' name="BLNo" type="text" style="background-color: #99b9ff; color: white;" placeholder="Enter BLNo" value="<?php echo !empty($BLNo)?$BLNo:'';?>">
														<?php if (!empty($BLNoError)): ?>
																<span class="help-inline"><?php echo $BLNoError;?></span>
														<?php endif; ?>
												</div>

											</div>




                              <div class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                                <label class="control-label">Encoded by</label>
                                <div class="controls">
                                    <input Readonly  name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                                    <?php if (!empty($EncodedbyError)): ?>
                                        <span class="help-inline"><?php echo $EncodedbyError;?></span>
                                    <?php endif;?>
                                </div>
                              </div>

                              <div class="control-group <?php echo !empty($EncodedDateBLNoError)?'error':'';?>">
                                <label class="control-label">EncodedDateBLNo</label>
                                <div class="controls">
                                    <input Readonly name="EncodedDateBLNo" type="date"  value="<?php
                                    $currentDateTime = date('Y-m-d');
                                    echo $currentDateTime;
                                    ?>">
                                    <?php if (!empty($EncodedDateBLNoError)): ?>
                                        <span class="help-inline"><?php echo $EncodedDateBLNoError;?></span>
                                    <?php endif;?>

                                </div>
                              </div>

                      <div id="form-transparent" class="form-actions">
												<?php
													if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

				                  }else{
                          echo '<button type="submit"  class="btn btn-primary">Create</button>';
												   }
													?>

                          <a class="btn" href="viewbl.php">Back</a>
													<a class="btn btn-warning" href="createbl.php">Refresh</a>

                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
