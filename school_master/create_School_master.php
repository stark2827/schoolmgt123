Scholl_master.php


<?php
 
/*
 * Following code will create a new school master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['School_name']) && isset($_POST['School_Address']) && isset($_POST['School_Image']) 
&& isset($_POST['School_phonNo']) && isset($_POST['School_Class_Image']) && isset($_POST['School_Library_Image']) && isset($_POST['School_Lab_Image'])) 
		  {
 
    
    $School_name = $_POST['School_name'];

	$School_Address = $_POST['School_Address'];
    $School_Image  = $_POST['School_Image'];

    $School_phonNo = $_POST['School_phonNo'];
    $School_Class_Image = $_POST['School_Class_Image'];
	
	$School_Library_Image  = $_POST['School_Library_Image'];
    $School_Lab_Image   = $_POST['School_Lab_Image'];
	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO scholl_master(School_name, School_Address, School_Image, School_phonNo, School_Class_Image, School_Library_Image , School_Lab_Image  ) 
							VALUES('$School_name', '$School_Address', '$School_Image ', '$School_phonNo', '$School_Class_Image', '$School_Library_Image ', '$School_Lab_Image')");
 
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