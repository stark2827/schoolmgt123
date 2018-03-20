get_all_classes.php
<?php
 
/*
 * Following code will list all the classes
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all classes from Class_Master table
$result = mysql_query("SELECT * FROM class_master") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // classes node
    $response["classes"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp class array
        $class = array();
        $class["Class_id"] = $row["Class_id"];
        $class["Class_name"] = $row["Class_name"];
        $class["Class_division"] = $row["Class_division"];
 
        // push single class into final response array
        array_push($response["classes"], $class);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No classes found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>