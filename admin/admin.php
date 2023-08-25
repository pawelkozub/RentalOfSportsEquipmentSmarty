<?php
session_start();
if(isset($_POST['function'])){
	switch($_POST['function']){
		case "view_category":
			include('../config/mysql.inc');
			
			$query = 'select * from category order by name asc';
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "save_category":
			$name = $_POST['name'];
			include('../config/mysql.inc');
			
			$q = mysql_query("select * from category where name='".$name."'");
			if(mysql_num_rows($q) == 0){
				mysql_query("insert into category values ('','".$name."')");
				$query = mysql_query("select * from category where name='".$name."'");
				if(mysql_num_rows($query) == 1){
					$ok = 1;
				}else{
					$ok = 0;
				}
			}else{
				$ok = 0;
			}
			
			mysql_close();
			
			echo json_encode($ok);
		break;
		
		case "select_edit_row_cat";
			$id = $_POST['ID'];
			include ('../config/mysql.inc');
			
			$query = 'select * from category where ID="'.$id.'"';
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "select_del_row_cat";
			$id = $_POST['ID'];
			include('../config/mysql.inc');
			$query = mysql_query('select * from magazine where ID_cat='.$id);
			if($query){
				$ile = mysql_num_rows($query);
				$ok['check'] = 1;
				if($ile == 0){
					$ok['empty_cat'] = 1;
					$query = mysql_query('delete from category where ID='.$id);
					if($query){
						$ok['stan'] = 1;
					}else{
						$ok['stan'] = 0;
					}
				}else{
					$ok['empty_cat'] = 0;
				}
			}else{
				$ok['check'] = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "save_edit_cat":
			$names = $_POST['names'];
			$id = $_POST['ID'];
			include('../config/mysql.inc');
			$spr = mysql_query("select * from category where name='".$names."'");
			if(mysql_num_rows($spr)==0){
				$query = mysql_query("update category set name='".$names."' where ID=".$id."");
				if($query){
					$ok = 1;
				}else{
					$ok = 0;
				}
			}else{
				$ok = 0;
			}
			
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "save_mag":
			$kat = $_POST['kat'];
			$prod = $_POST['prod'];
			$model = $_POST['model'];
			$opis = $_POST['opis'];
			$cena = $_POST['cena'];
			include ('../config/mysql.inc');
			$query = mysql_query("insert into magazine values ('','".$kat."','".$prod."','".$model."','".$opis."','".$cena."','1')");
			if($query){
				$ok = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "view_magazine":
			include ('../config/mysql.inc');
			$query = 'select * from magazine ';
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
			mysql_close();
			echo json_encode($r);
		break;
		
		case "select_edit_row_mag":
			$id = $_POST['ID'];
			
			include ('../config/mysql.inc');
			$query = "select * from magazine where ID=".$id;
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
			echo json_encode($rows);
		break;
		
		case "delete_edit_mag":
			$id = $_POST['ID'];
			include('../config/mysql.inc');
			$query = mysql_query("delete from magazine where ID=".$id);
			if($query){
				$ok = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "save_edit_mag":
			$kat = $_POST['kat'];
			$prod = $_POST['prod'];
			$model = $_POST['model'];
			$opis = $_POST['opis'];
			$cena = $_POST['cena'];
			$id = $_POST['id'];
			include ('../config/mysql.inc');
			$query = mysql_query("update magazine set ID_cat='".$kat."' , prod='".$prod."' , model='".$model."' , opis='".$opis."', cena='".$cena."' where id=".$id);
			if($query){
				$ok = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
			
			
		case "check_account":
			$mail = $_POST['mail'];
			$nick = $_POST['nick'];
			include ('../config/mysql.inc');
			$query = mysql_query("select ID from users where user='".$nick."'");
			$ok['nick'] = (mysql_num_rows($query) == 0? 1 : 0);
			$query = mysql_query("select ID from users where mail='".$mail."'");
			$ok['mail'] = (mysql_num_rows($query) == 0 ? 1 : 0);
			mysql_close();
			echo json_encode($ok);
		break;

		case "save_account":
			$name = $_POST['name'];
			$name2 = $_POST['name2'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$nick = $_POST['nick'];
			$mail = $_POST['mail'];
			include ('../config/mysql.inc');
			$query = mysql_query("insert into users_adres values ('','".$nick."','".$name."','".$name2."','".$street."','".$city."')");
			if($query){
				$ok['adres'] = 1;
			}else{
				$ok['adres'] = 0;	
			}
			
			$dlugosc1=8;
			$dlugosc2 = 30;
			$tablica="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWYZ";
			srand((double)microtime() * 1000000);  //inicjuje generator liczb losowych
			while (strlen($haslo1) < $dlugosc1){
				$znak=$tablica[rand(0,strlen($tablica)-1)];
				if(!is_integer(strpos($haslo1,$znak))) $haslo1.=$znak;
			}
			$haslo11 = base64_encode($haslo1);
			while (strlen($haslo2) < $dlugosc2){
				$znak=$tablica[rand(0,strlen($tablica)-1)];
				if(!is_integer(strpos($haslo2,$znak))) $haslo2.=$znak;
			}
			
			$query = mysql_query("insert into users values ('','".$nick."','".$haslo11."','".$mail."',0,0,'".$haslo2."')");
			if($query){
				$ok['user'] = 1;
			}else{
				$ok['user'] = 0;	
			}
			mysql_close();
			
			$link = "http://agh.ugu.pl/II/activation.php?nick=".$nick."&key=".$haslo2;
			
			require_once('../PHPMailerv5/class.phpmailer.php');
			//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

			$mailer = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

			$mailer->IsSMTP(); // telling the class to use SMTP
			
			//try{
			$mailer->Host       = "mail.ugu.pl"; // SMTP server
			$mailer->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			$mailer->SMTPAuth   = true;                  // enable SMTP authentication
			$mailer->Host       = "mail.ugu.pl"; // sets the SMTP server
			$mailer->Port       = 587;                    // set the SMTP port for the GMAIL server
			$mailer->Username   = "noreply@agh.ugu.pl"; // SMTP account username
			$mailer->Password   = "projektagh";        // SMTP account password
			$mailer->AddReplyTo('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			$mailer->AddAddress($mail, $nick);
			$mailer->SetFrom('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			$mailer->AddReplyTo('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			$mailer->CharSet = 'UTF-8';
			$mailer->Subject = 'Dzi?kuje utowrzy?e? konta';
			$mailer->MsgHTML("<html><meta charset='UTF-8'> Witaj ".$nick."!! <br />Nick: ".$nick."<br /> Has?o: ".$haslo1." <br /> Aktywnacji konta: <a href='".$link."'>".$link."</a> <br /><br /> Dzi?kujemy <br /> Wypo?yczalnia Sprz?t?w Sportowych");
			if($mailer->Send()){
			$ok['mail'] = 1;
			}else{
			$ok['mail'] = 0;
			}
			echo json_encode($ok);
		break;
		
		case "view_account":
			include('../config/mysql.inc');
			$query = 'select * from users_adres order by surname asc';
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
		
		case "select_edit_row_adr";
			include('../config/mysql.inc');
			$query = 'select * from users_adres where ID='.$_POST['ID'];
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "select_edit_row_acc":
			$id = $_POST['ID'];
			include('../config/mysql.inc');
			$query = mysql_query("select user from users_adres where ID=".$id);
			while ($row = mysql_fetch_assoc($query)) {
				$user = $row["user"];
			}
			
			$query = mysql_query("select mail from users where user='".$user."'");
			while ($row = mysql_fetch_assoc($query)) {
				$user = $row["mail"];
			}
			
			echo json_encode($user);
		break;
		
		case "del_acc":
			$id_c = $_POST['ID'];
			include('../config/mysql.inc');
			$query = mysql_query("select * from users_adres where ID=".$id_c);
			while ($row = mysql_fetch_assoc($query)) {
				$user = $row["user"];
			}
			$query = mysql_query("select * from rental_office where ID_C=".$id_c);
			if($query){
				$ok['stan'] = 1;
				if(mysql_num_rows($query) == 0){
					$ok['empty_ren'] = 1;
					$query = mysql_query("delete from users where user='".$user."'");
					$query1 = mysql_query("delete from users_adres where ID=".$id_c);
					if($query && $query1){
						$ok['del'] = 1;
					}else{
						$ok['del'] = 0;
					}
				}else{
					$ok['empty_ren'] = 0;
				}
			}else{
				$ok['stan'] = 0;
			}
			mysql_close();
			echo json_encode($ok);
		break;
		
		case "generator":
			$mail = $_POST['mail'];
			include('../config/mysql.inc');
			$dlugosc2 = 30;
			$tablica="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWYZ";
			srand((double)microtime() * 1000000);  //inicjuje generator liczb losowych
			
			while (strlen($haslo2) < $dlugosc2){
				$znak=$tablica[rand(0,strlen($tablica)-1)];
				if(!is_integer(strpos($haslo2,$znak))) $haslo2.=$znak;
			}
			
			//$query = mysql_query("insert into users values ('','".$nick."','".$haslo11."','".$mail."',0,'".$haslo2."')");
			$query = mysql_query("update users set key_on='".$haslo2."' where mail='".$mail."'");
			if($query){
				$user = 1;
			}else{
				$user = 0;	
			}
			mysql_close();
			
			$link = "http://agh.ugu.pl/II/generator.php?mail=".$mail."&key=".$haslo2;
			
			require_once('../PHPMailerv5/class.phpmailer.php');
			//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

			$mailer = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

			$mailer->IsSMTP(); // telling the class to use SMTP
			
			//try{
			$mailer->Host       = "mail.ugu.pl"; // SMTP server
			$mailer->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			$mailer->SMTPAuth   = true;                  // enable SMTP authentication
			$mailer->Host       = "mail.ugu.pl"; // sets the SMTP server
			$mailer->Port       = 587;                    // set the SMTP port for the GMAIL server
			$mailer->Username   = "noreply@agh.ugu.pl"; // SMTP account username
			$mailer->Password   = "projektagh";        // SMTP account password
			$mailer->AddReplyTo('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			$mailer->AddAddress($mail, $nick);
			$mailer->SetFrom('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			$mailer->AddReplyTo('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			$mailer->CharSet = 'UTF-8';
			$mailer->Subject = 'Generator Has?a';
			$mailer->MsgHTML("<html><meta charset='UTF-8'> Witaj!! <br /> Generator has??: <a href='".$link."'>".$link."</a> <br />  <br /><br /> Dzi?kujemy <br /> Wypo?yczalnia Sprz?t?w Sportowych");
			if($mailer->Send()){
				$mail = 1;
			}else{
				$mail = 0;
			}
			if($user == 1 && $mail == 1){
				$ok['stan'] = 1;
			}else{
				$ok['stan'] = 0;
			}
			echo json_encode($ok);
		break;
		
		case "activation":
			$mail = $_POST['mail'];
			include('../config/mysql.inc');
			$query = mysql_query("select user from users where mail='".$mail."'");
			while ($row = mysql_fetch_assoc($query)) {
				$nick = $row["user"];
			}
			
			$dlugosc1=8;
			$dlugosc2 = 30;
			$tablica="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWYZ";
			srand((double)microtime() * 1000000);  //inicjuje generator liczb losowych
			while (strlen($haslo1) < $dlugosc1){
				$znak=$tablica[rand(0,strlen($tablica)-1)];
				if(!is_integer(strpos($haslo1,$znak))) $haslo1.=$znak;
			}
			$haslo11 = base64_encode($haslo1);
			while (strlen($haslo2) < $dlugosc2){
				$znak=$tablica[rand(0,strlen($tablica)-1)];
				if(!is_integer(strpos($haslo2,$znak))) $haslo2.=$znak;
			}
			
			//$query = mysql_query("insert into users values ('','".$nick."','".$haslo11."','".$mail."',0,0,'".$haslo2."')");
			$query = mysql_query("update users set pass='".$haslo11."', key_on='".$haslo2."', active=0 where mail='".$mail."'");
			if($query){
				$user = 1;
			}else{
				$user = 0;	
			}
			mysql_close();
			
			$link = "http://agh.ugu.pl/II/activation.php?nick=".$nick."&key=".$haslo2;
			
			require_once('../PHPMailerv5/class.phpmailer.php');
			//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

			$mailer = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

			$mailer->IsSMTP(); // telling the class to use SMTP
			
			//try{
			  $mailer->Host       = "mail.ugu.pl"; // SMTP server
			  $mailer->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			  $mailer->SMTPAuth   = true;                  // enable SMTP authentication
			  $mailer->Host       = "mail.ugu.pl"; // sets the SMTP server
			  $mailer->Port       = 587;                    // set the SMTP port for the GMAIL server
			  $mailer->Username   = "noreply@agh.ugu.pl"; // SMTP account username
			  $mailer->Password   = "projektagh";        // SMTP account password
			  $mailer->AddReplyTo('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			  $mailer->AddAddress($mail, $nick);
			  $mailer->SetFrom('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			  $mailer->AddReplyTo('noreply@agh.ugu.pl', 'Wypo�yczalnia Sprz�t Sportowych');
			  $mailer->CharSet = 'UTF-8';
			  $mailer->Subject = 'Aktywnuj konta';
			  $mailer->MsgHTML("<html><meta charset='UTF-8'> Witaj ".$nick."!! <br />Nick: ".$nick."<br /> Has�o: ".$haslo1." <br /> Aktywnacji konta: <a href='".$link."'>".$link."</a> <br /><br /> Dzi�kujemy <br /> Wypo�yczalnia Sprz�t�w Sportowych");
			  if($mailer->Send()){
				$mail = 1;
			  }else{
				$mail = 0;
			  }
			  if($user == 1 && $mail == 1){
			  	$ok['stan'] = 1;
			  }else{
			  	$ok['stan'] = 0;
			  }
			echo json_encode($ok);
		break;
		
		case "save_adres":
			$name1 = $_POST['name1'];
			$name2 = $_POST['name2'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$id = $_POST['id'];
			include('../config/mysql.inc');
			$query = mysql_query("update users_adres set name='".$name1."', surname='".$name2."', streets='".$street."', city='".$city."' where id=".$id);
			if($query){
				$ok = 1;
			}else{
				$ok = 0;
			}
			mysql_close();
			//echo json_encode($name1." ".$name2." ".$street." ".$city." ".$id);
			echo json_encode($ok);
		break;
		
		case "save_e_acc":
			$mail = $_POST['mail'];
			$id = $_POST['id'];
			include('../config/mysql.inc');
			$query1 = mysql_query("select user from users_adres where ID=".$id);
				while ($row = mysql_fetch_assoc($query1)){
					$nick = $row["user"];
				}
			$query = mysql_query("select user from users where mail='".$mail."'");
			if(mysql_num_rows($query) == 0){
				$ok['row'] = 1;
				$query2 = mysql_query("update users set mail='".$mail."' where user='".$nick."'");
				if($query2){
					$ok['update'] = 1;
				}else{
					$ok['update'] = 0;
				}
			}else{
				$ok['update'] = 0;
				$ok['row'] = 0;
			}
			mysql_close();
			
			echo json_encode($ok);
		break;	
		
		case "save_rental_office":
			$id_c = $_POST['id_c'];
			$id_m = $_POST['id_m'];
			$d_w = $_POST['date_w'];
			$d_z = $_POST['date_z'];
			include('../config/mysql.inc');
			mysql_query("update magazine set stan=0 where ID=".$id_m);
			$query = mysql_query("insert into rental_office values ('','".$id_m."','".$id_c."','".$d_w."','".$d_z."')");
			if($query){
				$ok = 1;
			}else{
				$ok = 0;
			}
			echo json_encode($ok);
		break;
		
		case "view_rental_office":
			include('../config/mysql.inc');
			include('../config/mysql.inc');
			if($_POST['id'] != 'empty'){
				$query = 'select * from rental_office where ID='.$_POST['id'];
			}else{
				$query = 'select * from rental_office';
			}
			
			$res = mysql_query($query);
			
			// iterate over every row
			while ($row = mysql_fetch_assoc($res)) {
				// for every field in the result..
				for ($i=0; $i < mysql_num_fields($res); $i++) {
					$info = mysql_fetch_field($res, $i);
					$type = $info->type;
					//$mag[$i] = $info;
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
					if($info->name == 'ID_C'){
						$mag= $row[$info->name];
						$query1 = mysql_query("select * from users_adres where ID=".$mag);
						while ($roww = mysql_fetch_assoc($query1)){
							$row['name'] = $roww["name"];
							$row['surname'] = $roww["surname"];
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "set_rental_office":
			$id = $_POST['id'];
			include('../config/mysql.inc');
			$query = 'select * from rental_office where ID='.$id;
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "save_edit_rental_office":
			$DZ = $_POST['DZ'];
			$id = $_POST['id'];
			include('../config/mysql.inc');
			$query = mysql_query("update rental_office set Date_z='".$DZ."' where ID=".$id);
			if($query){
				$ok = 1;
			}else{
				$ok = 0;
			}
			
			echo json_encode($ok);
		break;
		
		case "zwrot_rental_office":
			$id = $_POST['id'];
			include('../config/mysql.inc');
			$query = "select * from rental_office where ID=".$id;
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "paid_rental_office":
			$id = $_POST['id'];
			$id_m = $_POST['id_m'];
			include('../config/mysql.inc');
			$query = mysql_query("update magazine set stan=1 where ID=".$id_m);
			if($query){
				$a = 1;
			}else{
				$a = 0;
			}
			$query = mysql_query("delete from rental_office where ID=".$id);
			if($query){
				$b = 1;
			}else{
				$b = 0;
			}
			if($a == 1 && $b==1){
				$ok = 1;
			}else{
				$ok = 0;
			}
			echo json_encode($ok);
		break;
		
		case "view_all_reserv":
			include('../config/mysql.inc');
			if($_POST['ID']){
				$id = $_POST['ID'];
				$query = "select * from reservations where ID=".$id;
			}else{
				$query = "select * from reservations";
			}
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
					if($info->name == 'ID_C'){
						$mag= $row[$info->name];
						$query1 = mysql_query("select * from users_adres where ID=".$mag);
						while ($roww = mysql_fetch_assoc($query1)){
							$row['name'] = $roww["name"];
							$row['surname'] = $roww["surname"];
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
			mysql_close();
			echo json_encode($rows);
		break;
		
		case "change_reserv_on_rental":
			$id = $_POST['ID'];
			$dw = $_POST['dw'];
			$dz = $_POST['dz'];
			include('../config/mysql.inc');
			$query = mysql_query("select * from reservations where ID=".$id);
			while ($roww = mysql_fetch_assoc($query)){
				$id_m = $roww["ID_M"];
				$id_c = $roww['ID_C'];
			}
			$query = mysql_query("insert into rental_office values ('',".$id_m.",".$id_c.",'".$dw."','".$dz."')");
			$query1 = mysql_query("delete from reservations where ID=".$id);
			if($query && $query1){
				$ok = 1;
			}else{
				$ok = 0;
			}
			
			echo json_encode($ok);
		break;
		
		case "delete_res":
			$id = $_POST['ID'];
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
		
		
		default:
		break;
	
	}

}

?>