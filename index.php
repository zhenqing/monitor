<META HTTP-EQUIV=Refresh CONTENT='5; URL=index.php'>
<style type="text/css">
table
{
border-collapse:collapse;
}
table,th, td
{
border: 1px solid black;
}
td, th {
  width: 4rem;
  height: 2rem;
  border: 1px solid #ccc;
  text-align: center;
}
th {
  background: lightblue;
  border-color: white;
}
</style>

<?php include 'db_connect.php'; ?>
<table>
	 <thead>
    <tr>
      <th>program</th>
      <th>start</th>
      <th>current</th>
      <th>amount</th>
      <th>hour</th>
      <th>min</th>
      <th>rate</th>
    </tr>
  </thead>
<?php
$query_index = "select i.name as name,i.value as current, m.sid as start, i.value-m.sid as amount,m.time as starttime,TIMESTAMPDIFF(HOUR,m.time,NOW()) as hour,TIMESTAMPDIFF(MINUTE,m.time,NOW()) as minute, TIMESTAMPDIFF(MINUTE,m.time,NOW())-60*TIMESTAMPDIFF(HOUR,m.time,NOW()) as min from indexposition i,(SELECT n.program,n.sid,n.time
FROM monitor n
INNER JOIN(
  SELECT program, MAX(time) AS time
  FROM monitor
  GROUP BY program
) AS t1 USING(program, time)) m where i.name = m.program";
$data_index = mysql_query($query_index) or die(mysql_error());

while($r=mysql_fetch_assoc($data_index)){
	$rate = floor($r["amount"]/$r["minute"]);
?>
<tr>
	<td><?php echo $r["name"];?></td>
	<td><?php echo $r["start"];?></td>
	<td><?php echo $r["current"];?></td>
	<td><?php echo $r["amount"];?></td>
	<td><?php echo $r["hour"];?></td>
	<td><?php echo $r["min"];?></td>
	<td><?php echo $rate;?></td>
	
</tr>
<?php
}	
?>
</table>


