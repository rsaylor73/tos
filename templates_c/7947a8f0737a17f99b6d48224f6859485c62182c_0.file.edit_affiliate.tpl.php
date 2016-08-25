<?php /* Smarty version 3.1.27, created on 2016-07-17 14:10:46
         compiled from "/home/syf/public_html/syf-admin/templates/edit_affiliate.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:157230327578bd83640c860_00047388%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7947a8f0737a17f99b6d48224f6859485c62182c' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/edit_affiliate.tpl',
      1 => 1468782613,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157230327578bd83640c860_00047388',
  'variables' => 
  array (
    'msg' => 0,
    'id' => 0,
    'device' => 0,
    'affiliateID' => 0,
    'name' => 0,
    'status' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578bd8364aef06_81861408',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578bd8364aef06_81861408')) {
function content_578bd8364aef06_81861408 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '157230327578bd83640c860_00047388';
?>
<div id="main_element">
<h2>Edit HasOffer Affiliate</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<br><b><i>Note: The affiliateID is added via HasOffer.</i></b><br>
<form name="myform" action="index.php" method="post">
<input type="hidden" name="section" value="update_affiliate">
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
<table class="table" width=500>



<?php if ($_smarty_tpl->tpl_vars['device']->value == "0") {?>
<tr><td>Affiliate ID:</td><td><?php echo $_smarty_tpl->tpl_vars['affiliateID']->value;?>
</td></tr>
<tr><td>Affiliate Name:</td><td><input type="text" name="name" required placeholder="Affiliate Name" size="40" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></td></tr>
<tr><td>Status:</td><td><select name="status"><?php if ($_smarty_tpl->tpl_vars['status']->value != '') {?><option selected value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 (Default)</option><?php }
if ($_smarty_tpl->tpl_vars['status']->value == '') {?><option value="">--Select--</option><?php }?><option>Active</option><option>Inactive</option></select></td></tr>
<tr><td colspan="2"><input type="submit" value="Update Affiliate" class="btn btn-primary"></td></tr>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['device']->value == "1") {?>
<tr><td>Affiliate ID:<br><?php echo $_smarty_tpl->tpl_vars['affiliateID']->value;?>
</td></tr>
<tr><td>Affiliate Name:<br><input type="text" name="name" required placeholder="Affiliate Name" size="40" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></td></tr>
<tr><td>Status:<br><select name="status"><?php if ($_smarty_tpl->tpl_vars['status']->value != '') {?><option selected value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 (Default)</option><?php }
if ($_smarty_tpl->tpl_vars['status']->value == '') {?><option value="">--Select--</option><?php }?><option>Active</option><option>Inactive</option></select></td></tr>
<tr><td><input type="submit" value="Update Affiliate" class="btn btn-primary"></td></tr>
<?php }?>

</table>
</form>
</div>

<?php }
}
?>