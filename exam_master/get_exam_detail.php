get_exam_details.php
<?php
 
/*
 * Following code will get exam details
  */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Class_id"]) && isset($_GET['Exam_Date']) && isset($_GET['Exam_name'])) {
    
	$Class_id = $_GET['Class_id'];
	$Exam_Date = $_GET['Exam_Date'];
	$Exam_name = $_GET['Exam_name'];
    
 
    // get a details from various table
    $result = mysql_query("SELECT * FROM exam_master WHERE Class_id = $Class_id AND Exam_Date = $Exam_Date AND Exam_name = $Exam_name");
	
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $exam = array();
            $exam["Class_id"] = $result["Class_id"];
            $exam["Exam_Date"] = $result["Exam_Date"];
            $exam["Exam_name"] = $result["Exam_name"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["exam"] = array();
 
            array_push($response["exam"], $exam);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No Class found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No Class found";
 
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