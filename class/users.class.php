<?php

include PATH."/class/reports.class.php";

class users extends reports {

	// User Dashboard
	public function dashboard() {
		print "<h2>Dashboard :: $_SESSION[fname] $_SESSION[lname]</h2><hr>";
		$today = date("l F jS, Y @ g:i A");
		print "<i><b>$today</b></i><br>";

		print '<h3><span class="label label-pill label-primary">SYF Top 10 Stats</span></h3><br>';

		$hasoffer_types = array('clicks','revenue','conversions');
		$counter = "0";
		foreach ($hasoffer_types as $type) {

			// resets
			$data_table = "";
			$category = "";

			$af = $this->get_daily_heat_affiliates($type);
			$today = date("Ymd");

	                $date1 = date('Ymd',strtotime($today . "-1 days"));
        	        $date2 = date('Ymd',strtotime($today . "-2 days"));
                	$date3 = date('Ymd',strtotime($today . "-3 days"));
	                $date4 = date('Ymd',strtotime($today . "-4 days"));
        	        $date5 = date('Ymd',strtotime($today . "-5 days"));

	                $ndate1 = date('m/d/Y',strtotime($today . "-1 days"));
        	        $ndate2 = date('m/d/Y',strtotime($today . "-2 days"));
                	$ndate3 = date('m/d/Y',strtotime($today . "-3 days"));
	                $ndate4 = date('m/d/Y',strtotime($today . "-4 days"));
        	        $ndate5 = date('m/d/Y',strtotime($today . "-5 days"));

			$series = "0";
			foreach ($af as $key=>$af_array) {
				$affiliateID = $key;
		
				$category .= "'" . $af_array['name'] ."',";
				$data1 = $this->get_daily_heat_affiliates_data($type,$affiliateID,$date1);
                	        $data2 = $this->get_daily_heat_affiliates_data($type,$affiliateID,$date2);
                        	$data3 = $this->get_daily_heat_affiliates_data($type,$affiliateID,$date3);
	                        $data4 = $this->get_daily_heat_affiliates_data($type,$affiliateID,$date4);
        	                $data5 = $this->get_daily_heat_affiliates_data($type,$affiliateID,$date5);

				$data_table .= "[$series,0,$data1],";
                        	$data_table .= "[$series,1,$data2],";
	                        $data_table .= "[$series,2,$data3],";
        	                $data_table .= "[$series,3,$data4],";
                	        $data_table .= "[$series,4,$data5],";
				$series++;
			}
			$data_table = trim($data_table,',');
			$title = "HasOffer Top 10 ($type)";
			$category = trim($category,',');
			$category2 = "'$ndate1','$ndate2','$ndate3','$ndate4','$ndate5'";

			// heat chart - clicks
			$counter++;
        	        $id = "heat_chart_$counter";
	                $heat_chart = $this->heat_chart($id,$data_table,$category,$category2,$title,$type);
        	        print "$heat_chart";
                	print "<div id=\"$id\" style=\"min-width: 310px; height: 400px; margin: 0 auto\"></div>";
		}



		// get_daily_heat_affiliates_data($type,$affiliateID,$date)


		/*
		$this->get_daily('clicks');
		$this->get_weekly('clicks');

		print "<br>";

                $this->get_daily('revenue');
                $this->get_weekly('revenue');

		print "<br>";

		$this->get_daily('conversions');
                $this->get_weekly('conversions');
		*/
	}


	public function list_users($msg="") {
		$this->is_admin();

		$template = "list_users.tpl";
		$data['msg'] = $msg;

		$sql = "SELECT `fname`,`lname`,`userType`,`email`,`id`,`active` FROM `admin_users` ORDER BY `active` ASC, `lname` ASC, `fname` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($this_type != $row['active']) {
				if ($row['active'] == "Yes") {
					$type = "Active";
				} else {
					$type = "In-Active";
				}
				$html .= "<tr><td colspan=4><b>$type Users</b></td></tr>";
				$this_type = $row['active'];
			}
			$html .= "<tr><td>$row[fname] $row[lname]</td><td>$row[userType]</td><td>$row[email]</td><td>
			<input type=\"button\" class=\"btn btn-primary\" value=\"Edit\" onclick=\"document.location.href='index.php?section=edit_user&id=$row[id]'\">&nbsp;&nbsp;
			<input type=\"button\" class=\"btn btn-danger\" value=\"Delete\" onclick=\"if(confirm('You are about to delete $row[fname] $row[lname]. Click OK to continue.') ) {document.location.href='index.php?section=delete_user&id=$row[id]';}\">
			</td></tr>";
			$found = "1";
		}
		if ($found != "1") {
			$html .= "<tr><td colspan=4><font color=blue>There are no users. Please add one.</font></td></tr>";
		}
		$data['html'] = $html;

		$this->load_smarty($data,$template);
	}

	/* This function will allow the admin user to create a new user */
	public function adduser() {
		$this->is_admin();

		$template = "addnewuser.tpl";
		$device = $this->device_type();
		$data['device'] = $device; // no data sent to the template
		$this->load_smarty($data,$template);
	}

	/* This function will perform final error checking on the new user then save the user to the DB */
	public function savenewuser() {
		$this->is_admin();

		// check for duplicate username
		$sql = "SELECT `uuname` FROM `admin_users` WHERE `uuname` = '$_POST[uuname]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found1 = "1";
		}

		if ($found1 == "1") {
			$data['fname'] = $_POST['fname'];
			$data['lname'] = $_POST['lname'];
			$data['email'] = $_POST['email'];
			$data['msg'] = "<br><font color=red>Sorry, but the username <b>$_POST[uuname]</b> is not available.</font><br>";
			$template = "addnewuser.tpl";
			$this->load_smarty($data,$template);
			die; // exit due to error
		}

		// check for duplicate email
		$sql = "SELECT `email` FROM `admin_users` WHERE `email` = '$_POST[email]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found2 = "1";
		}
		if ($found2 == "1") {
			$data['fname'] = $_POST['fname'];
			$data['lname'] = $_POST['lname'];
			$data['uuname'] = $_POST['uuname'];
			$data['msg'] = "<br><font color=red>Sorry, but the email <b>$_POST[email]</b> is not available.</font><br>";
			$template = "addnewuser.tpl";
			$this->load_smarty($data,$template);
			die; // exit due to error
		}

		if (($found1 != "1") && ($found2 != "1")) {
			$pw = md5($_POST['uupass']);
			$today = date("Ymd");
			$sql = "INSERT INTO `admin_users` (`fname`,`lname`,`uuname`,`uupass`,`userType`,`email`,`date_added`,`date_updated`,`active`) VALUES
			('$_POST[fname]','$_POST[lname]','$_POST[uuname]','$pw','$_POST[userType]','$_POST[email]','$today','$today','Yes')
			";
			$result = $this->new_mysql($sql);
			if ($result == "TRUE") {
				$msg = "<br><font color=green>The user <b>$_POST[uuname]</b> was created.</font><br>";
			} else {
				$msg = "<br><font color=red>The user <b>$_POST[uuname]</b> failed to create.</font><br>";
			}
			$this->list_users($msg);
		}
		

	}

	/* This function edits the selected user */
	public function edit_user() {
                $this->is_admin();
                $device = $this->device_type();
                $data['device'] = $device;

		$sql = "SELECT * FROM `admin_users` WHERE `id` = '$_GET[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$template = "edit_user.tpl";
		$this->load_smarty($data,$template);
	}

	/* This function saves the updates for the user */
	public function updateuser() {
                $this->is_admin();

		// check for duplicate email
		$sql = "SELECT * FROM `admin_users` WHERE `email` = '$_POST[email]' AND `id` != '$_POST[id]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found1 = "1";
		}

		if ($found1 == "1") {
                        $data['msg'] = "<br><font color=red>Sorry, but the email <b>$_POST[email]</b> is not available.</font><br>";
			$sql2 = "SELECT * FROM `admin_users` WHERE `id` = '$_POST[id]'";
			$result2 = $this->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {
				foreach ($row2 as $key2=>$value2) {
					$data[$key2] = $value2;
				}
			}
                        $template = "edit_user.tpl";
                        $this->load_smarty($data,$template);
                        die; // exit due to error
		}

		if ($found1 == "") {
			if ($_POST['uupass'] != "") {
				$newpass = md5($_POST['uupass']);
				$pass_sql = " ,`uupass` = '$newpass'  ";
			}
			$today = date("Ymd");
			$sql2 = "UPDATE `admin_users` SET `fname` = '$_POST[fname]',`lname` = '$_POST[lname]', `userType` = '$_POST[userType]', `email` = '$_POST[email]', `active` = '$_POST[active]', `date_updated` = '$today' $pass_sql WHERE `id` = '$_POST[id]'";
			$result2 = $this->new_mysql($sql2);
			if ($result2 == "TRUE") {
                                $msg = "<br><font color=green>The user was updated.</font><br>";
                        } else {
                                $msg = "<br><font color=red>The user failed to create.</font><br>";
                        }
                        $this->list_users($msg);
		}
	}

	/* This function will delete the selected user */
	public function delete_user() {
                $this->is_admin();

		$sql = "DELETE FROM `admin_users` WHERE `id` = '$_GET[id]'";
                $result = $this->new_mysql($sql);
                if ($result == "TRUE") {
                        $msg = "<br><font color=green>The user was deleted.</font><br>";
                } else {
                        $msg = "<br><font color=red>The user failed to delete.</font><br>";
                }
                $this->list_users($msg);
	}

}
?>
