<?php
include "../header.php";
 
require "../uploader.php";

include_once '../logstat.php';


    if ( !empty($_POST)) {

        // keep track validation errors
        $ConsigneeError = null;
        $ConsigneefullError = null;
        $ContactPersonError = null;
        $DesignationError = null;
        $TelNoError = null;
        $FaxError = null;
        $EmailError = null;
        $AddressError = null;
        $CityError = null;
        $AssignatoryError = null;
        $AssigTitleError = null;
        $AssignatoryAddress = null;
        $AssigStatus = null;
        $TINError = null;
    

        $EncodedbyError = null;
        $EncodedDateError = null;

        // keep track post values
        $Consignee = $_POST['Consignee'];
        $Consigneefull = $_POST['Consigneefull'];
        $ContactPerson = $_POST['ContactPerson'];
        $Designation = $_POST['Designation'];
        $TelNo = $_POST['TelNo'];
        $Fax = $_POST['Fax'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $City = $_POST['City'];
        $Assignatory = $_POST['Assignatory'];
        $AssigTitle = $_POST['AssigTitle'];
        $AssignatoryAddress = $_POST['AssignatoryAddress'];
        $AssigStatus = $_POST['AssigStatus'];
        $TIN = $_POST['TIN'];
      

        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];



        // validate input
        $valid = true;
        if (empty($Consignee)) {
            $ConsigneeError = 'Please enter Consignee';
            $valid = false;
        }

        if (empty($Consigneefull)) {
            $ConsigneefullError = 'Please enter Consigneefull';
            $valid = false;
        }


        if (empty($ContactPerson)) {
            $ContactPersonError = 'Please enter ContactPerson';
            $valid = false;
        }

        if (empty($Designation)) {
            $DesignationError = 'Please enter Designation';
            $valid = false;
        }

        if (empty($TelNo)) {
            $TelNoError = 'Please enter TelNo';
            $valid = false;
        }

        if (empty($Fax)) {
            $FaxError = 'Please enter Fax';
            $valid = false;
        }


        if (empty($Email)) {
            $EmailError = 'Please enter Email';
            $valid = false;
        }

        if (empty($Address)) {
            $AddressError = 'Please enter Address';
            $valid = false;
        }

        if (empty($City)) {
            $CityError = 'Please enter Assignatory';
            $valid = false;
        }


        if (empty($Assignatory)) {
            $AssignatoryError = 'Please enter Assignatory';
            $valid = false;
        }

        if (empty($AssigTitle)) {
            $AssigTitleError = 'Please enter AssigTitle';
            $valid = false;
        }

        if (empty($AssignatoryAddress)) {
            $AssignatoryAddressError = 'Please enter AssignatoryAddress';
            $valid = false;
        }

        if (empty($AssigStatus)) {
            $AssigStatusError = 'Please enter AssigStatus';
            $valid = false;
        }

        if (empty($TIN)) {
            $TINError = 'Please enter TIN';
            $valid = false;
        }

    



        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby Number';
    //      $valid = false;
        }

        if (empty($EncodedDate)) {
            $EncodedDateError = 'Please enter EncodedDate Number';
    //       $valid = false;
        }





        // insert data
        if ($valid) {

            $pdo = Database::connect();

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tbl_consignee (Consignee,Consigneefull,ContactPerson,Designation,TelNo,Fax,Email,Address,City,Assignatory,AssigTitle,AssignatoryAddress,AssigStatus,TIN,Encodedby,EncodedDate) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Consignee,$Consigneefull,$ContactPerson,$Designation,$TelNo,$Fax,$Email,$Address,$City,$Assignatory,$AssigTitle,$AssignatoryAddress,$AssigStatus,$TIN,$Encodedby,$EncodedDate));

            $message = 'You Have Successfully Added '. $Consignee . '!';
            Database::disconnect();
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href = '\consignee.php';\",1500);</script>";


        }
    }


 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="utf-8">
   <link   href="../css/bootstrap.min.css" rel="stylesheet">
   <script src="../js/bootstrap.min.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="../dist/number-divider.min.js"></script>



 <style>
 .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
   background-color: Beige;
 }
 </style>


 </head>




<body>
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3 class="offset2">Create a Consignee</h3>
                    </div>
                    <br>

                    <form class="form-horizontal" action="create_consignee.php" method="post"  >

                      <div class="control-group <?php echo !empty($ConsigneeError)?'error':'';?>">
                        <label class="control-label">Consignee</label>
                        <div class="controls">
                            <input name="Consignee" type="text"  placeholder="Consignee" value="<?php echo !empty($Consignee)?$Consignee:'';?>">
                            <?php if (!empty($ConsigneeError)): ?>
                                <span class="help-inline"><?php echo $ConsigneeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($ConsigneefullError)?'error':'';?>">
                        <label class="control-label">Consignee full Name</label>
                        <div class="controls">
                            <input name="Consigneefull" type="text" placeholder="Consigneefull" value="<?php echo !empty($Consigneefull)?$Consigneefull:'';?>">
                            <?php if (!empty($ConsigneefullError)): ?>
                                <span class="help-inline"><?php echo $ConsigneefullError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($ContactPersonError)?'error':'';?>">
                        <label class="control-label">ContactPerson</label>
                        <div class="controls">
                            <input name="ContactPerson" type="text"  placeholder="Contact Person" value="<?php echo !empty($ContactPerson)?$ContactPerson:'';?>">
                            <?php if (!empty($ContactPersonError)): ?>
                                <span class="help-inline"><?php echo $ContactPersonError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
<!- Begin Here -->

<div class="control-group <?php echo !empty($DesignationError)?'error':'';?>">
  <label class="control-label">Designation</label>
  <div class="controls">
      <input name="Designation" type="text"  placeholder="Designation" value="<?php echo !empty($Designation)?$Designation:'';?>">
      <?php if (!empty($DesignationError)): ?>
          <span class="help-inline"><?php echo $DesignationError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($TelNoError)?'error':'';?>">
  <label class="control-label">TelNo</label>
  <div class="controls">
      <input name="TelNo" type="text"  placeholder="TelNo" value="<?php echo !empty($TelNo)?$TelNo:'';?>">
      <?php if (!empty($TelNoError)): ?>
          <span class="help-inline"><?php echo $TelNoError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($FaxError)?'error':'';?>">
  <label class="control-label">Fax</label>
  <div class="controls">
      <input name="Fax" type="text"  placeholder="Fax" value="<?php echo !empty($Fax)?$Fax:'';?>">
      <?php if (!empty($FaxError)): ?>
          <span class="help-inline"><?php echo $FaxError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($EmailError)?'error':'';?>">
  <label class="control-label">Email</label>
  <div class="controls">
      <input name="Email" type="text"  placeholder="Email" value="<?php echo !empty($Email)?$Email:'';?>">
      <?php if (!empty($EmailError)): ?>
          <span class="help-inline"><?php echo $EmailError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($AddressError)?'error':'';?>">
  <label class="control-label">Address</label>
  <div class="controls">
      <input class="form-control" name="Address" type="text"  placeholder="Address" value="<?php echo !empty($Address)?$Address:'';?>">
      <?php if (!empty($AddressError)): ?>
          <span class="help-inline"><?php echo $AddressError;?></span>
      <?php endif; ?>
  </div>
</div>



<?php
$pdo = Database::connect();
$smt = $pdo->prepare('SELECT * From tbl_city');
$smt->execute();
$data = $smt->fetchAll();
?>


<div class="control-group <?php echo !empty($CityError)?'error':'';?>">
  <label class="control-label">City</label>
  <div class="controls">
      <SELECT name="City" type="text"  placeholder="City" value="<?php echo !empty($City)?$City:'';?>">
        <option value="" Readonly selected>--Choose City--</option>
        <?php foreach ($data as $row): ?>
       <option>  <?=$row["city"]; ?></option>
     <?php  endforeach
        ?>
      </SELECT>
      <?php if (!empty($CityError)): ?>
          <span class="help-inline"><?php echo $CityError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($AssignatoryError)?'error':'';?>">
  <label class="control-label">Assignatory</label>
  <div class="controls">
      <input name="Assignatory" type="text"  placeholder="Assignatory" value="<?php echo !empty($Assignatory)?$Assignatory:'';?>">
      <?php if (!empty($AssignatoryError)): ?>
          <span class="help-inline"><?php echo $AssignatoryError;?></span>
      <?php endif; ?>
  </div>
</div>

<div class="control-group <?php echo !empty($AssigTitleError)?'error':'';?>">
  <label class="control-label">AssigTitle</label>
  <div class="controls">
      <input name="AssigTitle" type="text"  placeholder="AssigTitle" value="<?php echo !empty($AssigTitle)?$AssigTitle:'';?>">
      <?php if (!empty($AssigTitleError)): ?>
          <span class="help-inline"><?php echo $AssigTitleError;?></span>
      <?php endif; ?>
  </div>
</div>






<div class="control-group <?php echo !empty($AssignatoryAddressError)?'error':'';?>">
  <label class="control-label">AssignatoryAddress</label>
  <div class="controls">
      <input name="AssignatoryAddress" type="text"  placeholder="for Notary" value="<?php echo !empty($AssignatoryAddress)?$AssignatoryAddress:'';?>">
      <?php if (!empty($AssignatoryAddressError)): ?>
          <span class="help-inline"><?php echo $AssignatoryAddressError;?></span>
      <?php endif; ?>
  </div>
</div>


<div class="control-group <?php echo !empty($AssigStatusError)?'error':'';?>">
  <label class="control-label">AssigStatus</label>
  <div class="controls">
      <input name="AssigStatus" type="text"  placeholder="for Notary[married/single]" value="<?php echo !empty($AssigStatus)?$AssigStatus:'';?>">
      <?php if (!empty($AssigStatusError)): ?>
          <span class="help-inline"><?php echo $AssigStatusError;?></span>
      <?php endif; ?>
  </div>
</div>


<div class="control-group <?php echo !empty($TINError)?'error':'';?>">
  <label class="control-label">TIN Number</label>
  <div class="controls">
      <input name="TIN" type="text"  placeholder="TIN Number" value="<?php echo !empty($TIN)?$TIN:'';?>">
      <?php if (!empty($TINError)): ?>
          <span class="help-inline"><?php echo $TINError;?></span>
      <?php endif; ?>
  </div>
</div>








<div class="control-group ">
  <label class="control-label">Encodedby </label>
  <div class="controls">
      <input Readonly name="" type="text"  placeholder="Encodedby" value="<?php echo !empty($Encodedby)?$Encodedby: '';?>">

  </div>
</div>

<div class="control-group">
  <label class="control-label">EncodedDate </label>
  <div class="controls">
      <input Readonly name="" type="text"  placeholder="EncodedDate" value="<?php echo !empty($EncodedDate)?$EncodedDate: '';?>">

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

<div style="display: none;" class="control-group <?php echo !empty($EncodedDateError)?'error':'';?>">
  <label class="control-label">EncodedDate NOW</label>
  <div class="controls">
      <input Readonly name="EncodedDate" type="text"  placeholder="EncodedDate" value="<?php $currentDateTime = date('Y-m-d');
      echo $currentDateTime;
      ?>">
      <?php if (!empty($EncodedDateError)): ?>
          <span class="help-inline"><?php echo $EncodedDateError;?></span>
      <?php endif; ?>
  </div>
</div>








                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="consignee.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
