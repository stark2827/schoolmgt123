update_class.php
<?php
 
/*
 * Following code will update a class information
 * A class is identified by Class_id
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Class_id']) && isset($_POST['Class_name']) && isset($_POST['Class_division'])) {
 
    $Class_id = $_POST['Class_id'];
    $Class_name = $_POST['Class_name'];
    $Class_division = $_POST['Class_division'];
    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched Class_id
    $result = mysql_query("UPDATE class_master SET Class_name = '$Class_name', Class_division = '$Class_division' WHERE Class_id = $Class_id");
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Class successfully updated.";
 
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