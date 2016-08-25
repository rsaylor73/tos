{literal}
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
    <!--<script src="js/jquery.min.js"></script>-->

   <script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
   <script src="js/bootstrap.js"></script>
   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
   <script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.menu.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.autocomplete.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.dialog.js"></script>
   <script src='https://www.google.com/recaptcha/api.js'></script>
   <script type="text/javascript" src="js/jquery.tablesorter.js"></script> 


   <script src="js/jscolor.js"></script>

  <script type="text/javascript" src="js/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

<script type="text/javascript" src="tinymce/tinymce.min.js"></script>

      <script type="text/javascript">

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
      </script>

</head>
{/literal}

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
            <li {if $active eq "home"}class="active"{/if}><a href="index.php">Home</a></li>

      {if $logged eq 'yes'}
      <li class="dropdown {if $active eq "tools"}active{/if}">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tools<span class="caret"></span></a>
        <ul class="dropdown-menu">
		<li><a href="#">Send Email</a></li>
        </ul>
      </li>
	{/if}

	    {if $logged eq 'yes'}
            <li {if $active eq "logout"}class="active"{/if}><a href="index.php?section=logout">Logout</a></li>
	    {/if}

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<br><br><br><br>

    <div class="container">
          <div class="jumbotron">
