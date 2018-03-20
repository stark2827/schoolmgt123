update_syallbus.php
<?php
 
/*
 * Following code will update a syllabus information
 * 
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['syllabus']) && isset($_POST['Class_id']) && isset($_POST['Subject_id']) && isset($_POST['Chapters'])) {
 
    $syllabus_id = $_POST['syllabus_id'];
    $Class_id = $_POST['Class_id'];
    $Subject_id = $_POST['Subject_id'];
	$Chapters = $_POST['Chapters'];
    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched syllabus_id
    $result = mysql_query("UPDATE syllabus_master SET Class_id = '$Class_id', Subject_id = '$Subject_id', Chapters = '$Chapters' WHERE syllabus_id = $syllabus_id");
 
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