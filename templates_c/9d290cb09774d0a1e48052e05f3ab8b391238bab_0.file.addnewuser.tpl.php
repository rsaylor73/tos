<?php /* Smarty version 3.1.27, created on 2016-07-23 10:56:04
         compiled from "/home/syf/public_html/syf-admin/templates/addnewuser.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1557511216579393949ec612_17443606%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d290cb09774d0a1e48052e05f3ab8b391238bab' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/addnewuser.tpl',
      1 => 1467072836,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1557511216579393949ec612_17443606',
  'variables' => 
  array (
    'msg' => 0,
    'device' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57939394ac5fa9_20806458',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57939394ac5fa9_20806458')) {
function content_57939394ac5fa9_20806458 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1557511216579393949ec612_17443606';
?>
<div id="main_element">
<h2>Add User</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform" action="index.php" method="post">
<input type="hidden" name="section" value="savenewuser">
<table class="table" width=500>

	<?php if ($_smarty_tpl->tpl_vars['device']->value == "1") {?>
        <tr>
                <td><b>First Name:</b><br>
		<input type="text" name="fname" placeholder="First Name" size=20 required></td>
        </tr>

	<tr>
		<td><b>Last Name:</b><br>
		<input type="text" name="lname" placeholder="Last Name" size=20 required></td>
	</tr>

	<tr>
		<td><b>Username:</b><br>
		<input type="text" name="uuname" placeholder="Username" size=20 required></td>
	</tr>

	<tr>
		<td><b>Password:</b><br>
		<input type="password" name="uupass" placeholder="************" size=20 required></td>
	</tr>

	<tr>
		<td><b>User Type:</b><br>
		<select name="userType" required><option value="">--Select--</option><option value="Staff">Staff</option><option value="Admin">Admin</option></select></td>
	</tr>

	<tr>
		<td><b>Email:</b><br>
		<input type="text" required name="email" placeholder="Email address" required size=20></td>
	</tr>

        <tr>
                <td><center><input type="submit" value="Create User" class="btn btn-primary">&nbsp;&nbsp;
		<input type="button" class="btn btn-warning" value="Cancel" onclick="document.location.href='index.php'"></center></td>
        </tr>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['device']->value == "0") {?>

        <tr>
                <td><b>First Name:</b></td>
                <td><input type="text" name="fname" placeholder="First Name" size=40 required></td>
                <td><b>Last Name:</b></td>
                <td><input type="text" name="lname" placeholder="Last Name" size=40 required></td>
        </tr>

        <tr>
                <td><b>Username:</b></td>
                <td><input type="text" name="uuname" placeholder="Username" size=40 required></td>
                <td><b>Password:</b></td>
                <td><input type="password" name="uupass" placeholder="************" size=40 required></td>
        </tr>

        <tr>
                <td><b>User Type:</b></td>
                <td><select name="userType" required><option value="">--Select--</option><option value="Staff">Staff</option><option value="Admin">Admin</option></select></td>
                <td><b>Email:</b></td>
                <td><input type="text" required name="email" placeholder="Email address" required size=40></td>
        </tr>

        <tr>
                <td colspan="4"><center><input type="submit" value="Create User" class="btn btn-primary">&nbsp;&nbsp;
                <input type="button" class="btn btn-warning" value="Cancel" onclick="document.location.href='index.php'"></center></td>
        </tr>

	<?php }?>

</table>
</form>
</div>
<?php }
}
?>