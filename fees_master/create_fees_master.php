Fees_Master.php

<?php
 
/*
 * Following code will create a new school master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Fees_date']) && isset($_POST['Class_id']) && isset($_POST['Student_GRNO']) 
	&& isset($_POST['Total_Amount'])&& isset($_POST['Paid_Amount']) && isset($_POST['Notification_Date'])) 
		  {
 
    
    $Fees_date = $_POST['Fees_date'];

	$Total_Amount = $_POST['Total_Amount'];
    $Class_id = $_POST['Class_id'];

    $Student_GRNO = $_POST['Student_GRNO'];
    $Paid_Amount = $_POST['Paid_Amount'];
	
	$Notification_Date = $_POST['Notification_Date'];

	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO fees_master(Fees_date, Total_Amount, Class_id, Student_GRNO, Paid_Amount, Notification_Date) 
							VALUES('$Fees_date', '$Total_Amount', '$Class_id', '$Student_GRNO', '$Paid_Amount', '$Notification_Date')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Class successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
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