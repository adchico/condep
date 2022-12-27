<?php
//include "../database.php";
include "../header.php";
include_once '../logstat.php';
$user_id = null;
if ( !empty($_GET['user_id'])) {
    $user_id = $_REQUEST['user_id'];
}

if (isset($_POST['Submit'])) {

move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" . $_FILES["image"]["name"]);
$location=$_FILES["image"]["name"];
$user_id=$_POST['user_id'];

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO tbl_image (user_id, image_location)
VALUES ('$user_id', '$location')";

$pdo->exec($sql);
echo "<script>alert('Successfully Added!!!'); window.location='index.php'</script>";
// }
}
// }

?>



    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    <h3 id="myModalLabel">Add</h3>
    </div>
    <div class="modal-body">
    <form method="post" action="upload.php"  enctype="multipart/form-data">
    <table class="table1">

    	<tr>
    		<td><label style="color:#3a87ad; font-size:18px;">user_id</label></td>
    		<td width="30"></td>
    		<td><input Readonly type="text" name="user_id" placeholder="user_id" /></td>
    	</tr>


    	<tr>
    		<td><label style="color:#3a87ad; font-size:18px;">Select your Image</label></td>
    		<td width="30"></td>
    		<td><input type="file" name="image"></td>
    	</tr>
    </table>
        </div>
        <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="submit" name="Submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
    </div>
