<?php /* Smarty version 3.1.27, created on 2016-07-16 11:24:17
         compiled from "/home/syf/public_html/syf-admin/templates/list_lc_campaigns.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:591199484578a5fb16a4e67_77532425%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d6b70f6048da175b54aee93a83c9e08c37c28d2' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/list_lc_campaigns.tpl',
      1 => 1468686203,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '591199484578a5fb16a4e67_77532425',
  'variables' => 
  array (
    'msg' => 0,
    'show_pages' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578a5fb16d77f2_98063630',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578a5fb16d77f2_98063630')) {
function content_578a5fb16d77f2_98063630 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '591199484578a5fb16a4e67_77532425';
?>
<div id="main_element">
<h2>Lead Conduit Campaigns <input type="button" class="btn btn-success" value="Add New Campaign" onclick="document.location.href='index.php?section=add_lc_campaign'"></h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<?php echo $_smarty_tpl->tpl_vars['show_pages']->value;?>


<table class="table">
<tr>
	<th>Campaign ID</th>
	<th>Name</th>
	<th>Active</th>
	<th>Action</th>
</tr>
<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

</table>


</div>
<?php }
}
?>