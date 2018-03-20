get_class_details.php
<?php
 
/*
 * Following code will getschool details
 * 
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["School_id"])) {
    $School_id = $_GET['School_id'];
 
    // get a School detail from School table
    $result = mysql_query("SELECT * FROM School_master WHERE School_id = $School_id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $School = array();
            $School["School_id"] = $result["School_id"];
            $School["School_name"] = $result["School_name"];
            $School["School_Address"] = $result["School_Address"];
			$School["School_Image"] = $result["School_Image"];
            $School["School_phonNo"] = $result["School_phonNo"];
            $School["School_Class_Image"] = $result["School_Class_Image"];
			$School["School_Library_Image"] = $result["School_Library_Image"];
			$School["School_Lab_Image"] = $result["School_Lab_Image"];
			
			
            // success
            $response["success"] = 1;
 
            // user node
            $response["School"] = array();
 
            array_push($response["School"], $School);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // not found
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