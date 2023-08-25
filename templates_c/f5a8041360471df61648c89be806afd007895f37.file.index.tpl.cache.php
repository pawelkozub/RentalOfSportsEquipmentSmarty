<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-04 21:14:28
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198065459331d8daca1-54779810%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5a8041360471df61648c89be806afd007895f37' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1415132032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198065459331d8daca1-54779810',
  'function' => 
  array (
  ),
  'cache_lifetime' => 120,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5459331da21b35_91230667',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5459331da21b35_91230667')) {function content_5459331da21b35_91230667($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>




<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>
