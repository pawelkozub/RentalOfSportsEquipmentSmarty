<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-10 21:59:13
         compiled from ".\templates\body_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30172545f6816a05417-39317315%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d198881f3bf37f65c3227f8583c4d0055f6440f' => 
    array (
      0 => '.\\templates\\body_account.tpl',
      1 => 1415653145,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30172545f6816a05417-39317315',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_545f6816a3b031_18139433',
  'variables' => 
  array (
    'tresc_user' => 0,
    'tresc_admin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545f6816a3b031_18139433')) {function content_545f6816a3b031_18139433($_smarty_tpl) {?><table id='table'>
<tr>
<td id='menu'>
<?php if (($_SESSION['Account']=="User")) {?>
<?php echo $_smarty_tpl->getSubTemplate ("menu_user.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } elseif ($_SESSION['Account']=="Admin") {?>
<?php echo $_smarty_tpl->getSubTemplate ("menu_admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
</td>
<td width='15px'></td>
<td id='tresc'>
<div style='position:relative'>
<?php if (($_SESSION['Account']=="User")) {?>
<?php echo $_smarty_tpl->tpl_vars['tresc_user']->value;?>

<?php } elseif ($_SESSION['Account']=="Admin") {?>
<?php echo $_smarty_tpl->tpl_vars['tresc_admin']->value;?>

<?php }?>
</div>
</td>
</tr>
</table><?php }} ?>
