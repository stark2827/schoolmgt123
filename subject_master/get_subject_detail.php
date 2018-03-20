get_Subject_details.php
<?php
 
/*
 * Following code will get single subject details
 * A subject is identified by subject_id
 */
 
// array for JSON response
$response = array();
 
// include db connect Subject
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Subject_id"])) {
    $Subject_id = $_GET['Subject_id'];
 
    // get a Subject from Subject table
    $result = mysql_query("SELECT * FROM subject_master WHERE Subject_id = $Subject_id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $Subject = array();
            $Subject["Subject_id"] = $result["Subject_id"];
            $Subject["Subject_name"] = $result["Subject_name"];
            
            // success
            $response["success"] = 1;
 
            // user node
            $response["Subject"] = array();
 
            array_push($response["Subject"], $Subject);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No Subject found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // not found
        $response["success"] = 0;
        $response["message"] = "No Subject found";
 
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