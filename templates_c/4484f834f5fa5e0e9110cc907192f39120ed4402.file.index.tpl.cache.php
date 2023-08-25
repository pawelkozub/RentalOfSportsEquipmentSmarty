<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-04 21:18:40
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2101545934a0af5135-94679769%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4484f834f5fa5e0e9110cc907192f39120ed4402' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1415132032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2101545934a0af5135-94679769',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_545934a0b46e81_45071806',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545934a0b46e81_45071806')) {function content_545934a0b46e81_45071806($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>




<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>
