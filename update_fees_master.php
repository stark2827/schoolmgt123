<?php
 
/*
 * Following code will update a information 
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Fees_Paid_date']) && isset($_POST['Class_id']) 
	&& isset($_POST['Fees_Type']) && isset($_POST['Student_GRNO']) 
	&& isset($_POST['Total_Amount'])&& isset($_POST['Paid_Amount'])) {
 
  
    
	$Fees_Paid_date = $_POST['Fees_Paid_date'];
	$Total_Amount = $_POST['Total_Amount'];
    $Class_id = $_POST['Class_id'];
	$Fees_Type = $_POST['Fees_Type'];
    $Student_GRNO = $_POST['Student_GRNO'];
    $Paid_Amount = $_POST['Paid_Amount'];
	    
    // include db connect fees_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched exam_id
    
    $result = mysql_query("UPDATE fees_master SET Fees_Paid_date = '$Fees_Paid_date', Total_Amount = '$Total_Amount', Class_id = '$Class_id',
Fees_Type = '$Fees_Type', Student_GRNO = '$Student_GRNO', Paid_Amount = '$Paid_Amount' WHERE Class_id = $Class_id");

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