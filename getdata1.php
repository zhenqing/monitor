<?php include 'db_connect.php'; ?>

<?php
$query = "select * from pricehistory where isbn='%s' ";
mysql_real_escape_string($isbn);
$data = mysql_query($query) or die(mysql_error());
$rows = array();
while($r=mysql_fetch_assoc($data)){
	$rows[]=$r;
}
$string = json_encode($rows);
//echo $data;
echo json_encode($rows);
?>
<?php include 'db_close.php'; ?>