<?php /* Smarty version 3.1.27, created on 2016-07-20 19:35:39
         compiled from "/home/syf/public_html/syf-admin/templates/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:932356826579018db4c5439_39607215%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e362199aadf2163e3aea0099dd9557eeccc5fd2' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/login.tpl',
      1 => 1469061335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '932356826579018db4c5439_39607215',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579018db5850b2_36107992',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579018db5850b2_36107992')) {
function content_579018db5850b2_36107992 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '932356826579018db4c5439_39607215';
?>
<div id="main_element">
<div style="text-align:center;">
<h2>Login</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform">
<table class="table" width=500 align="center">
	<tr>
		<td><b>Username:</b><br><input type="text" name="uuname" placeholder="User Name" size=20 required></td>
	</tr>
	<tr>
		<td><b>Password:</b><br><input type="password" name="uupass" placeholder="Password" size=20 required onkeypress="if(event.keyCode==13) { loginfrm(this.form); return false;}"></td>
	</tr>
	<tr>
		<td><center>
		<input type="button" value="Forgot Password" class="btn btn-warning" onclick="document.location.href='index.php?section=forgot_pw'">&nbsp;&nbsp;
		<input type="button" name="login" value="Login" class="btn btn-primary" onclick="loginfrm(this.form)"></center></td>
	</tr>
</table>
</form>
</div>
</div>

<?php echo '<script'; ?>
>
function loginfrm(myform) {
	$.get('ajax/login.php',
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