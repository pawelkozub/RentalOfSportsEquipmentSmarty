<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-10 22:49:09
         compiled from ".\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15077545a3ecb667581-45576463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68f682e831b54c4d2b36fc346fd7646d6c555814' => 
    array (
      0 => '.\\templates\\header.tpl',
      1 => 1418247789,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15077545a3ecb667581-45576463',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_545a3ecb67fa48_17515511',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545a3ecb67fa48_17515511')) {function content_545a3ecb67fa48_17515511($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
		<link rel="shortcut icon" href="ikon/icon.png" type="image/x-icon" />
		<meta name="author" content="Paweł Kozub">
		<meta name="description" content="Wypożyczalnia Sprzęt Sportowych Paweł Kozub">
		<meta name="keywords" content="Paweł Kozub, AGH, WIMIIP">
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<link rel="stylesheet" type="text/css" media="screen" href="main/style_main.css" >
        <link rel="stylesheet" type="text/css" media="screen" href="main/dialog.css" >
		<link rel="stylesheet" type="text/css" media="screen" href="login/login.css" >
        <link rel="stylesheet" type="text/css" media="screen" href="zebra_dialog/zebra_dialog.css" >
		<?php echo '<script'; ?>
 src="//code.jquery.com/jquery-1.11.0.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="//code.jquery.com/jquery-migrate-1.2.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="zebra_dialog/zebra_dialog.js"><?php echo '</script'; ?>
>
        <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
		<?php echo '<script'; ?>
 src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="Overlib/overlib.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="main/main.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="login/login.js" ><?php echo '</script'; ?>
>
		<?php if (($_SESSION['Account']=="Admin")) {?>
		<?php echo $_smarty_tpl->getSubTemplate ("admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif (($_SESSION['Account']=="User")) {?>
		<?php echo $_smarty_tpl->getSubTemplate ("user.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php }?>
	</head>
<body>
<span class='cursor' id='link_login'>Login</span><span class='cursor' id='link_logout'>Wyloguj</span>
<div id='panel_login'>
	<table border=0>
	<tr><td>Nick:</td><td><input type='text' id='nick' /></td></tr>
	<tr><td>Pass:</td><td><input type='password' id='pass' /></td></tr>
	<tr><td colspan=2  style="text-align:center"><span class='cursor' id='new_login'>  Nie masz konta?</span></td></tr>
</table>
</div>
<div id='panel_rejestr'>
	Proszę przyjść to mnie na utworzyć Ci konta
</div><?php }} ?>
