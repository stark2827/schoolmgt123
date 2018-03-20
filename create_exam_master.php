<?php
 
/*
 * Following code will create a new school master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Exam_Date']) && isset($_POST['Exam_name'])
		  && isset($_POST['Class_id']) && isset($_POST['Subject_id'])&& isset($_POST['Chapters']) && isset($_POST['Total_marks']) && isset($_POST['Start_time']) && isset($_POST['End_time'])
		  && isset($_POST['End_time'])) 
		  {
 
    $Exam_Date = $_POST['Exam_Date'];
	$Exam_name = $_POST['Exam_name'];
    $Total_marks = $_POST['Total_marks'];	
	$Start_time = $_POST['Start_time'];
    $End_time = $_POST['End_time'];
	$Class_id = $_POST['Class_id'];	
	$Subject_id = $_POST['Subject_id'];
    $Chapters = $_POST['Chapters'];
	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO exam_master(Exam_Date, Exam_name, Class_id, Subject_id, Chapters , Total_marks, Start_time, End_time) 
							VALUES('$Exam_Date', '$Exam_name','$Class_id', '$Subject_id', '$Chapters', '$Total_marks', '$Start_time', '$End_time')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = "1";
        $response["message"] = "successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = "0";
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
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