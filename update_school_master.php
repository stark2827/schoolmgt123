<?php
 

// Following code will update a information
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['School_name']) && isset($_POST['School_Address']) && 
isset($_POST['School_phonNo'])) {
 
    
    $School_name = $_POST['School_name'];
	$School_Address = $_POST['School_Address'];
  //  $School_Image  = $_POST['School_Image'];
    $School_phonNo = $_POST['School_phonNo'];
//    $School_Class_Image = $_POST['School_Class_Image'];	
	//$School_Library_Image  = $_POST['School_Library_Image'];
    //$School_Lab_Image   = $_POST['School_Lab_Image'];
   
   // include db connect school_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched exam_id
    
   
	$result = mysql_query("UPDATE school_master SET School_name = '$School_name', School_Address = '$School_Address',
	School_phonNo = '$School_phonNo' WHERE School_id = '1'");

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