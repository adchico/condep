
<?php
 include "../header.php";
 
include_once '../logstat.php';
//    $id_depstatus  = 0;
//    $textBL=0;

    if ( !empty($_GET['id_depstatus'])) {
        $id_depstatus  = $_REQUEST['id_depstatus'];
    }



    if ( !empty($_POST)) {
        // keep track post values
        $id_depstatus = $_POST['id_depstatus'];


        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_depstatus WHERE id_depstatus = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_depstatus));
        Database::disconnect();
        header("Location: depositstatus.php");

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
                        <h3>Delete a depstatus  Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_depositstatus.php" method="post">

                      <input Readonly type="text" name="id_depstatus" value="<?php echo $id_depstatus; ?>"/>

                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn "href="depositstatus.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
