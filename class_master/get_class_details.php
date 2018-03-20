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
if (isset($_GET["Class_id"])) {
    $Class_id = $_GET['Class_id'];
 
    // get a class from class table
    $result = mysql_query("SELECT * FROM class_master WHERE Class_id = $Class_id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $class = array();
            $class["Class_id"] = $result["Class_id"];
            $class["Class_name"] = $result["Class_name"];
            $class["Class_division"] = $result["Class_division"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["class"] = array();
 
            array_push($response["class"], $class);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No Class found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No Class found";
 
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