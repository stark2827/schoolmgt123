<?php
 
/*
 * Following code will get single class details
 * A class is identified by class_id
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
    $result = mysql_query("SELECT * FROM class_master ");
 
    if (!empty($result)) {
       	$response["class_detail"] = array();
		$class_detail = array();
		$response["success"] = "1";
		$response["message"] = " fetche successfully.";
		
       While($row = mysql_fetch_assoc($result)) 
	   {
			  
            $class_detail["Class_id"] = $row["Class_id"];
            $class_detail["Class_name"] = $row["Class_name"];
            $class_detail["Class_division"] = $row["Class_division"];
			array_push($response["class_detail"], $class_detail);
	   }
	   echo json_encode($response);
        
    }
	else 
	{
        // no product found
        $response["success"] = "0";
        $response["message"] = "Not found";
 
        // echo no users JSON
        echo json_encode($response);
    }

 
?>