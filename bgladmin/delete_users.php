
<?php
include "../header.php";
 
include_once '../logstat.php';
//    $user_id  = 0;
//    $textBL=0;

    if ( !empty($_GET['user_id'])) {
        $user_id= $_REQUEST['user_id'];
    }



    if ( !empty($_POST)) {
        // keep track post values
        $user_id= $_POST['user_id'];


        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM users WHERE user_id= ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_id));
        Database::disconnect();
        header("Location: users.php");

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
                        <h3>Delete a city  Details</h3>
                    </div>

                    <form class="form-horizontal" action="delete_users.php" method="post">

                      <input Readonly type="text" name="user_id" value="<?php echo $user_id; ?>"/>

                      <p class="alert alert-error">Are you sure to delete ?</p>

                      <div class="form-actions">

                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn "href="users.php">No</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
