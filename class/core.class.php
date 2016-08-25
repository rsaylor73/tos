<?php

/* This is the last class in the chain */

class Core {
	//public $linkID;
	//function __construct($linkID){ $this->linkID = $linkID; }

	public function new_mysql($sql) {
		$result = $this->linkID->query($sql) or die($this->linkID->error.__LINE__);
		return $result;
	}

	public function error() {
		// Generic error message
	      	$template = "error.tpl";
	      	$data = array();
      		$this->load_smarty($data,$template);
		die;
	}

	public function check_login() {
		if (($_SESSION['uuname'] == USERNAME) && ($_SESSION['uupass'] == PASSWORD)) {
			$found = "1";
		}

	      	if ($found == "1") {
      			return "TRUE";
		} else {
			return "FALSE";
		}
	}

        // User Dashboard
        public function dashboard() {
                $today = date("l F jS, Y @ g:i A");
                print "<i><b>$today</b></i><br>";

                print '<h3><span class="label label-pill label-primary">Frozen Web Host : Abuse Email</span></h3><br>';


		print "<form action=\"index.php\" method=\"post\">
		<input type=\"hidden\" name=\"section\" value=\"send_email\">
		";

		print "<table class=\"table\">";

		print "<tr><td>To:</td><td><input type=\"text\" name=\"email\" placeholder=\"recipient@somedomain.com\" size=40 required></td></tr>
		<tr><td>Subject:</td><td><input type=\"text\" name=\"subject\" placeholder=\"Subject\" size=40 required></td></tr>
		<tr><td>From:</td><td><input type=\"text\" name=\"from\" value=\"support@frozenwebhost.com\" size=40 required></td></tr>
		";

		print "<tr><td colspan=2><textarea id=\"tiny\" name=\"msg\">

		Hi,<br><br>

Please investigate the issue outlined below & let us know what action(s) is taken to resolve the issue.<br><br>

================================================================================================<br>
<br>
** CONTENT FROM <b>BODY</b> OF FORM WOULD GO HERE **<br>
<br>
================================================================================================<br>
<br>
Thank You.<br>
Frozenwebhost.com Support<br>
		</textarea></td></tr>";
		print "<tr><td colspan=2><input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\"></td></tr>
		</table>
		</form>";
	}

	public function send_email() {

		$email = mail($_POST['email'],$_POST['subject'],$_POST['msg'],HEADERS);
		if ($email == "TRUE") {
			print "<br><font color=green>The email was sent to <b>$_POST[email]</b></font><br>";
		} else {
			print "<br><font color=red>The email failed to send to <b>$_POST[email]</b></font><br>";
		}

		$this->dashboard();
	}


	public function load_smarty($vars,$template) {
		// loads the PHP Smarty class
		require_once(PATH.'/libs/Smarty.class.php');
		$smarty=new Smarty();
		$smarty->setTemplateDir(PATH.'/templates/');
		$smarty->setCompileDir(PATH.'/templates_c/');
		$smarty->setConfigDir(PATH.'/configs/');
		$smarty->setCacheDir(PATH.'/cache/');
		if (is_array($vars)) {
			foreach ($vars as $key=>$value) {
				$smarty->assign($key,$value);
			}
		}
		$smarty->display($template);
	}

	public function logout() {
		$data['msg'] = "<font color=green>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have been logged out. Loading...</font>";
		$this->load_smarty($data,'message.tpl');

		session_destroy();
		?>
	   	<script>
	   	setTimeout(function() {
		      window.location.replace('index.php')
	   	}
		,2000);

	   	</script>
		<?php
	}

	// Login form
	public function login($msg) {
		$data = array();
		if ($msg != "") {
			$data['msg'] = "$msg";	
		} else {
			$data['msg'] = "0";
		}
		$template = "login.tpl";
		$this->load_smarty($data,$template);
	}

}
?>
