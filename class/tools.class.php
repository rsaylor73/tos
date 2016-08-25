<?php

include PATH."/class/core.class.php";
                
class tools extends Core {
	public function pre_ping_email_batch() {
		$type = "email";
		$this->upload_csv_file($type);
	}

	public function pre_ping_phone_batch() {
		$type = "phone";
		$this->upload_csv_file($type);
	}


	public function upload_csv_file($type) {
		$data['type'] = $type;
		$template = "upload_csv_form.tpl";
		$this->load_smarty($data,$template);
	}

	public function file_types($fileType) {
		switch ($fileType) {
			case "text/csv":
			$result = ".csv";
			break;

			default:
			// this will return an error
			$result = "1";
			break;
		}

		return($result);
	}


	public function process_csv() {
	        $fileName = $_FILES['csv_file']['name'];
                $tmpName  = $_FILES['csv_file']['tmp_name'];
                $fileSize = $_FILES['csv_file']['size'];
                $fileType = $_FILES['csv_file']['type'];

                if ($fileName != "") {
                        $ext = $this->file_types($fileType);
                        if ($ext == "1") {
                                print "Supported file types are<br>CSV<br>";
                                print "To have your file type added please email the administrator this code: <b>$fileType</b><br>";
                        } else {

                                $today = date("Ymd");
                                $new_file = date("U");
                                $new_file .= rand(50,500);
                                $new_file .= $ext;
                                move_uploaded_file("$tmpName", PATH . "/.input/$new_file");
                                chmod(PATH . "/.input/$new_file", 0644);
				$this->read_csv($new_file,$_POST['type']);
			}
		} else {
			// error
			$this->error();
		}
	}

        public function return_js_error($msg) {
                echo $msg;
        }        

	public function api_email_check($check_email) {
                        if ($check_email == "") {
                                return('email invalid');
                        }
                        $today = date("Y-m-d");
                        $start = date('Y-m-d',strtotime($today . "-30 days"));
                        $end = date('Y-m-d',strtotime($today . "+1 days"));

                        // check DB 1:
                        $sql = "SELECT `email` FROM `entries` WHERE `email` = '$check_email' AND `timestamp` BETWEEN '$start' AND '$end'";
                        $result = $this->new_mysql($sql);
                        while ($row = $result->fetch_assoc()) {
                                $found = "1";
                        }


                        // check DB 2:
                        $sql2 = "SELECT `email` FROM `entries` WHERE `email` = '$check_email' AND `timestamp` BETWEEN '$start' AND '$end'";
                        $linkID2 = new mysqli(HOST2, USER2, PASSWORD2, DATABASE2);
                        $result2 = $linkID2->query($sql2);
                        while ($row2 = $result2->fetch_assoc()) {
                                $found = "1";
                        }

                        if ($found == "1") {
                                $data = "duplicate";
                                //$data['email_duplicate'] = "1";
                        } else {
                                $data = "successfully";
                                //$data['email_duplicate'] = "0";
                        }

                        // 1 email was found
                        // 0 email was not found
                        return($data);
	}

	public function api_phone_check($check_phone) {
                        $today = date("Y-m-d");
                        $start = date('Y-m-d',strtotime($today . "-30 days"));
                        $end = date('Y-m-d',strtotime($today . "+1 days"));

                        $check_phone = intval(preg_replace('/[^0-9]+/', '', $check_phone), 10);
                        $test1 = substr($check_phone, 0,1);
                        if ($test1 == "1") {
                                // removed the leading 1 if any
                                $length = strlen($check_phone);
                                $check_phone = substr($check_phone,1,$length);
                        }

                        // validate length of number (should be 10)
                        $length = strlen($check_phone);
                        if ($length != "10") {
				return('phone invalid');
                        }

                        // get area code and prefix
                        $area_code = substr($check_phone,0,3);
                        $prefix = substr($check_phone,3,3);
                        $suffix = substr($check_phone,6,4);

                        // check DB if area + prefix is valid
                        $sql3 = "
                        SELECT
                                `pv`.`area_code`,
                                `pv`.`prefix`

                        FROM
                                `phone_validation` pv

                        WHERE
                                `pv`.`area_code` = '$area_code'
                                AND `pv`.`prefix` = '$prefix'

                        ";

                        $linkID3 = new mysqli(HOST3, USER3, PASSWORD3, DATABASE3);
                        $result3 = $linkID3->query($sql3);
                        while ($row3 = $result3->fetch_assoc()) {
                                $found = "1";
                        }

                        if ($found == "1") {
                                $data = "successfully";
                                //$data['phone_validated'] = "1";
                        } else {
                                $data = "failure";
                                //$data['phone_validated'] = "0";
                        }
                        // 1 phone was validated
                        // 0 phone was not validated

                        // check if phone exists in internal DB
                        if ($found == "1") {
                                $sql = "SELECT `phone_home` FROM `entries` WHERE `phone_home` = '".$area_code."-".$prefix."-".$suffix."' AND `timestamp` BETWEEN '$start' AND '$end'";
                                $result = $this->new_mysql($sql);
                                while ($row = $result->fetch_assoc()) {
                                        $found2 = "1";
                                }

                                $sql2 = "SELECT `phone_home` FROM `entries` WHERE `phone_home` = '".$area_code."-".$prefix."-".$suffix."' AND `timestamp` BETWEEN '$start' AND '$end'";
                                $linkID2 = new mysqli(HOST2, USER2, PASSWORD2, DATABASE2);
                                $result2 = $linkID2->query($sql2);
                                while ($row2 = $result2->fetch_assoc()) {
                                        $found2 = "1";
                                }

                                if ($found2 == "1") {
                                        $data = "duplicate";
                                        //$data['phone_duplicate'] = "1";
                                } else {
                                        $data = "successfully";
                                        //$data['phone_duplicate'] = "0";
                                }

                                // 1 phone was found
                                // 0 phone was not found
                        }
                        //echo json_encode($data);
                        return($data);


	}


	public function read_csv($file,$type) {
		$csv = fopen(PATH . "/.input/$file","r");
		while(! feof($csv)) {
			$data[] = fgetcsv($csv);
		}
		fclose($csv);

		print "<br>Upload complete processing. This can take 5 to 30 mins depending on the size of the file.<br><b>Do not close your browser while the file is being processed. 
		When the process is complete there will be a download link at the bottom of the page.</b><br>";

		switch ($type) {
			case "email":

                        foreach ($data as $key=>$array) {
				if (is_array($array)) {
	                                foreach ($array as $null=>$email) {
        	                                $result = $this->api_email_check($email);
                	                        $output .= "$email,$result\n";
						print "Output: $email,$result<br>";
                        	                $ok = "1";
	                                }
				}
                        }
                        if ($ok == "1") {
                                $this->write_csv($file,$output);
                        } else {
                                $this->error();
                        }

			break;

			case "phone":
			foreach ($data as $key=>$array) {
                                if (is_array($array)) {
					foreach ($array as $null=>$phone) {
						$result = $this->api_phone_check($phone);
						$output .= "$phone,$result\n";
						print "Output: $phone,$result<br>";
						$ok = "1";
					}
				}
			}
                        if ($ok == "1") {
                                $this->write_csv($file,$output);
                        } else {
                                $this->error();
                        }
			break;

		}
	}

	public function write_csv($file,$data) {
		$fh = fopen(PATH . "/.output/$file","w");
		fwrite($fh,$data);
		fclose($fh);
		print "<br><br>Your file is ready to be downloaded. Please click <a href=\"./.output/$file\" target=_blank>here</a> to download the file.<br><br>";
	}
}
?>
