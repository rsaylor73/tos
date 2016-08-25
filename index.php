<?php
session_start();
include "include/settings.php";
include "include/templates.php";
$smarty->display('header.tpl');

if ($_GET['section'] != "") {
        $section = $_GET['section'];
}
if ($_POST['section'] != "") {
        $section = $_POST['section'];
}

$check = $core->check_login();
if ($check == "FALSE") {
	$smarty->display('login.tpl');
} else {
	if ($section == "") {
		$core->load_module('dashboard');
	} 

	if ($section != "") {
		$core->load_module($section);
	}
}

// footer
$year = date("Y");
$smarty->assign('year',$year);
$smarty->display('footer.tpl');
?>
