
<?php
session_start();
include "../header.php";
 
include_once '../logstat.php';
//    $id_Consignee = 0;
//    $textBL=0;

    if ( !empty($_GET['id_Consignee'])) {
        $id_Consignee = $_REQUEST['id_Consignee'];
    }



    if ( !empty($_POST)) {
        // keep track post values
        $id_Consignee = $_POST['id_Consignee'];


        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_consignee WHERE id_Consignee = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Consignee));
        Database::disconnect();
        header("Location: consignee.php");

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
                        <h3>Delete a Consignee Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_consignee.php" method="post">

                      <input Readonly type="text" name="id_Consignee" value="<?php echo $id_Consignee; ?>"/>

                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger btn-mini">Yes</button>
                          <a class="btn btn-mini" href="consignee.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
