<?php
session_start();
if(isset($_POST['function'])){
	switch($_POST['function']){
		case "account":
			$n = $_POST['nick'];
			$nn = mb_strtolower($n, "UTF-8");
			$p = $_POST['pass'];
			$pp = base64_encode($p);
			include('../config/mysql.inc');
			$query = mysql_query("select * from users where user='".$nn."' and pass='".$pp."' and active=1");
			if(mysql_num_rows($query) == 1){
				if($nn == "admin"){
					$_SESSION['Account'] = "Admin";
				}else{
					$_SESSION['Account'] = "User";
				}
				while ($row = mysql_fetch_assoc($query)) {
					$change_pass = $row["change_pass"];
				}
				$_SESSION['change_pass'] = $change_pass;
				$_SESSION['nick'] = $nn;
				$_SESSION['reserv'] = 1;
				$query1 = mysql_query("select ID from users_adres where user='".$nn."'");
					while ($roww = mysql_fetch_assoc($query1)){
						$ID_C = $roww["ID"];
					}
				$_SESSION['ID_C'] = $ID_C;
				$ok['stan'] = 1;
				
			}else{
				$ok['stan'] = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "logout":
			$_SESSION['Account'] = "None";
			session_destroy();
			$ok['stan'] = 1;
			echo json_encode($ok);
		break;
		
		case "session":
			if($_SESSION['Account'] == "Admin" || $_SESSION['Account'] == "User"){
				$stan['ok'] = 1;
			}else{
				$stan['ok'] = 0;
			}
			echo json_encode($stan);
		break;
		
		case "save_pass":
			$nick = $_SESSION['nick'];
			$p = $_POST['pass'];
			$pp = base64_encode($p);
			include('../config/mysql.inc');
			$query = mysql_query("update users set pass='".$pp."', change_pass=1 where user='".$nick."'");
			if($query){
				$ok = 1;
				$_SESSION['change_pass'] = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "reserv";
			$i = 0;
			$date = $_POST['date'];
			if($_SESSION['reserv']){
				if($_SESSION['reserv'] == 1){
					include('../config/mysql.inc');
					$query = mysql_query("select * from reservations");
					while ($roww = mysql_fetch_assoc($query)){
						$ID[$i] = $roww["Data_accept"];
						$IDD[$i] = $roww['ID'];
						$mag[$i] = $roww['ID_M'];
						$i++;
					}
					for($j=0;$j<$i;$j++){
						if($ID[$j] < $date){
							mysql_query("delete from reservations where ID=".$IDD[$j]);
							mysql_query("update magazine set stan=1 where ID=".$mag[$j]);
						}
					}
					mysql_close();
				}
			}			
			echo json_encode($i);
		break;
		
		default:
		break;
	
	}







}

?>