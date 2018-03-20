update_result_master.php.php
<?php
 
/*
 * Following code will update a information 
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Result_id']) && isset($_POST['Exam_id']) && isset($_POST['Result_Date']) && isset($_POST['Class_id']) 
		  && isset($_POST['Student_GRNO']) && isset($_POST['Obtained_marks']) && isset($_POST['Grade'])) {
 
    $Result_id = $_POST['Result_id'];
	$Exam_id = $_POST['Exam_id'];

	$Result_Date = $_POST['Result_Date'];
    $Class_id = $_POST['Class_id'];

    $Student_GRNO = $_POST['Student_GRNO'];
    $Obtained_marks = $_POST['Obtained_marks'];
	
	$Grade = $_POST['Grade'];
	
    // include db connect result_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched Result_id
    
    $result = mysql_query("UPDATE result_master SET Exam_id = '$Exam_id', Result_Date = '$Result_Date', Student_GRNO = '$Student_GRNO', Class_id = '$Class_id',
Obtained_marks = '$Obtained_marks', Grade = '$Grade' WHERE Result_id= $Result_id");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>