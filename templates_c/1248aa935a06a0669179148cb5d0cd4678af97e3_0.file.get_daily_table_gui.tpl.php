<?php /* Smarty version 3.1.27, created on 2016-07-30 12:05:39
         compiled from "/home/syf/public_html/syf-admin/templates/get_daily_table_gui.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:921286113579cde6388b180_21000365%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1248aa935a06a0669179148cb5d0cd4678af97e3' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/get_daily_table_gui.tpl',
      1 => 1469898245,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '921286113579cde6388b180_21000365',
  'variables' => 
  array (
    'msg' => 0,
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579cde6390ba52_11464594',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579cde6390ba52_11464594')) {
function content_579cde6390ba52_11464594 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '921286113579cde6388b180_21000365';
?>
<div id="main_element">
<h2>Has Offers Daily Stats GUI</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<form action="index.php" method="get">
<input type="hidden" name="section" value="get_daily_table">
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