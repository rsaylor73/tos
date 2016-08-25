<?php /* Smarty version 3.1.27, created on 2016-06-26 08:55:48
         compiled from "/home/syf/public_html/admin/templates/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:284011979576fdee43bf4d6_46922957%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1b93a046db192e2a209896882ddf305c8594156' => 
    array (
      0 => '/home/syf/public_html/admin/templates/header.tpl',
      1 => 1466949345,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284011979576fdee43bf4d6_46922957',
  'variables' => 
  array (
    'active' => 0,
    'userType' => 0,
    'logged' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_576fdee445d451_67666578',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_576fdee445d451_67666578')) {
function content_576fdee445d451_67666578 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '284011979576fdee43bf4d6_46922957';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">

    <title>SYF :: Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/desktop.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <!--<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>-->

   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/jquery-1.9.1.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="js/bootstrap.js"><?php echo '</script'; ?>
>
   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.core.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.menu.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.autocomplete.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.dialog.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js'><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.tablesorter.js"><?php echo '</script'; ?>
> 


   <?php echo '<script'; ?>
 src="js/jscolor.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.timepicker.js"><?php echo '</script'; ?>
>
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
  <?php echo '<script'; ?>
 type="text/javascript" src="js/tinymce/tinymce.min.js"><?php echo '</script'; ?>
>


</head>


<body>

  <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
	    <li><img src="images/syf-logo-hi-res.png">&nbsp;&nbsp;&nbsp;</li>
            <li <?php if ($_smarty_tpl->tpl_vars['active']->value == "home") {?>class="active"<?php }?>><a href="index.php">Home</a></li>

	    <?php if ($_smarty_tpl->tpl_vars['userType']->value == 'Admin') {?>
            <li class="dropdown <?php if (!isset($_smarty_tpl->tpl_vars['active'])) $_smarty_tpl->tpl_vars['active'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['active']->value = "users") {?>active<?php }?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users<span class="caret"></span></a>
              <ul class="dropdown-menu">
	      <li><a href="index.php?section=adduser">Add User</a></li>
              <li><a href="index.php?section=viewusers">View Users</a></li>
            </ul>
            </li>
	    <?php }?>


	    <?php if ($_smarty_tpl->tpl_vars['logged']->value == 'yes') {?>
            <li <?php if ($_smarty_tpl->tpl_vars['active']->value == "logout") {?>class="active"<?php }?>><a href="index.php?section=logout">Logout</a></li>
	    <?php }?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<br><br><br><br>

    <div class="container">
          <div class="jumbotron">
<?php }
}
?>