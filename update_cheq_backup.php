<!DOCTYPE html>


<?php
  require 'database.php';
  require 'uploader.php';
  include_once 'header.php';
include_once 'logstat.php';


    $id_cheq = null;
    if ( !empty($_GET['id_cheq'])) {
        $id_cheq = $_REQUEST['id_cheq'];
    }

    if ( null==$id_cheq) {

        header("Location: view_cheq.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $uploader = new Uploader();

        $ShippingLineError = null;
        $ConsigneeError = null;
        $cheqnoError = null;
        $cheqamountError = null;
        $cheqdateError = null;
        $BankInfoError = null;
        $EncodedbyError = null;
        $EncodedDateError = null;
        $imageError = null;

        // keep track post values
        $ShippingLine = $_POST['ShippingLine'];
        $Consignee = $_POST['Consignee'];
        $cheqno = $_POST['cheqno'];
        $cheqamount = $_POST['cheqamount'];
        $cheqdate = $_POST['cheqdate'];
        $BankInfo = $_POST['BankInfo'];
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];
        $image = $_POST['image'];


        $valid = true;

        if (empty($ShippingLine)) {
            $ShippingLineError = 'Please enter ShippingLine';
            $valid = false;
        }

        if (empty($Consignee)) {
            $ConsigneeError = 'Please enter Consignee';
            $valid = false;
        }

        if (empty($cheqno)) {
            $cheqnoError = 'Please enter cheqno Number';
            $valid = false;
        }

        if (empty($cheqamount)) {
            $cheqamountError = 'Please enter cheqamount';
            $valid = false;
        }

        if (empty($cheqdate)) {
            $cheqdateError = 'Please enter cheqdate';
            $valid = false;
        }

        if (empty($BankInfo)) {
            $BankInfoError = 'Please enter BankInfo';
            $valid = false;
        }


        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby';
            $valid = false;
        }

        if (empty($EncodedDate )) {
            $EncodedDateError = 'Please enter Encoded Date ShippingLine';
            $valid = false;
        }


        if (!empty($_FILES['image']['name']) && !$uploader->valid($_FILES['image']))
            {
                $imageError = 'Invalid file uploaded';
                $valid = false;
            }


        // update data

        if ($valid) {

            if (!empty($image)) {
            $uploader->delete($image);
            }
            $image = $uploader->upload($_FILES['image']);

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tbl_cheq SET  ShippingLine = ?, Consignee = ?, cheqno = ?, cheqamount = ?, cheqdate = ?, BankInfo = ?, image = ?,  Encodedby = ?, EncodedDate = ? WHERE id_cheq= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($ShippingLine, $Consignee , $cheqno, $cheqamount, $cheqdate, $BankInfo, $image, $Encodedby, $EncodedDate, $id_cheq));
            Database::disconnect();
            header("Location: view_cheq.php");
            }
            } else {
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT * FROM tbl_cheq where id_cheq = ?";
              $q = $pdo->prepare($sql);
              $q->execute(array($id_cheq));
              $data = $q->fetch(PDO::FETCH_ASSOC);

          //    $id_cheq = $data['id_cheq'];
              $ShippingLine =  $data['ShippingLine'];
              $Consignee =  $data['Consignee'];
              $cheqno =  $data['cheqno'];
              $cheqamount =  $data['cheqamount'];
              $cheqdate =  $data['cheqdate'];
              $BankInfo =  $data['BankInfo'];
              $Encodedby = $data['Encodedby'];
              $EncodedDate =  $data['EncodedDate'];
              $image = $data['image'];

              Database::disconnect();
              }

              ?>





<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <center><h3>Update BL information</h3></center>
                    </div>
                    <form class="form-horizontal" action="update_cheq.php?id_cheq=<?php echo $id_cheq?>" method="post" enctype="multipart/form-data">

                      <div class="control-group <?php echo !empty($ShippingLineError)?'error':'';?>">
                                            <label class="control-label">ShippingLine</label>
                                            <div class="controls">

                        <?php
                      //Combo box of ShippingLine db connection

                        $pdo = Database::connect();
                        $smt_ShippingLine = $pdo->prepare('SELECT ShippingLine From tbl_ShippingLine');
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
                              <?php endforeach ?>
                              // end of combo box of ShippingLine
                            </SELECT>
                          <?php if (!empty($ShippingLineError)): ?>
                              <span class="help-inline"><?php echo $ShippingLineError;?></span>
                          <?php endif;?>
                      </div>
                      </div>



                      <div class="control-group <?php echo !empty($ConsigneeError)?'error':'';?>">
                        <label class="control-label">Consignee</label>
                        <div class="controls">
                          <?php
    //Combo box of Consignee db connection

                          $pdo = Database::connect();
                          $smt_Consignee = $pdo->prepare('SELECT Consignee From tbl_Consignee');
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
                                <?php endforeach ?>
                                // end of combo box of Consignee
                              </SELECT>
                            <?php if (!empty($ConsigneeError)): ?>
                                <span class="help-inline"><?php echo $ConsigneeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>


                      <div class="control-group <?php echo !empty($cheqnoError)?'error':'';?>">
                        <label class="control-label">cheqno</label>
                        <div class="controls">
                            <input name="cheqno" type="text"  placeholder="cheqno" value="<?php echo !empty($cheqno)?$cheqno:'';?>">
                            <?php if (!empty($cheqnoError)): ?>
                                <span class="help-inline"><?php echo $cheqnoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>




                      <div class="control-group <?php echo !empty($cheqamountError)?'error':'';?>">
                              <label class="control-label">cheqamount</label>
                              <div class="controls">
                                  <input class="number" maxlength = "7" name="cheqamount" type="text"  placeholder="cheqamount" value="<?php echo !empty($cheqamount)?$cheqamount:'';?>">

                                  <?php if (!empty($cheqamountError)): ?>
                                      <span class="help-inline"><?php echo $cheqamountError;?></span>
                                  <?php endif;?>
                              </div>
                            </div>


                            <div class="control-group <?php echo !empty($cheqdateError)?'error':'';?>">
                              <label class="control-label">cheqdate</label>
                              <div class="controls">
                                  <input name="cheqdate" type="date"  placeholder="cheqdate" value="<?php echo !empty($cheqdate)?$cheqdate:'';?>">
                                  <?php if (!empty($cheqdateError)): ?>
                                      <span class="help-inline"><?php echo $cheqdateError;?></span>
                                  <?php endif;?>
                              </div>
                            </div>




                      <div class="control-group <?php echo !empty($BankInfoError)?'error':'';?>">
                        <label class="control-label">Bank Info</label>
                        <div class="controls">

                      <?php
//Combo box of Consignee db connection

                      $pdo = Database::connect();
                      $smt_Banklist = $pdo->prepare('SELECT BankCode From tbl_banklist');
                      $smt_Banklist->execute();
                      $data_Banklist = $smt_Banklist->fetchAll();
                      ?>

<!- Select of BankInfo ->
                        <SELECT name="BankInfo" type="text"  placeholder="BankInfo" value="<?php echo !empty($BankInfo)?$BankInfo:'';?>">
                            <option value="<?php echo $BankInfo;?>" selected><?php echo $BankInfo;?></option>

                        <?php
//Combo box  of BankInfo

                        foreach ($data_Banklist as $row): ?>

                          <option><?=$row["BankCode"]?></option>
                        <?php endforeach
// end of combo box of BankInfo
                        ?>
                    </SELECT>
                    <?php if (!empty($BankInfoError)): ?>
                        <span class="help-inline"><?php echo $BankInfoError;?></span>
                    <?php endif;?>
                    </div>
                  </div>







                      <div class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                        <label class="control-label">Encodedby</label>
                        <div class="controls">
                            <input name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                            <?php if (!empty($EncodedbyError)): ?>
                                <span class="help-inline"><?php echo $EncodedbyError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($EncodedDateError)?'error':'';?>">
                        <label class="control-label">EncodedDate</label>
                        <div class="controls">
                            <input name="EncodedDate" type="date"  placeholder="EncodedDate" value="<?php echo !empty($EncodedDate)?$EncodedDate:'';?>">
                            <?php if (!empty($EncodedDateError)): ?>
                                <span class="help-inline"><?php echo $EncodedDateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($imageError) ? 'error' : ''; ?>">
                      <label class="control-label">Image</label>
                      <div class="controls">
                      <input name="image" type="file" placeholder="File">
                      <input name="image" type="hidden" value="<?php echo $image; ?>">
                      <?php if (!empty($imageError)): ?>
                      <span class="help-inline"><?php echo $imageError; ?></span>
                      <?php endif; ?>
                      </div>
                      </div>


                      <?php if (!empty($image)): ?>
                      <div class="control-group">
                      <div class="controls">
                      <img src="<?php echo $image; ?>" class="thumbnail"/>
                      </div>
                      </div>
                      <?php endif; ?>


                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="view_cheq.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
