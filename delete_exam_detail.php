<?php
 
/*
 * Following code will delete a exam from table
 
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Exam_id'])) {
    $Exam_id = $_POST['Exam_id'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched exam name
    $result = mysql_query("DELETE FROM exam_master WHERE Exam_id = $Exam_id");
 
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = "1";
        $response["message"] = "Exam successfully deleted";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] = "0";
        $response["message"] = "No Exam found";
 
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