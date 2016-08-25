<?php /* Smarty version 3.1.27, created on 2016-07-20 20:03:15
         compiled from "/home/syf/public_html/syf-admin/templates/forgot_pw.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:5056871957901f53e912d3_96369211%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be6be410f395250923acef66672418d20ee6fb4b' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/forgot_pw.tpl',
      1 => 1469061756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5056871957901f53e912d3_96369211',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57901f53ec38b6_13984131',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57901f53ec38b6_13984131')) {
function content_57901f53ec38b6_13984131 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5056871957901f53e912d3_96369211';
?>
<div id="main_element">
<div style="text-align:center;">
<h2>Reset Password</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform">
<table class="table" width=500 align="center">
	<tr>
		<td><b>Email Address:</b><br><input type="text" name="email" placeholder="Email" size=20 required></td>
	</tr>
	<tr>
		<td><center>
		<input type="button" value="Login" class="btn btn-warning" onclick="document.location.href='index.php'">&nbsp;&nbsp;
		<input type="button" name="login" value="Reset Password" class="btn btn-primary" onclick="resetpw(this.form)"></center></td>
	</tr>
</table>
</form>
</div>
</div>

<?php echo '<script'; ?>
>
function resetpw(myform) {
	$.get('ajax/resetpw.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#main_element").html(php_msg);
	});
}
<?php echo '</script'; ?>
>
<?php }
}
?>