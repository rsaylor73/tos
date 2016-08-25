<?php /* Smarty version 3.1.27, created on 2016-07-16 10:19:08
         compiled from "/home/syf/public_html/syf-admin/templates/new_lc_campaign.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:46193022578a506cecea49_48217351%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b66da4b92584f657bd30b155d343367ba2aa7965' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/new_lc_campaign.tpl',
      1 => 1468682337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46193022578a506cecea49_48217351',
  'variables' => 
  array (
    'msg' => 0,
    'device' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578a506cf12f65_63306818',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578a506cf12f65_63306818')) {
function content_578a506cf12f65_63306818 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '46193022578a506cecea49_48217351';
?>
<div id="main_element">
<h2>Add Lead Conduit Campaign</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<br><b><i>Note: The campaign must exist in Lead Conduit</i></b><br>
<form name="myform" action="index.php" method="post">
<input type="hidden" name="section" value="save_new_lc_campaign">
<table class="table" width=500>



<?php if ($_smarty_tpl->tpl_vars['device']->value == "0") {?>
<tr><td>Campaign ID:</td><td><input type="text" name="campaign_id" required placeholder="Lead Conduit Campaign ID" size="40"></td></tr>
<tr><td>Campaign Name:</td><td><input type="text" name="name" required placeholder="Campaign Name" size="40"></td></tr>
<tr><td>Active:</td><td><select name="active" required><option>Yes</option><option>No</option></select></td></tr>
<tr><td colspan="2"><input type="submit" value="Add Campaign" class="btn btn-primary"></td></tr>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['device']->value == "1") {?>
<tr><td>Campaign ID:<br><input type="text" name="campaign_id" required placeholder="Lead Conduit Campaign ID" size="20"></td></tr>
<tr><td>Campaign Name:<br><input type="text" name="name" required placeholder="Campaign Name" size="20"></td></tr>
<tr><td>Active:<br><select name="active" required><option>Yes</option><option>No</option></select></td></tr>
<tr><td><input type="submit" value="Add Campaign" class="btn btn-primary"></td></tr>
<?php }?>

</table>
</form>
</div>
<?php }
}
?>