
<?php
session_start();
include_once 'logstat.php';
//    require 'database.php';
//    $id_BLNo = 0;

    if ( !empty($_GET['id_BLNo'])) {
        $id_BLNo = $_REQUEST['id_BLNo'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id_BLNo = $_POST['id_BLNo'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_blcreate  WHERE id_BLNo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_BLNo));
        Database::disconnect();
        header("Location: viewbl.php");

    }
?>
<!DOCTYPE html>
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
                        <h3>Delete a Customer</h3>
                    </div>

                    <form class="form-horizontal" action="delete.php" method="post">

                      <input type="text" name="id_BLNo" value="<?php echo $id_BLNo; ?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="viewbl.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
