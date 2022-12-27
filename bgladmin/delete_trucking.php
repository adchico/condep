
<?php
include "../header.php";
 
include_once '../logstat.php';
//    $id_trucking  = 0;
//    $textBL=0;

    if ( !empty($_GET['id_trucking'])) {
        $id_trucking  = $_REQUEST['id_trucking'];
    }



    if ( !empty($_POST)) {
        // keep track post values
        $id_trucking = $_POST['id_trucking'];


        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_trucking WHERE id_trucking = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_trucking));
        Database::disconnect();
        header("Location: trucking.php");

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

    <script type="text/javascript" language="javascript">
          $(document).ready(function(){
            $("input").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            });
            });
    </script>

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
                        <h3>Delete a trucking  Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_trucking.php" method="post">

                      <input Readonly type="text" name="id_trucking" value="<?php echo $id_trucking; ?>"/>

                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn "href="trucking.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
