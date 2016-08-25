<?php /* Smarty version 3.1.27, created on 2016-08-24 19:37:21
         compiled from "/home/frozen/public_html/templates/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:57721450257be3dc155f1f5_80790448%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b8e5565d72b13d223bc140943e0bf95417c3108' => 
    array (
      0 => '/home/frozen/public_html/templates/header.tpl',
      1 => 1472085428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57721450257be3dc155f1f5_80790448',
  'variables' => 
  array (
    'active' => 0,
    'logged' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57be3dc15a9dd6_31389691',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57be3dc15a9dd6_31389691')) {
function content_57be3dc15a9dd6_31389691 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '57721450257be3dc155f1f5_80790448';
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

    <title>Frozen :: Admin</title>

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
 type="text/javascript" src="tinymce/tinymce.min.js"><?php echo '</script'; ?>
>

      <?php echo '<script'; ?>
 type="text/javascript">

      tinymce.init({
         mode: "exact",
         elements: "tiny,tiny2,tiny3,tiny4",
         theme: "modern",
         force_br_newlines : false,
         force_p_newlines : false,
         forced_root_block : '',
         height : "300",
         verify_html : "false",


         style_formats : [
         {title : 'Page Title', inline : 'span',
            styles : {
               'font-family': 'Palatino Linotype, Book Antiqua, Palatino, serif',
               'font-size': '24px',
               'font-weight': 'bold',
               'color': '#094C7B',
               'letter-spacing': '-2px'
            }
         },
         {title : 'SubTitle', inline : 'span',
            styles : {
               'font-family': 'Verdana, Geneva, sans-serif',
               'font-size': '14px',
               'font-weight': 'normal',
               'color': '#094C7B'
            }
         },
         {title : 'Red text', inline : 'span',
            styles : {
               'color': '#C00000'
            }
         },
         {title : 'Blue text', inline : 'span',
            styles : {
               'color': '#094C7B'
            }
         },
         {title : 'Small text', inline : 'span',
            styles : {
               'font-family': 'Verdana, Geneva, sans-serif',
               'font-size': '10px'
            }
         },
    ],
         plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
         ],
         toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
         toolbar2: "print preview | forecolor backcolor",
         image_advtab: true,
      });
      <?php echo '</script'; ?>
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
            <li <?php if ($_smarty_tpl->tpl_vars['active']->value == "home") {?>class="active"<?php }?>><a href="index.php">Home</a></li>

      <?php if ($_smarty_tpl->tpl_vars['logged']->value == 'yes') {?>
      <li class="dropdown <?php if ($_smarty_tpl->tpl_vars['active']->value == "tools") {?>active<?php }?>">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tools<span class="caret"></span></a>
        <ul class="dropdown-menu">
		<li><a href="#">Send Email</a></li>
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