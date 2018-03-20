<?php
 
/*
 * Following code will create a new Staff Master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Staff_Email_id']) && isset($_POST['Staff_password']) && isset($_POST['Staff_name'])  
		  && isset($_POST['Staff_Qualification']) && isset($_POST['Staff_Type']) && isset($_POST['Staff_Gender']) && isset($_POST['Staff_phoneNo'])
	      && isset($_POST['Staff_JoinDate']) && isset($_POST['Staff_Experince'])) 
		  {
 
    $Staff_Email_id = $_POST['Staff_Email_id'];
	$Staff_password = $_POST['Staff_password'];
    $Staff_name = $_POST['Staff_name'];
	$Staff_ProfilePic = $_POST['Staff_ProfilePic'];
	$Staff_Qualification = $_POST['Staff_Qualification'];
    $Staff_Type = $_POST['Staff_Type'];	
	$Staff_Gender = $_POST['Staff_Gender'];
    $Staff_phoneNo = $_POST['Staff_phoneNo'];
	$Staff_JoinDate = $_POST['Staff_JoinDate'];
	$Staff_Experince = $_POST['Staff_Experince'];
	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO staff_master(Staff_Email_id, Staff_password, Staff_name, 
	Staff_ProfilePic, Staff_Qualification, Staff_Type, Staff_Gender, Staff_phoneNo, Staff_JoinDate, Staff_Experince) 
							VALUES('$Staff_Email_id', '$Staff_password', '$Staff_name', 
							'$Staff_ProfilePic', '$Staff_Qualification', '$Staff_Type', 
							'$Staff_Gender', '$Staff_phoneNo', '$Staff_JoinDate', '$Staff_Experince')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = "1";
        $response["message"] = "successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row	
        $response["success"] = "0";
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = "0";
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>