<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-07 22:28:58
         compiled from ".\templates\body_change_pass.tpl" */ ?>
<?php /*%%SmartyHeaderCode:241325467a50ade98b7-79271506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5590b271cd370031c57e454187bcebfac1df3ecb' => 
    array (
      0 => '.\\templates\\body_change_pass.tpl',
      1 => 1417987718,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '241325467a50ade98b7-79271506',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5467a50aeb4ca2_00019482',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5467a50aeb4ca2_00019482')) {function content_5467a50aeb4ca2_00019482($_smarty_tpl) {?><?php echo '<script'; ?>
>
$(document).ready(function(){
	$('#change_passed').hide();
	$( "#change_passed" ).dialog({
		autoOpen: false,
		height: 'auto',
		title: 'Nowy Hasla',
		width: 350,
		modal: true,
		resizable:false,
		buttons: {
			'Zmiana' : New_pass,
		}
	});
	$( "#change_passed" ).dialog( "open" );
	
	function New_pass(){
		var pass1 = $('#new_pass_1').val();
		var pass2 = $('#new_pass_2').val();
		if(pass1 !='' && pass2 !=''){
			if(pass1 == pass2){
				$.ajax({
					type: "POST",
					url: "login/login.php",
					data: "function=save_pass&pass="+pass1,
					success: function(msg){
						//alert(msg);
						if(msg == 1){
							$.Zebra_Dialog('Dziekuje za rezerwacje, serdecznie zapraszamy', {
								'type':     'confirmation',
								'title':    'confirmation',	
							});	
							location.reload();

						}else{
							$.Zebra_Dialog('Blad, ponowie', {
								'type':     'information',
								'title':    'Information'					
							});	
						}
					}
				})
			}else{
				$.Zebra_Dialog('Nie prawdilowe Hasla', {
					'type':     'information',
					'title':    'Information'					
				});	
				$('#new_pass_1').val('');
				$('#new_pass_2').val('');
			}
		}else{
			$.Zebra_Dialog('Wypelnij pole', {
				'type':     'information',
				'title':    'Information'					
			});	
		}
	}


})
<?php echo '</script'; ?>
>


<div id='change_passed'>
<center>
<h3>Zmiana Has³a:</h3>
<table border=0>
<tr><td>Nowy Has³a:</td><td><input type='password' id='new_pass_1' /></td><tr>
<tr><td>Ponowie Has³a:</td><td><input type='password' id='new_pass_2' /></td><tr>

</table>
<center>
</div><?php }} ?>
