<?php /* Smarty version 3.1.27, created on 2016-06-27 18:54:37
         compiled from "/home/syf/public_html/syf-admin/templates/list_users.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1011099985771bcbd851d39_70118099%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc40923e15abf48511b9dc3c55c2ea79ff1600be' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/list_users.tpl',
      1 => 1467071368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1011099985771bcbd851d39_70118099',
  'variables' => 
  array (
    'msg' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5771bcbd883f51_14277302',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5771bcbd883f51_14277302')) {
function content_5771bcbd883f51_14277302 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1011099985771bcbd851d39_70118099';
?>
<div id="main_element">
<h2>Users <input type="button" class="btn btn-success" value="Add New User" onclick="document.location.href='index.php?section=adduser'"></h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<table class="table">
<tr>
	<th>Name</th>
	<th>Type</th>
	<th>Email</th>
	<th>Action</th>
</tr>
<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

</table>


</div><?php }
}
?>