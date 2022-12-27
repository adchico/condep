
<?php
session_start();
include_once 'logstat.php';
    require 'database.php';
//    $id_contgua = 0;

    if ( !empty($_GET['id_contgua'])) {
        $id_contgua = $_REQUEST['id_contgua'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id_contgua = $_POST['id_contgua'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_contgua WHERE id_contgua = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_contgua));
        Database::disconnect();
        header("Location: view_contgua.php");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

                <div class="span10 offset1">

                    <div class="row">
                        <h3>Delete a Customer</h3>
                    </div>

                    <form class="form-horizontal" action="delete_contgua.php" method="post">

                      <input readonly type="text" name="id_contgua" value="<?php echo $id_contgua; ?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="view_contgua.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
