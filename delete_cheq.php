
<?php
session_start();
include_once 'logstat.php';
//   require 'database.php';
//    $id_cheq = 0;

    if ( !empty($_GET['id_cheq'])) {
        $id_cheq = $_REQUEST['id_cheq'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id_cheq = $_POST['id_cheq'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_cheq  WHERE id_cheq = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_cheq));


        Database::disconnect();

        header("Location: view_cheq.php");

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

                    <form class="form-horizontal" action="delete_cheq.php" method="post">

                      <input type="hidden" name="id_cheq" value="<?php echo $id_cheq; ?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="view_cheq.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
