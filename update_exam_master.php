<?php
 
/*
 * Following code will update a information
 * exam identified by Exam_id
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Exam_Date']) && isset($_POST['Exam_name']) && isset($_POST['Class_id'])
	&& isset($_POST['Subject_id']) && isset($_POST['Chapters'])	
	&& isset($_POST['Total_marks']) && isset($_POST['Start_time']) && isset($_POST['End_time'])) {
 
    $Exam_id = $_POST['Exam_id'];
    $Exam_Date = $_POST['Exam_Date'];
	$Exam_name = $_POST['Exam_name'];
    $Total_marks = $_POST['Total_marks'];	
	$Start_time = $_POST['Start_time'];
    $End_time = $_POST['End_time'];
    $Class_id = $_POST['Class_id'];	
	$Subject_id = $_POST['Subject_id'];
    $Chapters = $_POST['Chapters'];
    
    // include db connect exam_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched exam_id
    
   
	$result = mysql_query("UPDATE exam_master SET Exam_Date = '$Exam_Date', Exam_name = '$Exam_name', Class_id = '$Class_id', Subject_id = '$Subject_id',
	Chapters ='$Chapters', Total_marks = '$Total_marks', Start_time = '$Start_time', End_time = '$End_time'	WHERE Exam_id = $Exam_id");

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