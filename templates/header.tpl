<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
		<link rel="shortcut icon" href="ikon/icon.png" type="image/x-icon" />
		<meta name="author" content="Paweł Kozub">
		<meta name="description" content="Wypożyczalnia Sprzęt Sportowych Paweł Kozub">
		<meta name="keywords" content="Paweł Kozub, AGH, WIMIIP">
		<title>{$title}</title>
		<link rel="stylesheet" type="text/css" media="screen" href="main/style_main.css" >
        <link rel="stylesheet" type="text/css" media="screen" href="main/dialog.css" >
		<link rel="stylesheet" type="text/css" media="screen" href="login/login.css" >
        <link rel="stylesheet" type="text/css" media="screen" href="zebra_dialog/zebra_dialog.css" >
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="zebra_dialog/zebra_dialog.js"></script>
        <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript" src="Overlib/overlib.js"></script>
        <script type="text/javascript" src="main/main.js"></script>
		<script src="login/login.js" ></script>
		{if ($smarty.session.Account == "Admin")}
		{include file="admin.tpl"}
		{elseif ($smarty.session.Account ==  "User")}
		{include file="user.tpl"}
		{/if}
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
</div>