
<?php
include "../header.php";
 
include_once '../logstat.php';
//    $id_bank  = 0;
//    $textBL=0;

    if ( !empty($_GET['id_bank'])) {
        $id_bank  = $_REQUEST['id_bank'];
    }



    if ( !empty($_POST)) {
        // keep track post values
        $id_bank = $_POST['id_bank'];


        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_banklist WHERE id_bank = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_bank));
        Database::disconnect();
        header("Location: banklist.php");

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
                        <h3>Delete a banklist  Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_banklist.php" method="post">

                      <input Readonly type="text" name="id_bank" value="<?php echo $id_bank; ?>"/>

                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn "href="banklist.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
