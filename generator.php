<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<center>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" type="text/css" media="screen" href="main/style_main.css" >
<?php

$mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
$key = isset($_REQUEST['key']) ? $_REQUEST['key'] : '';

if($mail != '' && $key != ''){
	include ('config/mysql.inc');
	$query = mysql_query("select user from users where mail='".$mail."' and key_on='".$key."'");
	if(mysql_num_rows($query) == 1){
		echo "<form method='POST' action='generator.php?mail=".$mail."&key=".$key."'>
		<table>
		<tr><td>Has�o:</td><td><input type='password' name='pass'/></td></tr>
		<tr><td>Pon�w has�a:</td><td><input type='password' name='pass2'/></td></tr>
		<tr><td colspan=2 style='text-align:center'><input type='submit' name='save' value='Zapisz Has�a' /></td><tr>
		</table>
		</form>";
	}else{
		echo "b�ad linku";
	}
	mysql_close();
}

if(isset($_POST['save'])){
	if($_POST['pass'] != '' && $_POST['pass2']!=''){
		if($_POST['pass'] == $_POST['pass2']){
			include('config/mysql.inc');
			$pass = base64_encode($_POST['pass']);
			$query = mysql_query("update users set pass='".$pass."', key_on='', active=1, change_pass=1 where mail='".$mail."'");
			if($query){
				echo "Zapisano has�a w bazie";
			}else{
				echo "B��d bazie";
			}
		}else{
			echo "R�ni si� has�a";
		}
	}else{
		echo "wype�nij has��";
	}
}
?>
</html>