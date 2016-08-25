<?php /* Smarty version 3.1.27, created on 2016-08-07 07:23:24
         compiled from "/home/syf/public_html/syf-admin/templates/lc_hourly_leads_gui.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:195001239457a7283cb546d9_26976006%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bf5222c267c19eefde98db5455ba11ead8a4862' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/lc_hourly_leads_gui.tpl',
      1 => 1470572587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195001239457a7283cb546d9_26976006',
  'variables' => 
  array (
    'msg' => 0,
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57a7283cbcb7c8_57557470',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57a7283cbcb7c8_57557470')) {
function content_57a7283cbcb7c8_57557470 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '195001239457a7283cb546d9_26976006';
?>
<div id="main_element">
<h2>Lead Conduit Hourly Stats GUI</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<form action="index.php" method="get">
<input type="hidden" name="section" value="hourly_lc_report">
<table class="table">
	<tr><td>Date for Report:</td><td><input type="text" name="date" id="date2" readonly required></td></tr>
	<tr><td>Campaigns:<br>(Multiple Selection Ok)</td><td><select name="campaigns[]" id="campaigns" multiple size=20><?php echo $_smarty_tpl->tpl_vars['options']->value;?>
</select></td></tr>

	<tr><td colspan="2"><input type="submit" value="Run Custom Report" class="btn btn-primary"></td></tr>
</table>
</form>

    <?php echo '<script'; ?>
 type="text/javascript">

    $(document).ready(function() {

      var last_valid_selection = null;

      $('#campaigns').change(function(event) {
        if ($(this).val().length > 5) {
          alert('You can only choose 5');
          $(this).val(last_valid_selection);
        } else {
          last_valid_selection = $(this).val();
        }
      });
    });
    <?php echo '</script'; ?>
>


</div>
<?php }
}
?>