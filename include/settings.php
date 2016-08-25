<?php
// Set global setting for the path
define('PATH',$_SERVER['DOCUMENT_ROOT']);

// user config area
$username = "admin";
$password = "password";
$sitename = "Frozen Web Host";
$site_email = "support@frozenwebhost.com";


// email headers
$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: $sitename <$site_email>\r\n";
$header .= "Reply-To: $sitename <$site_email>\r\n";
$header .= "X-Priority: 3\r\n";
$header .= "X-Mailer: PHP 7.5.43 /" . phpversion()."\r\n";

// system use - DO NOT MODIFY
define(USERNAME,$username);
define(PASSWORD,$password);
define(HEADERS,$header);
?>
