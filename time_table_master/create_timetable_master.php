Time_Table_Master.php

<?php
 
/*
 * Following code will create a new school master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Class_id']) && isset($_POST['Week_id']) && isset($_POST['Start_time']) 
&& isset($_POST['End_time']) && isset($_POST['Subject_id']) && isset($_POST['Staff_Email_id'])) 
		  {
 
    
    $Class_id = $_POST['Class_id'];

	$Week_id = $_POST['Week_id'];
    $Start_time = $_POST['Start_time'];

    $End_time = $_POST['End_time'];
    $Subject_id = $_POST['Subject_id'];
	
	$Staff_Email_id = $_POST['Staff_Email_id'];
    
	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO timetable_master(Class_id, Week_id, Start_time, End_time, Subject_id, Staff_Email_id) 
							VALUES('$Class_id', '$Week_id', '$Start_time', '$End_time', '$Subject_id', '$Staff_Email_id')");
 
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