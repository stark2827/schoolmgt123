<?php
 
/*
 * Following code will list all the Syllabus
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all Syllabus from syllabus_master table
$result = mysql_query("SELECT * FROM syllabus_master") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // Syllabus node
    $response["Syllabus"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp class array
        $class = array();
        $class["Class_id"] = $row["Class_id"];
        $class["Subject_id"] = $row["Subject_id"];
        $class["Chapters"] = $row["Chapters"];
 
 
        // push single class into final response array
        array_push($response["Syllabus"], $class);
    }
    // success
    $response["success"] = "1";
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = "0";
    $response["message"] = "Not found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>