update_Admin_Master.php.php
<?php
 
/*
 * Following code will update a information
 * Admin is identified by Admin_id
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Admin_id']) && isset($_POST['Admin_password'])) {
 
    $Admin_id = $_POST['Admin_id'];
    $Admin_password = $_POST['Admin_password'];
    
    // include db connect Admin_Master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched admin_id'".$id."'
    
    $result = mysql_query("UPDATE admin_master SET Admin_password = '".$Admin_password."' WHERE Admin_id = '".$Admin_id."'");
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = "1";
        $response["message"] = "successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = "0";
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>