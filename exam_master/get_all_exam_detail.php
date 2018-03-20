get_all_examDetail.php
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
$result = mysql_query("SELECT * FROM exam_master") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // classes node
    $response["exam"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp exam array
        $exam = array();
        $exam["Class_id"] = $row["Class_id"];
        $exam["Exam_Date"] = $row["Exam_Date"];
        $exam["Exam_name"] = $row["Exam_name"];
		$exam["Subject_id"] = $row["Subject_id"];
        $exam["Total_marks"] = $row["Total_marks"];
        $exam["Start_time"] = $row["Start_time"];
		$exam["End_time"] = $row["End_time"];
		$exam["Exam_id"] = $row["Exam_id"];
		 
    
        // push single exam into final response array
        array_push($response["exam"], $exam);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No classes found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>