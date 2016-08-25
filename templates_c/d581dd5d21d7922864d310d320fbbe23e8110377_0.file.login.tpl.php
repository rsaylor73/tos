<?php /* Smarty version 3.1.27, created on 2016-06-26 06:46:32
         compiled from "/home/syf/public_html/admin/templates/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:955787559576fc098ad1ed1_56902562%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd581dd5d21d7922864d310d320fbbe23e8110377' => 
    array (
      0 => '/home/syf/public_html/admin/templates/login.tpl',
      1 => 1466941590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '955787559576fc098ad1ed1_56902562',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576fc098b05280_43206438',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576fc098b05280_43206438')) {
function content_576fc098b05280_43206438 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '955787559576fc098ad1ed1_56902562';
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
		<td><center><input type="button" name="login" value="Login" class="btn btn-primary" onclick="loginfrm(this.form)"></center></td>
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