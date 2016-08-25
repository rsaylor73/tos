<?php

/* This is a chain class system. The first path of the class are:

loader > users > reports > Core

*/

include PATH."/class/core.class.php";

class loader extends Core {

	public $linkID;
	function __construct($linkID){ $this->linkID = $linkID; }


	/* The load_module function performs the routing of functions */

	public function load_module($module) {

		if (method_exists('loader',$module)) {
			$this->$module();
		} elseif (method_exists('Core',$module)) {
			$this->$module();
		} else {
			print "<br><font color=red>The $module method does not exist.</font><br>";
			die;
		}
	}

}
?>
