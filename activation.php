<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<?php

$nick = isset($_REQUEST['nick']) ? $_REQUEST['nick'] : 'null';
$key = isset($_REQUEST['key']) ? $_REQUEST['key'] : 'null';

if($nick != null && $key != null){
	include ('config/mysql.inc');
	$query = mysql_query("update users set active = 1 where user='".$nick."' and key_on='".$key."'");
	if($query){
		mysql_query("update users set key_on='' where user='".$nick."'");
		echo "Już jeste aktywny do konta";
	}else{
		echo "Bład aktywnacji";
	}
	mysql_close();
}else{
	echo "pusty wartoć";
}
?>
</html>