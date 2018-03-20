Result_Master.php

<?php
 
/*
 * Following code will create a new school master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Exam_id']) && isset($_POST['Result_Date']) && isset($_POST['Class_id']) 
		  && isset($_POST['Student_GRNO']) && isset($_POST['Obtained_marks']) && isset($_POST['Grade'])) 
		  {
 
    
    $Exam_id = $_POST['Exam_id'];

	$Result_Date = $_POST['Result_Date'];
    $Class_id = $_POST['Class_id'];

    $Student_GRNO = $_POST['Student_GRNO'];
    $Obtained_marks = $_POST['Obtained_marks'];
	
	$Grade = $_POST['Grade'];

	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO result_master(Exam_id, Result_Date, Class_id, Student_GRNO, Obtained_marks, Grade) 
							VALUES('$Exam_id', '$Result_Date', '$Class_id', '$Student_GRNO', '$Obtained_marks', '$Grade')");
 
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