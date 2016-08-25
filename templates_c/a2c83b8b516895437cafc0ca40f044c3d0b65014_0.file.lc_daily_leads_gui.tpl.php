<?php /* Smarty version 3.1.27, created on 2016-07-30 06:01:40
         compiled from "/home/syf/public_html/syf-admin/templates/lc_daily_leads_gui.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1376818073579c8914d2c221_46697708%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2c83b8b516895437cafc0ca40f044c3d0b65014' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/lc_daily_leads_gui.tpl',
      1 => 1469876496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1376818073579c8914d2c221_46697708',
  'variables' => 
  array (
    'msg' => 0,
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579c8914dbf8d2_30156863',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579c8914dbf8d2_30156863')) {
function content_579c8914dbf8d2_30156863 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1376818073579c8914d2c221_46697708';
?>
<div id="main_element">
<h2>Lead Conduit Daily Stats GUI</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<form action="index.php" method="get">
<input type="hidden" name="section" value="lc_daily_leads">
<table class="table">
	<tr><td>Date for Report:</td><td><input type="text" name="date" id="date1" readonly required></td></tr>
	<tr><td>Campaigns:<br>(Multiple Selection Ok)</td><td><select name="campaigns[]" multiple size=20><?php echo $_smarty_tpl->tpl_vars['options']->value;?>
</select></td></tr>

	<tr><td colspan="2"><input type="submit" value="Run Custom Report" class="btn btn-primary"></td></tr>
</table>
</form>


</div>
<?php }
}
?>