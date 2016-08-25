<?php /* Smarty version 3.1.27, created on 2016-07-30 13:15:16
         compiled from "/home/syf/public_html/syf-admin/templates/get_weekly_table_gui.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1459296271579ceeb4354064_95952733%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d8db85dd1d01a4ff2de78bd313ad021b70c6df6' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/get_weekly_table_gui.tpl',
      1 => 1469902164,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1459296271579ceeb4354064_95952733',
  'variables' => 
  array (
    'msg' => 0,
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579ceeb4385fa7_70744972',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579ceeb4385fa7_70744972')) {
function content_579ceeb4385fa7_70744972 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1459296271579ceeb4354064_95952733';
?>
<div id="main_element">
<h2>Has Offers Weekly Stats GUI</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<form action="index.php" method="get">
<input type="hidden" name="section" value="get_weekly_table">
<table class="table">
        <tr><td>Date for Report:</td><td><input type="text" name="date" id="date1" readonly required></td></tr>
        <tr><td>Affiliate:<br>(Multiple Selection Ok)</td><td><select name="affiliate[]" multiple size=20><?php echo $_smarty_tpl->tpl_vars['options']->value;?>
</select></td></tr>

        <tr><td colspan="2"><input type="submit" value="Run Custom Report" class="btn btn-primary"></td></tr>
</table>
</form>


</div>
<?php }
}
?>