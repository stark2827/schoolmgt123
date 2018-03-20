update_timetable_master.php
<?php
 

// Following code will update a information
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Timetable_id']) && isset($_POST['Class_id']) && isset($_POST['Week_id']) && isset($_POST['Start_time']) 
&& isset($_POST['End_time']) && isset($_POST['Subject_id']) && isset($_POST['Staff_Email_id'])) 
{ 
    $Timetable_id  = $_POST['Timetable_id'];
    $Class_id = $_POST['Class_id'];

	$Week_id = $_POST['Week_id'];
    $Start_time = $_POST['Start_time'];

    $End_time = $_POST['End_time'];
    $Subject_id = $_POST['Subject_id'];
	
	$Staff_Email_id = $_POST['Staff_Email_id'];
    
   
   // include db connect school_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched exam_id
    
   
	$result = mysql_query("UPDATE timetable_master SET Class_id = '$Class_id', Week_id = '$Week_id', Start_time = '$Start_time',
End_time = '$End_time', Subject_id = '$Subject_id', Staff_Email_id = '$Staff_Email_id', WHERE Timetable_id = $Timetable_id");

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