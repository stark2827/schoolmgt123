<?php
 
/*
 * Following code will getschool details
 * 
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 

    $result = mysql_query("SELECT * FROM School_master");
 
    if (!empty($result)) {
		$response["school"] = array();
		$School = array();
		$response["success"] = "1";
		$response["message"] = "School detail fetched successfully.";
		
		While($row = mysql_fetch_assoc($result)){
			$School["School_name"] = $row["School_name"];
            $School["School_Address"] = $row["School_Address"];
			$School["School_Image"] = $row["School_Image"];
            $School["School_phonNo"] = $row["School_phonNo"];
            $School["School_Class_Image"] = $row["School_Class_Image"];
			$School["School_Library_Image"] = $row["School_Library_Image"];
			$School["School_Lab_Image"] = $row["School_Lab_Image"];
			array_push($response["school"], $School);
		}
			echo json_encode($response);
           
    } 
	else {
        // no product found
        $response["success"] = "0";
        $response["message"] = "Not found";
 
        // echo no users JSON
        echo json_encode($response);
    }

?>