<?php /* Smarty version 3.1.27, created on 2016-06-26 07:01:46
         compiled from "/home/syf/public_html/admin/templates/message.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:975147279576fc42ae3e9a7_46034620%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '475e59e9696271c1ecfe7ef81748729b00c3862b' => 
    array (
      0 => '/home/syf/public_html/admin/templates/message.tpl',
      1 => 1466942460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '975147279576fc42ae3e9a7_46034620',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576fc42ae6ef79_37277315',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576fc42ae6ef79_37277315')) {
function content_576fc42ae6ef79_37277315 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '975147279576fc42ae3e9a7_46034620';
?>
<br><br>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<br><br>
<?php }
}
?>