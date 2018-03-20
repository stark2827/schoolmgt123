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
 
// get all classes from exam_master table
//$result = mysql_query("SELECT * FROM exam_master") or die(mysql_error());
 if (isset($_POST["Exam_Date"])) {
    
	$Exam_Date = $_POST['Exam_Date'];    
 
	 
 
    // get a details from various table
    $result = mysql_query("SELECT Exam_Date, Exam_name, c.Class_name, c.Class_division, su.Subject_name, Chapters, Start_time, End_time, Total_marks FROM exam_master e 
	JOIN class_master c ON e.Class_id = c.Class_id 
	JOIN subject_master su ON e.Subject_id = su.Subject_id   WHERE Exam_Date = '$Exam_Date'");

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // classes node
    $response["exam"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp exam array
        $exam = array();
        $exam["Exam_Date"] = $row["Exam_Date"];
        $exam["Exam_name"] = $row["Exam_name"];
        $exam["Total_marks"] = $row["Total_marks"];
        $exam["Start_time"] = $row["Start_time"];
		$exam["End_time"] = $row["End_time"];
		$exam["Class_name"] = $row["Class_name"];
		$exam["Class_division"] = $row["Class_division"];		
		$exam["Subject_name"] = $row['Subject_name'];
		$exam["Chapters"] = $row['Chapters'];
		 
    
        // push single exam into final response array
        array_push($response["exam"], $exam);
    }
    // success
    $response["success"] = "1";
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = "0";
    $response["message"] = "Not found";
 
    // echo no users JSON
    echo json_encode($response);
	}
 
 }else{
	$response["success"] = "0";
    $response["message"] = "Required field is missing";
   echo json_encode($response);
	}
?>