<?php /* Smarty version 3.1.27, created on 2016-08-24 19:07:52
         compiled from "/home/frozen/public_html/templates/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:60914115857be36d8edc6c5_52807878%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '746b30cd82d68b2c8440201d144dbab7c904b7df' => 
    array (
      0 => '/home/frozen/public_html/templates/login.tpl',
      1 => 1472083670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60914115857be36d8edc6c5_52807878',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57be36d90dc079_70159985',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57be36d90dc079_70159985')) {
function content_57be36d90dc079_70159985 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '60914115857be36d8edc6c5_52807878';
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