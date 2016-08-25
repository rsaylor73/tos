<?php /* Smarty version 3.1.27, created on 2016-08-13 05:47:41
         compiled from "/home/syf/public_html/syf-admin/templates/upload_csv_form.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:124706267157aefacd6c6c63_15963958%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4d7ab1cf1b2f7c08f8489af88f299a2b1d50742' => 
    array (
      0 => '/home/syf/public_html/syf-admin/templates/upload_csv_form.tpl',
      1 => 1471084156,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124706267157aefacd6c6c63_15963958',
  'variables' => 
  array (
    'type' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57aefacd72ebf0_74566629',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57aefacd72ebf0_74566629')) {
function content_57aefacd72ebf0_74566629 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '124706267157aefacd6c6c63_15963958';
?>
<div style="text-align:center;">

<?php if ($_smarty_tpl->tpl_vars['type']->value == "phone") {?>
<h2>Upload Phone Batch CSV</h2>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['type']->value == "email") {?>
<h2>Upload Email Batch CSV</h2>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<form name="myform" action="index.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="section" value="process_csv">
<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
<table class="table" width=500 align="center">
        <tr>
                <td><b>Select CSV File:</b><br><input type="file" name="csv_file"></td>
        </tr>
        <tr>
                <td><center>
                <input type="submit" value="Upload" class="btn btn-primary"></center></td>
        </tr>
</table>
</form>
</div>
<?php }
}
?>