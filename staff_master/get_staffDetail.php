get_staff_details.php
<?php
 
/*
 * Following code will get perticuler staff details
 * A staff  is identified by staff_maill_id
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Staff_Email_id"])) {
    $Staff_Email_id = $_GET['Staff_Email_id'];
 
    // get a staff detail  from staff table
    $result = mysql_query("SELECT * FROM staff_master WHERE Staff_Email_id = $Staff_Email_id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $staff = array();
            $staff["Staff_Email_id"] = $result["Staff_Email_id"];
            $Staff = $result['Staff_name'];

			$Staff = $result['Staff_ProfilePic'];
			$Staff = $result['Staff_Address'];

			$Staff = $result['Staff_Qualification'];
			$Staff = $result['Staff_Type'];
			
			$Staff = $result['Staff_Gender'];
			$Staff = $result['Staff_phoneNo'];
			
		// success
            $response["success"] = 1;
 
            // user node
            $response["staff"] = array();
 
            array_push($response["staff"], $staff);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "Not found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "Not found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>