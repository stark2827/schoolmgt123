update_staff_master.php
<?php
 

// Following code will update a information
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Staff_Email_id']) && isset($_POST['Staff_password']) && isset($_POST['Staff_name']) && isset($_POST['Staff_ProfilePic']) && isset($_POST['Staff_Address']) 
		  && isset($_POST['Staff_Qualification']) && isset($_POST['Staff_Type']) && isset($_POST['Staff_Gender']) && isset($_POST['Staff_phoneNo'])) {
 
    $Staff_Email_id = $_POST['Staff_Email_id'];
	$Staff_password = $_POST['Staff_password'];
    $Staff_name = $_POST['Staff_name'];

	$Staff_ProfilePic = $_POST['Staff_ProfilePic'];
    $Staff_Address = $_POST['Staff_Address'];

    $Staff_Qualification = $_POST['Staff_Qualification'];
    $Staff_Type = $_POST['Staff_Type'];
	
	$Staff_Gender = $_POST['Staff_Gender'];
    $Staff_phoneNo = $_POST['Staff_phoneNo'];
   
   // include db connect school_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched staff_mail_id
    
   
	$result = mysql_query("UPDATE staff_master SET Staff_Email_id = '$Staff_Email_id', Staff_password = '$Staff_password', Staff_name = '$Staff_name', Staff_ProfilePic = '$Staff_ProfilePic', 
	Staff_Address = '$Staff_Address', Staff_Qualification = '$Staff_Qualification', Staff_Type = '$Staff_Type', Staff_Gender = '$Staff_Gender', Staff_phoneNo = '$Staff_phoneNo'	WHERE Staff_Email_id = $Staff_Email_id");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>