delete_fees_detail.php
<?php
 
/*
 * Following code will delete a fees detail from table
 
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Fees_id'])) {
    $Fees_id = $_POST['Fees_id'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched fees id
    $result = mysql_query("DELETE FROM fees_master WHERE Fees_id = $Fees_id");
 
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "successfully deleted";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // not found
        $response["success"] = 0;
        $response["message"] = "No class found";
 
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