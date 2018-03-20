<?php

/*
 * Following code will get single syllabus details
 * 
 */
 
// array for JSON response
$response = array();
 
// include db connect Syllabus
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_POST["Class_id"])) {
    $Class_id = $_POST['Class_id'];
 
    // get a Syllabus from Syllabus table
    $result = mysql_query("SELECT * FROM syllabus_master s WHERE s.Class_id = '$Class_id'");
 if (!empty($result)) {
		$response["syllabus"] = array();
		$syllabus_item = array();
		$response["success"] = "1";
		$response["message"] = "syllabus fetched successfully.";
		
		While($row = mysql_fetch_assoc($result)){
			    $syllabus_item["Class_id"] = $row["Class_id"];
				$syllabus_item["Subject_id"] = $row['Subject_id'];
				$syllabus_item["Chapters"] = $row['Chapters'];
				array_push($response["syllabus"], $syllabus_item);
		}
        
		echo json_encode($response);
        
    } else {
        // no product found
        $response["success"] = "0";
        $response["message"] = "No syllabus  found";
 
        // echo no users JSON
        echo json_encode($response);
    }
}
?>