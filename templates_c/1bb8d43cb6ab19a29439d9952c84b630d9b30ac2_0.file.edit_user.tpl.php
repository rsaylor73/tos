<?php /* Smarty version 3.1.27, created on 2016-06-27 20:25:06
         compiled from "/home/syf/public_html/syf-admin/templates/edit_user.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:8344367945771d1f24ad668_14201966%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bb8d43cb6ab19a29439d9952c84b630d9b30ac2' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/edit_user.tpl',
      1 => 1467077001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8344367945771d1f24ad668_14201966',
  'variables' => 
  array (
    'msg' => 0,
    'id' => 0,
    'device' => 0,
    'fname' => 0,
    'lname' => 0,
    'uuname' => 0,
    'userType' => 0,
    'email' => 0,
    'active' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5771d1f2500445_98169614',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5771d1f2500445_98169614')) {
function content_5771d1f2500445_98169614 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8344367945771d1f24ad668_14201966';
?>
<div id="main_element">
<h2>Edit User</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform" action="index.php" method="post">
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
<input type="hidden" name="section" value="updateuser">
<table class="table" width=500>

	<?php if ($_smarty_tpl->tpl_vars['device']->value == "1") {?>
        <tr>
                <td><b>First Name:</b><br>
		<input type="text" name="fname" placeholder="First Name" size=20 required value="<?php echo $_smarty_tpl->tpl_vars['fname']->value;?>
"></td>
        </tr>

	<tr>
		<td><b>Last Name:</b><br>
		<input type="text" name="lname" placeholder="Last Name" size=20 required value="<?php echo $_smarty_tpl->tpl_vars['lname']->value;?>
"></td>
	</tr>

	<tr>
		<td><b>Username:</b><br>
		<?php echo $_smarty_tpl->tpl_vars['uuname']->value;?>
</td>
	</tr>

	<tr>
		<td><b>Password:</b><br>
		<input type="password" name="uupass" placeholder="************" size=20></td>
	</tr>

	<tr>
		<td><b>User Type:</b><br>
		<select name="userType" required><option selected value="<?php echo $_smarty_tpl->tpl_vars['userType']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['userType']->value;?>
</option><option value="Staff">Staff</option><option value="Admin">Admin</option></select></td>
	</tr>

	<tr>
		<td><b>Email:</b><br>
		<input type="text" required name="email" placeholder="Email address" size=20 required value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"></td>
	</tr>

        <tr>
                <td><b>Active:</b><br>
                <select name="active"><option selected value="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['active']->value;?>
 (Default)</option><option value="Yes">Yes</option><option value="No">No</option></select></td>
        </tr>

        <tr>
                <td><center><input type="submit" value="Update User" class="btn btn-primary">&nbsp;&nbsp;
		<input type="button" class="btn btn-warning" value="Cancel" onclick="document.location.href='index.php'"></center></td>
        </tr>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['device']->value == "0") {?>

        <tr>
                <td><b>First Name:</b></td>
                <td><input type="text" name="fname" placeholder="First Name" size=40 required value="<?php echo $_smarty_tpl->tpl_vars['fname']->value;?>
"></td>
                <td><b>Last Name:</b></td>
                <td><input type="text" name="lname" placeholder="Last Name" size=40 required value="<?php echo $_smarty_tpl->tpl_vars['lname']->value;?>
"></td>
        </tr>

        <tr>
                <td><b>Username:</b></td>
                <td><?php echo $_smarty_tpl->tpl_vars['uuname']->value;?>
</td>
                <td><b>Password:</b></td>
                <td><input type="password" name="uupass" placeholder="************" size=40></td>
        </tr>

        <tr>
                <td><b>User Type:</b></td>
                <td><select name="userType" required><option selected value="<?php echo $_smarty_tpl->tpl_vars['userType']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['userType']->value;?>
</option><option value="Staff">Staff</option><option value="Admin">Admin</option></select></td>
                <td><b>Email:</b></td>
                <td><input type="text" required name="email" placeholder="Email address" required size=40 value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"></td>
        </tr>

	<tr>
		<td><b>Active:</b></td>
		<td><select name="active"><option selected value="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['active']->value;?>
 (Default)</option><option value="Yes">Yes</option><option value="No">No</option></select></td>

	</tr>

        <tr>
                <td colspan="4"><center><input type="submit" value="Update User" class="btn btn-primary">&nbsp;&nbsp;
                <input type="button" class="btn btn-warning" value="Cancel" onclick="document.location.href='index.php'"></center></td>
        </tr>

	<?php }?>

</table>
</form>
</div>
<?php }
}
?>