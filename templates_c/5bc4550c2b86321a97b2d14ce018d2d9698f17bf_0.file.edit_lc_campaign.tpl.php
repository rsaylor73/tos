<?php /* Smarty version 3.1.27, created on 2016-07-16 14:42:58
         compiled from "/home/syf/public_html/syf-admin/templates/edit_lc_campaign.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:340714018578a8e42572d62_05059604%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bc4550c2b86321a97b2d14ce018d2d9698f17bf' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/edit_lc_campaign.tpl',
      1 => 1468698170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '340714018578a8e42572d62_05059604',
  'variables' => 
  array (
    'msg' => 0,
    'id' => 0,
    'device' => 0,
    'campaign_id' => 0,
    'name' => 0,
    'active' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578a8e4261f1b5_94758373',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578a8e4261f1b5_94758373')) {
function content_578a8e4261f1b5_94758373 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '340714018578a8e42572d62_05059604';
?>
<div id="main_element">
<h2>Edit Lead Conduit Campaign</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<br><b><i>Note: The campaign must exist in Lead Conduit</i></b><br>
<form name="myform" action="index.php" method="post">
<input type="hidden" name="section" value="update_new_lc_campaign">
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
<table class="table" width=500>



<?php if ($_smarty_tpl->tpl_vars['device']->value == "0") {?>
<tr><td>Campaign ID:</td><td><input type="text" name="campaign_id" required placeholder="Lead Conduit Campaign ID" size="40" value="<?php echo $_smarty_tpl->tpl_vars['campaign_id']->value;?>
"></td></tr>
<tr><td>Campaign Name:</td><td><input type="text" name="name" required placeholder="Campaign Name" size="40" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></td></tr>
<tr><td>Active:</td><td><select name="active" required><option selected value="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['active']->value;?>
 (Default)</option><option>Yes</option><option>No</option></select></td></tr>
<tr><td colspan="2"><input type="submit" value="Update Campaign" class="btn btn-primary"></td></tr>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['device']->value == "1") {?>
<tr><td>Campaign ID:<br><input type="text" name="campaign_id" required placeholder="Lead Conduit Campaign ID" size="20" value="<?php echo $_smarty_tpl->tpl_vars['campaign_id']->value;?>
"></td></tr>
<tr><td>Campaign Name:<br><input type="text" name="name" required placeholder="Campaign Name" size="20" value="<?php echo $_smarty_tpl->tpl_vars['campaign_id']->value;?>
"></td></tr>
<tr><td>Active:<br><select name="active" required><option selected value="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['active']->value;?>
 (Default)</option><option>Yes</option><option>No</option></select></td></tr>
<tr><td><input type="submit" value="Update Campaign" class="btn btn-primary"></td></tr>
<?php }?>

</table>
</form>
</div>
<?php }
}
?>