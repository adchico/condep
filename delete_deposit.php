
<?php
session_start();
include_once 'logstat.php';
//    require 'database.php';
//    $id_Deposit = 0;
//    $textBL=0;

    if ( !empty($_GET['id_Deposit'])) {
        $id_Deposit = $_REQUEST['id_Deposit'];
    }

    if ( !empty($_GET['textBL'])) {
        $textBL = $_REQUEST['textBL'];
        $_SESSION['textBL']= $textBL;
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id_Deposit = $_POST['id_Deposit'];
        $textBL = $_POST['textBL'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_deposit WHERE id_Deposit = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Deposit));
        Database::disconnect();
        header("Location: ViewDeposit.php");

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
                        <h3>Delete a Container Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_deposit.php" method="post">

                      <input type="text" name="id_Deposit" value="<?php echo $id_Deposit; ?>"/>
                      <input type="hidden" name="txtBL" value="<?php echo $textBL; ?>" />
                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="ViewDeposit.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
