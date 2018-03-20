update_subject.php
<?php
 
/*
 * Following code will update a class information
 * A subject is identified by Subject_id
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Subject_id']) && isset($_POST['Subject_name'])) {
 
    $Subject_id = $_POST['Subject_id'];
    $Subject_name = $_POST['Subject_name'];
    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched Class_id
    $result = mysql_query("UPDATE subject_master SET Subject_name = '$Subject_name' WHERE Subject_id = $Subject_id");
 
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