<?php /* Smarty version 3.1.27, created on 2016-06-27 20:35:06
         compiled from "/home/syf/public_html/syf-admin/templates/message.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:18873543785771d44a2eed05_74951671%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b4d0545645581a37499a2cd5a9ea8caa57fe2c9' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/message.tpl',
      1 => 1467071368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18873543785771d44a2eed05_74951671',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5771d44a372db7_93615896',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5771d44a372db7_93615896')) {
function content_5771d44a372db7_93615896 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18873543785771d44a2eed05_74951671';
?>
<br><br>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<br><br>
<?php }
}
?>