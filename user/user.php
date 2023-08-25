<?php
session_start();
if(isset($_POST['function'])){
	switch($_POST['function']){
		case "my_account":
			include('../config/mysql.inc');
			$query = "select * from users_adres where user='".$_SESSION['nick']."'";
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
					if($info->name == 'user'){
						$user = $row[$info->name];
						$q = mysql_query("select mail from users where user='".$user."'");
						while ($roo = mysql_fetch_assoc($q)) {
							$mail = $roo["mail"];
						}
						$row['mail'] = $mail;
					}
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rows[] = $row;
			}
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "my_rangle":
			$s_nick = $_SESSION['nick'];
			include('../config/mysql.inc');
			$query1 = mysql_query("select ID from users_adres where user='".$s_nick."'");
			while ($rowss = mysql_fetch_assoc($query1)) {
				$nick = $rowss["ID"];
			}
			
			$query = "select * from rental_office where ID_C=".$nick;
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
					
					if($info->name == 'ID_M'){
						$mag= $row[$info->name];
						$query1 = mysql_query("select * from magazine where ID=".$mag);
						while ($roww = mysql_fetch_assoc($query1)){
							$row['prod'] = $roww["prod"];
							$row['model'] = $roww["model"];
							$row['cena'] = $roww["cena"];
							$category = $roww["ID_cat"];
						}
						
						$query1 = mysql_query("select name from category where ID=".$category);
						while ($roww = mysql_fetch_assoc($query1)){
							$row['cat'] = $roww["name"];
						}
					}
					
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rows[] = $row;
			}
			if($rows){
				$stan['row'] = 1;
			}else{
				$stan['row'] = 0;
			}
			$stan['list'] = $rows;
			
			mysql_close();
			echo json_encode($stan);
		break;
		
		case "view_magazine":
			$id_c = $_POST['id_c'];
			include ('../config/mysql.inc');
			$query = 'select * from magazine where stan=1';
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
			
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rows[] = $row;
			}
			
			$query = 'select * from category';
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
			
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rowss[] = $row;
			}
			$r['mag'] = $rows;
			$r['cat'] = $rowss;
			
			$query1 = mysql_query("select * from reservations where ID_C=".$_SESSION['ID_C']);
			if(mysql_num_rows($query1)){
				$r['row_reserv'] = mysql_num_rows($query1);
			}else{
				$r['row_reserv'] = $id_c;
			}			
			mysql_close();
			echo json_encode($r);
		break;
		
		case "save_reserve":
			$id = $_POST['id_m'];
			$id_c = $_POST['id_c'];
			$dw = $_POST['dw'];
			
			include('../config/mysql.inc');
			$query = mysql_query("insert into reservations values ('','".$id."','".$id_c."','".$dw."')");
			$query1 = mysql_query("update magazine set stan=0 where ID=".$id);
			if($query && $query1){
				$ok = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "my_reserv":
			include('../config/mysql.inc');
			$query = "select * from reservations where ID_C=".$_SESSION['ID_C'];
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
			
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rows1[] = $row;
			}
			
			
			$query = 'select * from magazine where stan=0';
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
			
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rows2[] = $row;
			}
			
			$query = 'select * from category';
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
			
					// cast for real
					if ($type == 'real')
						$row[$info->name] = doubleval($row[$info->name]);
					// cast for int
					if ($type == 'int')
						$row[$info->name] = intval($row[$info->name]);
				}
				$rows3[] = $row;
			}
			
			$r['reserv'] = $rows1;
			$r['mag'] = $rows2;
			$r['cat'] = $rows3;
			mysql_close();
			
			echo json_encode($r);
		break;
		
		case "del_my_reserv":
			$id = $_POST['id'];
			include('../config/mysql.inc');
			$query = mysql_query("select * from reservations where ID=".$id);
			while ($roww = mysql_fetch_assoc($query)){
				$id_m = $roww["ID_M"];
			}
			$query = mysql_query("update magazine set stan=1 where ID=".$id_m);
			$query1 = mysql_query("delete from reservations where ID=".$id);
			if($query && $query1){
				$ok = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
	
	}

}



?>