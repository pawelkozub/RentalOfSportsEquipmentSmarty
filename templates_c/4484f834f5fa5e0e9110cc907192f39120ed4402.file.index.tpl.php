<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-07 22:10:01
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6620545a3ecb552613-57025440%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4484f834f5fa5e0e9110cc907192f39120ed4402' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1417986598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6620545a3ecb552613-57025440',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_545a3ecb60f831_87470893',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545a3ecb60f831_87470893')) {function content_545a3ecb60f831_87470893($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if (($_SESSION['Account']=='')) {?>
<?php echo $_smarty_tpl->getSubTemplate ("body.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } elseif (($_SESSION['Account']=="Admin"||$_SESSION['Account']=="User")) {?>
	<?php if (($_SESSION['change_pass']==1)) {?>
	<?php echo $_smarty_tpl->getSubTemplate ("body_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif (($_SESSION['change_pass']==0)) {?>
	<?php echo $_smarty_tpl->getSubTemplate ("body_change_pass.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php }?>
<?php }?>

<?php if (($_SESSION['Account']=='')) {?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } elseif (($_SESSION['Account']=="Admin")) {?>
<?php echo $_smarty_tpl->getSubTemplate ("footer_admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } elseif (($_SESSION['Account']=="User"&&$_SESSION['change_pass']==1)) {?>
<?php echo $_smarty_tpl->getSubTemplate ("footer_user.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<?php }} ?>
