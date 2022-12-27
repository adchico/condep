
<?php
 
include "../header.php";
 
include_once '../logstat.php';
//    $id_Shipline = 0;
//    $textBL=0;

    if ( !empty($_GET['id_Shipline'])) {
        $id_Shipline = $_REQUEST['id_Shipline'];
    }



    if ( !empty($_POST)) {
        // keep track post values
        $id_Shipline = $_POST['id_Shipline'];


        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tbl_shippingline WHERE id_Shipline = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_Shipline));
        Database::disconnect();
        header("Location: shippingline.php");

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
                        <h3>Delete a ShippingLine Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_shippingline.php" method="post">

                      <input Readonly type="text" name="id_Shipline" value="<?php echo $id_Shipline; ?>"/>

                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger btn-mini">Yes</button>
                          <a class="btn btn-mini" href="shippingline.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
