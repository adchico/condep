<?php


$pdo = Database::connect();
//$GlobalBLNo = $_POST['textBL'];
$sqlDep = "SELECT * FROM tbl_blcreate WHERE BLNo = '" . $DepBLNoCD . "'";
foreach ($pdo->query($sqlDep) as $row) {
//echo  '<label align=right>BL No</label> <div>' . $row['BLNo'] . '</div>';
//echo '<div></div>';echo '<div></div>';

echo  '<label align=right>Consignee</label> <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['Consignee'] . '</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Forwarder</label> <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['Forwarder'] .'</div>';
echo '<div></div>';echo '<div></div>';
echo  '<label align=right>Shipping Line</label> <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row['ShippingLine'] .'</div>';
echo '<div></div>';echo '<div></div>';
echo '<div></div>';echo '<div></div>';

}
Database::disconnect();

?>
<html>
<head>
  <meta charset="utf-8">
  <link   href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <script src="jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>
<body>
</body>
</html>
