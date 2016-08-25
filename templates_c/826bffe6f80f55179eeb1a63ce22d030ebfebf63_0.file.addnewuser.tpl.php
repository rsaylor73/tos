<?php /* Smarty version 3.1.27, created on 2016-06-26 13:10:17
         compiled from "/home/syf/public_html/admin/templates/addnewuser.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:192085492057701a89e717d4_28244592%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '826bffe6f80f55179eeb1a63ce22d030ebfebf63' => 
    array (
      0 => '/home/syf/public_html/admin/templates/addnewuser.tpl',
      1 => 1466964614,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192085492057701a89e717d4_28244592',
  'variables' => 
  array (
    'msg' => 0,
    'device' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57701a89ed1188_61228904',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57701a89ed1188_61228904')) {
function content_57701a89ed1188_61228904 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '192085492057701a89e717d4_28244592';
?>
<div id="main_element">
<div style="text-align:center;">
<h2>Add User</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform" action="index.php" method="post">
<input type="hidden" name="section" value="savenewuser">
<table class="table" width=500 align="center">

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
		<input type="text" required name="email" placeholder="Email address" size=20></td>
	</tr>

        <tr>
                <td><center><input type="submit" value="Create User" class="btn btn-primary">&nbsp;&nbsp;
		<input type="button" class="btn btn-warning" value="Cancel" onclick="document.location.href='index.php'"></center></td>
        </tr>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['device']->value == "0") {?>

        <tr>
                <td><b>First Name:</b></td>
                <td><input type="text" name="fname" placeholder="First Name" size=20 required></td>
                <td><b>Last Name:</b></td>
                <td><input type="text" name="lname" placeholder="Last Name" size=20 required></td>
        </tr>

        <tr>
                <td><b>Username:</b></td>
                <td><input type="text" name="uuname" placeholder="Username" size=20 required></td>
                <td><b>Password:</b></td>
                <td><input type="password" name="uupass" placeholder="************" size=20 required></td>
        </tr>

        <tr>
                <td><b>User Type:</b></td>
                <td><select name="userType" required><option value="">--Select--</option><option value="Staff">Staff</option><option value="Admin">Admin</option></select></td>
                <td><b>Email:</b></td>
                <td><input type="text" required name="email" placeholder="Email address" size=20></td>
        </tr>

        <tr>
                <td colspan="4"><center><input type="submit" value="Create User" class="btn btn-primary">&nbsp;&nbsp;
                <input type="button" class="btn btn-warning" value="Cancel" onclick="document.location.href='index.php'"></center></td>
        </tr>

	<?php }?>

</table>
</form>
</div>
</div>
<?php }
}
?>