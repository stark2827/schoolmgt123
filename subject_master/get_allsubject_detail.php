get_all_examDetail.php
<?php
 
/*
 * Following code will list all the subject
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all classes from exam_master table
$result = mysql_query("SELECT * FROM subject_master") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // classes node
    $response["subject"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp exam array
        $exam = array();
        $exam["Subject_id"] = $row["Subject_id"];
        $exam["Subject_name"] = $row["Subject_name"];
         
    
        // push single exam into final response array
        array_push($response["subject"], $subject);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "Not found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>