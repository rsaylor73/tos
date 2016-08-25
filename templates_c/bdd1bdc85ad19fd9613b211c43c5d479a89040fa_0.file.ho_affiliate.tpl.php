<?php /* Smarty version 3.1.27, created on 2016-07-17 14:10:28
         compiled from "/home/syf/public_html/syf-admin/templates/ho_affiliate.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1963954320578bd824a07625_16154744%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bdd1bdc85ad19fd9613b211c43c5d479a89040fa' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/ho_affiliate.tpl',
      1 => 1468782448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1963954320578bd824a07625_16154744',
  'variables' => 
  array (
    'msg' => 0,
    'show_pages' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578bd824a38ea0_02080627',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578bd824a38ea0_02080627')) {
function content_578bd824a38ea0_02080627 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1963954320578bd824a07625_16154744';
?>
<div id="main_element">
<h2>HasOffer Affiliates</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<?php echo $_smarty_tpl->tpl_vars['show_pages']->value;?>


<table class="table">
<tr>
        <th>Affiliate ID</th>
        <th>Name</th>
	<th>Status</th>
        <th>Action</th>
</tr>
<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

</table>


</div>

<?php }
}
?>