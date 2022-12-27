<!DOCTYPE html>


<?php

//include'database.php';


//  include_once 'top.php';

include_once 'header.php';
include_once 'logstat.php';



    $id_BLNo = null;
    if ( !empty($_GET['id_BLNo'])) {
        $id_BLNo = $_REQUEST['id_BLNo'];
    }

    if ( null==$id_BLNo) {
        header("Location: viewbl.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $BLNoError = null;
        $ConsigneeError = null;
        $ForwarderError = null;
        $ShippingLineError = null;
        $EncodedbyError = null;
        $EncodedDateBLNoError = null;

        // keep track post values
        $BLNo = $_POST['BLNo'];
        $Consignee = $_POST['Consignee'];
        $Forwarder = $_POST['Forwarder'];
        $ShippingLine = $_POST['ShippingLine'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDateBLNo = $_POST['EncodedDateBLNo'];


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

        if (empty($EncodedDateBLNo )) {
            $EncodedDateBLNoError = 'Please enter Encoded Date BLNo';
            $valid = false;
        }




        // update data

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE tbl_blcreate SET  BLNo = ?, Consignee = ?, Forwarder = ?, ShippingLine = ?, Encodedby = ?, EncodedDateBLNo = ? WHERE id_BLNo= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($BLNo, $Consignee , $Forwarder, $ShippingLine, $Encodedby, $EncodedDateBLNo, $id_BLNo));
            $DepBLNo = $BLNo;

            $pdodep = Database::connect();
            $pdodep->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqldep= "UPDATE tbl_deposit SET DepBLNo = '$DepBLNo' WHERE id_BLNo= '".$id_BLNo."'";
            $qdep = $pdodep->prepare($sqldep);
            $qdep->execute(array($DepBLNo));




        //    foreach ($pdo->query($sqlDep) as $row) {
        Database::disconnect();
        header("Location: viewbl.php");
        }
      } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_blcreate where id_BLNo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_BLNo));
        $data = $q->fetch(PDO::FETCH_ASSOC);

    //    $id_BLNo = $data['id_BLNo'];
        $BLNo =  $data['BLNo'];
        $Consignee =  $data['Consignee'];
        $Forwarder =  $data['Forwarder'];
        $ShippingLine =  $data['ShippingLine'];
        $Encodedby = $data['Encodedby'];
        $EncodedDateBLNo =  $data['EncodedDateBLNo'];

        Database::disconnect();
        }

?>





<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        { margin: 0; padding: 0; }

        #bgimage {
            background-position: left top;
            background: url('img/background-trans.jpg')no-repeat center center fixed;;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        #form-transparent
        {
        background-color: transparent;
        }
        #body-background {
            background-color: #dfe3ee;
        }
        #div-background {
            background-color: #ffffff;
        }

    </style>
</head>

<body id="body-background">
  <br><br>   <br><br>
    <div  class="container">


                <div class="span10 offset1">

                    <div class="row">
                       <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update BL Information</h3>
                    </div>
                    <br><br>
                    <form class="form-horizontal" action="update.php?id_BLNo=<?php echo $id_BLNo?>" method="post">

                      <div class="control-group <?php echo !empty($BLNoError)?'error':'';?>">
                        <label class="control-label">BLNo</label>
                        <div class="controls">
                            <input name="BLNo" type="text"  placeholder="BLNo" value="<?php echo !empty($BLNo)?$BLNo:'';?>">
                            <?php if (!empty($BLNoError)): ?>
                                <span class="help-inline"><?php echo $BLNoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($ConsigneeError)?'error':'';?>">
                        <label class="control-label">Consignee</label>
                        <div class="controls">
                          <?php
    //Combo box of Consignee db connection

                          $pdo = Database::connect();
                          $smt_Consignee = $pdo->prepare('SELECT Consignee From tbl_consignee');
                          $smt_Consignee->execute();
                          $data_Consignee = $smt_Consignee->fetchAll();
                          ?>

<!- Select of Consignee ->
                            <SELECT name="Consignee" type="text" placeholder="Consignee" value="<?php echo !empty($Consignee)?$Consignee:'';?>">
                                <option value="<?php echo $Consignee;?>" selected><?php echo $Consignee;?></option>
                                <?php
                                //Combo box  of Consignee
                                foreach ($data_Consignee as $row): ?>
                                  <option><?=$row["Consignee"]?></option>
                                <?php endforeach;
                                Database::disconnect(); ?>

                              </SELECT>
                            <?php if (!empty($ConsigneeError)): ?>
                                <span class="help-inline"><?php echo $ConsigneeError;?></span>
                            <?php endif;

                            ?>
                        </div>
                      </div>


                      <div class="control-group <?php echo !empty($ShippingLineError)?'error':'';?>">
                                            <label class="control-label">ShippingLine</label>
                                            <div class="controls">

                        <?php
                      //Combo box of ShippingLine db connection

                        $pdo = Database::connect();
                        $smt_ShippingLine = $pdo->prepare('SELECT ShippingLine From tbl_shippingline ORDER BY ShippingLine ASC');
                        $smt_ShippingLine->execute();
                        $data_ShippingLine = $smt_ShippingLine->fetchAll();
                        ?>

                      <!- Select of ShippingLine ->
                          <SELECT name="ShippingLine" type="text" placeholder="ShippingLine" value="<?php echo !empty($ShippingLine)?$ShippingLine:'';?>">
                              <option value="<?php echo $ShippingLine;?>" selected><?php echo $ShippingLine;?></option>
                              <?php
                              //Combo box  of ShippingLine
                              foreach ($data_ShippingLine as $row): ?>
                                <option><?=$row["ShippingLine"]?></option>
                              <?php endforeach;
                              Database::disconnect(); ?>

                            </SELECT>
                          <?php if (!empty($ShippingLineError)): ?>
                              <span class="help-inline"><?php echo $ShippingLineError;?></span>
                          <?php endif;

                          ?>
                      </div>
                      </div>



                      <div class="control-group <?php echo !empty($ForwarderError)?'error':'';?>">
                        <label class="control-label">Forwarder</label>
                        <div class="controls">

                      <?php
//Combo box of Consignee db connection

                      $pdo = Database::connect();
                      $smt_forwarder = $pdo->prepare('SELECT Forwarder From tbl_forwarder');
                      $smt_forwarder->execute();
                      $data_forwarder = $smt_forwarder->fetchAll();
                      ?>

<!- Select of Forwarder ->
                        <SELECT name="Forwarder" type="text"  placeholder="Forwarder" value="<?php echo !empty($Forwarder)?$Forwarder:'';?>">
                            <option value="<?php echo $Forwarder;?>" selected><?php echo $Forwarder;?></option>

                        <?php //Combo box  of Forwarder
                        foreach ($data_forwarder as $row): ?>
                          <option><?=$row["Forwarder"]?></option>
                        <?php endforeach;
                        Database::disconnect();
                        ?>
                    </SELECT>
                    <?php if (!empty($ForwarderError)): ?>
                        <span class="help-inline"><?php echo $ForwarderError;?></span>
                    <?php endif;?>
                    </div>
                  </div>







                  <div class="control-group ">
                    <label class="control-label">Encodedby </label>
                    <div class="controls">
                        <input Readonly name="" type="text"  placeholder="Encodedby" value="<?php echo !empty($Encodedby)?$Encodedby: '';?>">

                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">EncodedDateBLNo</label>
                    <div class="controls">
                        <input Readonly name="" type="text"  placeholder="EncodedDateBLNo" value="<?php echo !empty($EncodedDateBLNo)?$EncodedDateBLNo: '';?>">

                      </div>
                    </div>

                  <div style="display: none;" class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                    <label class="control-label">Encodedby NOW</label>
                    <div class="controls">
                        <input Readonly name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                        <?php if (!empty($EncodedbyError)): ?>
                            <span class="help-inline"><?php echo $EncodedbyError;?></span>
                        <?php endif; ?>
                    </div>
                  </div>

                  <div style="display: none;" class="control-group <?php echo !empty($EncodedDateBLNoError)?'error':'';?>">
                    <label class="control-label">EncodedDateBLNo NOW</label>
                    <div class="controls">
                        <input Readonly name="EncodedDateBLNo" type="text"  placeholder="EncodedDateBLNo" value="<?php $currentDateTime = date('Y-m-d');
                        echo $currentDateTime;
                        ?>">
                        <?php if (!empty($EncodedDateBLNoError)): ?>
                            <span class="help-inline"><?php echo $EncodedDateBLNoError;?></span>
                        <?php endif; ?>
                    </div>
                  </div>


                      <div id="form-transparent" class="form-actions">

<?php
                        	if ($_SESSION['u_ulevel']=="VIEWER" || $_SESSION['u_ulevel']=="Viewer" ){

                        }else{
                          echo '<button type="submit" class="btn btn-success">Update</button>';
                        }
?>



                          <a class="btn" href="viewbl.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
