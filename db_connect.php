<?php 
$link=mysql_connect("127.0.0.1","root","")or die ('could not connect');
mysql_select_db("inventory") or die(mysql_error());
?>