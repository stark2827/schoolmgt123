get_class_details.php
<?php
 
/*
 * Following code will get single class details
 * A class is identified by class_id
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["Admin_id"]) && isset($_GET["Admin_id"])) {
    $Admin_id = $_GET['Admin_id'];
	$Admin_password = $_GET['Admin_password'];
 
    // get a class from class table
    $result = mysql_query("SELECT * FROM admin_master WHERE Admin_id = $Admin_id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $response["success"] = 1;
 
            // user node
            $response["class"] = array();
 
            array_push($response["class"], $class);
 
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