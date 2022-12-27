<?php
/* Note: For Migrating to new Server

if you get a Permission Error please run this to your CentOS 7 Terminal

# chcon -R --type httpd_sys_rw_content_t /betty/cheqs_images

 */

   // require 'database.php';
   
   error_reporting(E_ALL);
include "../header.php";
require 'uploader.php';
include_once '../logstat.php';
   
   
   
 
    
    
    $consignee = null;
    $consignee = $_REQUEST['consignee'];

    if ( !empty($_POST)) {
        // keep track validation errors
        $uploader = new Uploader();



        $Encodedby = null;
        $EncodedDate = null;
        $imageError = null;


        // keep track post values

       
        $Encodedby = $_POST['Encodedby'];
        $EncodedDate = $_POST['EncodedDate'];

        // validate input
        $valid = true;

      

        if (empty($Encodedby)) {
            $EncodedbyError = 'Please enter Encodedby';
            $valid = false;
        }

        if (empty($EncodedDate)) {
            $cEncodedDateError = 'Please enter cheqamount Number';
        //    $valid = false;

        }






        if (!empty($_FILES['image']['name']) && !$uploader->valid($_FILES['image']))
    {
        $imageError = 'Invalid file uploaded';
        $valid = false;
    }


        // insert data
       if ($valid) {
            $image = $uploader->upload($_FILES['image']);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tbl_cheq(consignee,lhead,Encodedby,EncodedDate)values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($consignee,$image, $Encodedby,$EncodedDate));
            // Set Messagebox and delay before redirecting to next page using javascript//
            $message = 'Letter Heaad Sucessfully Uploaded!';
            echo "<script type='text/javascript'>alert(' $message '); setTimeout(\"location.href ='consignee_images.php';\",1500);</script>";
            Database::disconnect();
        //    header("Location: viewbl.php");
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

{ margin: 0; padding: 0; }
 }
 #body-background {
     background-color: #dfe3ee;
 }
 #div-background {
     background-color: #ffffff;
 }

 #form-transparent
 {
 background-color: transparent;
 }




 </style>









</head>

<body id="body-background">
    <div id="div-background" class="container">

                  <div class="container-fluid offset1">
                  <br><br> <br> <br> <br> 
                    <div class="row">
                        <h3 class="offset2">Upload Letter Head</h3>
                    </div>
                    <br>
                    <form class="form-horizontal" action="consignee_images.php" method="post" enctype="multipart/form-data">
                        
                        <div class="control-group <?php echo !empty($consigneeError)?'error':'';?>">
                        <label class="control-label">Consignee</label>
                        <div class="controls">
                            <input Readonly name="consignee" type="text"  placeholder="consignee" value="<?php echo !empty($consignee)?$consignee:'';?>">
                            <?php if (!empty($consigneeError)): ?>
                                <span class="help-inline"><?php echo $consigneeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>


                      <div class="control-group <?php echo !empty($imageError) ? 'error' : ''; ?>">
                <label class="control-label">Image</label>
                <div class="controls">
                    <input name="image" type="file" placeholder="File">
                    <?php if (!empty($imageError)): ?>
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

                      <div class="control-group <?php echo !empty($EncodedbyError)?'error':'';?>">
                        <label class="control-label">Encoded by</label>
                        <div class="controls">
                            <input Readonly name="Encodedby" type="text"  placeholder="Encodedby" value="<?php echo !empty($_SESSION['u_uid'])?$_SESSION['u_uid']:'';?>">
                            <?php if (!empty($EncodedbyError)): ?>
                                <span class="help-inline"><?php echo $EncodedbyError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($EncodedDateError)?'error':'';?>">
                        <label class="control-label">Encoded Date</label>
                        <div class="controls">
                            <input Readonly name="EncodedDate" type="date"  placeholder="EncodedDate" value="<?php
                            $currentDateTime = date('Y-m-d');
                            echo $currentDateTime;
                            ?>">
                            <?php if (!empty($EncodedDateError)): ?>
                                <span class="help-inline"><?php echo $EncodedDateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                      
                          <a class="btn btn-warning" href="viewbl.php">Home</a>
                        </div>
                    </form>
                </div>
<br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br>
    </div> <!-- /container -->

  </body>
</html>
