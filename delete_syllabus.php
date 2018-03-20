delete_syllabus.php
<?php
 
/*
 * Following code will delete a syllabus from table
 * A syllabus is identified by syllabus_id
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['syllabus_id'])) {
    $syllabus_id = $_POST['syllabus_id'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = mysql_query("DELETE FROM syllabus_Master WHERE syllabus_id = $syllabus_id");
 
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = "1";
        $response["message"] = "successfully deleted";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] ="0";
        $response["message"] = "Not found";
 
        // echo no users JSON
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