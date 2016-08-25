<?php
session_start();

$sesID = session_id();
// init
include_once "../include/settings.php";
include_once "../include/templates.php";


if (($_GET['uuname'] == USERNAME) && ($_GET['uupass'] == PASSWORD)) {
	$_SESSION['logged'] = "TRUE";
	foreach ($_GET as $key=>$value) {
		$_SESSION[$key] = $value;
	}
	$ok = "1";
	print "<div class=\"modal-body\"><br><br><font color=green>Login sucessfull. Loading please wait...</font><br><bR></div>";

	?>
	<script>
	setTimeout(function() {
		window.location.replace('index.php?section=dashboard')
	}
	,2000);
	</script>
	<?php
}

if ($ok != "1") {
	$smarty->assign('msg','<center><font color=red>Login failed.</font></center>');
	$smarty->display('login.tpl');
}
?>

