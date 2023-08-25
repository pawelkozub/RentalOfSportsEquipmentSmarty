<?php
session_start();


require 'libs/Smarty.class.php';
$smarty = new Smarty;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

$smarty->assign('tresc_user', file_get_contents('views/index.htm'));
$smarty->assign('tresc_admin', file_get_contents('views/index.htm'));

switch($action){
	//ADMIN;
	case 'new_mag':
		$smarty->assign('tresc_admin', file_get_contents('views/new_magazyn.htm'));
	break;
	
	case 'new_wyp':
		$smarty->assign('tresc_admin', file_get_contents('views/new_wypozyczalnia.htm'));
	break;
	
	case 'stan_mag':
		$smarty->assign('tresc_admin', file_get_contents('views/stan_magazyn.htm'));
	break;
	
	case 'stan_wyp':
		$smarty->assign('tresc_admin', file_get_contents('views/stan_wypozyczalnia.htm'));
	break;
	
	case 'new_acc':
		$smarty->assign('tresc_admin', file_get_contents('views/new_account.htm'));
	break;
	
	case 'stan_acc':
		$smarty->assign('tresc_admin', file_get_contents('views/stan_account.htm'));
	break;
	
	case 'new_kat':
		$smarty->assign('tresc_admin', file_get_contents('views/new_category.htm'));
	break;
	
	case 'stan_kat':
		$smarty->assign('tresc_admin', file_get_contents('views/stan_category.htm'));
	break;
	
	case 'rez':
		$smarty->assign('tresc_admin', file_get_contents('views/rezerwacje_admin.htm'));
	break;
	
	//USER:
	case 'stan':
		$smarty->assign('tresc_user', file_get_contents('views/stan_account_user.htm'));
	break;
	
	case 'rezerw':
		$smarty->assign('tresc_user', file_get_contents('views/rezerwacje_user.htm'));
	break;
	
	case 'myrezerw':
		$smarty->assign('tresc_user', file_get_contents('views/stan_rezerwacje_user.htm'));
	break;
	
	case 'wyp':
		$smarty->assign('tresc_user', file_get_contents('views/stan_wypozyczalnia_user.htm'));
	break;
	
	case 'reg':
		$smarty->assign('tresc_user', file_get_contents('views/regulamin.htm'));
	break;


	case 'kontakt':
		$smarty->assign('tresc_user', file_get_contents('views/kontakt.htm'));
	break;

}


//$smarty->assign('tresc',  file_get_contents('views/omnie.php'));

$smarty->assign('title',"Strona internetowa wypo¿yczalnia sprzêt sportowych");
$smarty->display('index.tpl');
?>

