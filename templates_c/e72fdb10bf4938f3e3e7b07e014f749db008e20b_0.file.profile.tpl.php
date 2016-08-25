<?php /* Smarty version 3.1.27, created on 2016-07-20 20:38:32
         compiled from "/home/syf/public_html/syf-admin/templates/profile.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:887249254579027987d38d2_99008481%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e72fdb10bf4938f3e3e7b07e014f749db008e20b' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/profile.tpl',
      1 => 1469064706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '887249254579027987d38d2_99008481',
  'variables' => 
  array (
    'msg' => 0,
    'fname' => 0,
    'lname' => 0,
    'email' => 0,
    'uuname' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579027988092e5_02389038',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579027988092e5_02389038')) {
function content_579027988092e5_02389038 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '887249254579027987d38d2_99008481';
?>
<div style="text-align:center;">
<h2>Profile</h2>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform" action="index.php" method="post">
<input type="hidden" name="section" value="save_profile">
<table class="table" width=500 align="center">
        <tr>
                <td><b>First Name:</b><br><input type="text" name="fname" value="<?php echo $_smarty_tpl->tpl_vars['fname']->value;?>
" size="30" required></td>
        </tr>
        <tr>
                <td><b>Last Name:</b><br><input type="text" name="lname" value="<?php echo $_smarty_tpl->tpl_vars['lname']->value;?>
" size="30" required></td>
        </tr>

	<tr>
		<td><b>Email:</b><br><input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" size="30" required></td>
	</tr>
	<tr>
		<td><b>Username:</b><br><?php echo $_smarty_tpl->tpl_vars['uuname']->value;?>
</td>
	</tr>
	<tr>
		<td><b>Password:</b><br><input type="password" name="uupass" placeholder="************"></td>
	</tr>

        <tr>
                <td><center>
                <input type="submit" name="login" value="Save" class="btn btn-primary"></center></td>
        </tr>
</table>
</form>
</div>
<?php }
}
?>