<?php

/*
 * Following code will get login details
 
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
$result = "";
if(isset($_POST["Login_Type"]))
{
	$Login_Type = $_POST["Login_Type"];

		
			if(strcasecmp($Login_Type,"Admin")== 0){
				$Admin_id = $_POST['Admin_id'];
				$Admin_password = $_POST['Admin_password'];

				$result = mysql_query("SELECT * FROM admin_master WHERE Admin_id = '".$Admin_id."' && Admin_password = '".$Admin_password."'");
	}
	else if(strcasecmp($Login_Type,"Student")==0)
	{
				$Student_GRNO = $_POST['Student_GRNO'];
			$Student_password = $_POST['Student_password'];
			$result = mysql_query("SELECT * FROM student_master WHERE Student_GRNO = '".$Student_GRNO."' && Student_password = '".$Student_password."'");
	
	}
	else if(strcasecmp($Login_Type,"Teacher")==0){
			$Staff_Email_id = $_POST['Staff_Email_id'];
			$Staff_password = $_POST['Staff_password'];
			$result = mysql_query("SELECT * FROM staff_master WHERE Staff_Email_id = '".$Staff_Email_id."' && Staff_password = '".$Staff_password."'");
	
	}
	else if(strcasecmp($Login_Type,"Clerk")==0){
			$Staff_Email_id = $_POST['Staff_Email_id'];
			$Staff_password = $_POST['Staff_password'];
			$result = mysql_query("SELECT * FROM staff_master WHERE Staff_Email_id = '".$Staff_Email_id."' && Staff_password = '".$Staff_password."'");
	}
	
	if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $response["success"] = "1";
			$response["message"] = "Login Successful.";
  
            // user node
            //$response["class"] = array();
 
            //array_push($response["class"], $class);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = "0";
            $response["message"] = "Not found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = "0";
        $response["message"] = "Not found";
 
        // echo no users JSON
        echo json_encode($response);
    }
	
}


else {
    // required field is missing
    $response["success"] = "0";
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}

?>