update_student_master.php
<?php
 

// Following code will update a information
 
// array for JSON response
$response = array();
 
// check for required fields
if(isset($_POST['Student_GRNO']) && isset($_POST['Student_password']) && isset($_POST['Student_name']) && isset($_POST['Student_ProfilePic']) && isset($_POST['Student_AdmissionDate']) 
	&& isset($_POST['Class_id']) && isset($_POST['Student_Mother_name']) && isset($_POST['Student_Father_name']) && isset($_POST['Student_DOB']) && isset($_POST['Student_Gender']) && isset($_POST['Student_Parent_phone'] && isset($_POST['Student_Alternative_phone'])) 
		   {
 
    $Student_GRNO = $_POST['Student_GRNO'];
	$Student_password = $_POST['Student_password'];
	
	$Student_name = $_POST['Student_name'];
    $Student_ProfilePic = $_POST['Student_ProfilePic'];
	

	$Student_AdmissionDate = $_POST['Student_AdmissionDate'];
    $Class_id = $_POST['Class_id'];

	
    $Student_Father_name = $_POST['Student_Father_name'];
	$Student_Mother_name = $_POST['Student_Mother_name'];
    $Student_DOB = $_POST['Student_DOB'];
	
	$Student_Gender = $_POST['Student_Gender'];
    $Student_Parent_phone = $_POST['Student_Parent_phone'];
	
	$Student_Alternative_phone = $_POST['Student_Alternative_phone'];
   
   // include db connect student_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched student_GRNO
    
   
	$result = mysql_query("UPDATE student_master SET Student_GRNO = '$Student_GRNO', Student_password = '$Student_password', Student_name = '$Student_name', 
	Student_ProfilePic = '$Student_ProfilePic', Student_AdmissionDate = '$Student_AdmissionDate', Class_id = '$Class_id', Student_Father_name = '$Student_Father_name', 
	Student_Mother_name = '$Student_Mother_name', Student_DOB = '$Student_DOB',	Student_Gender = '$Student_Gender', Student_Parent_phone = '$Student_Parent_phone', 
	Student_Alternative_phone = '$Student_Alternative_phone' WHERE Student_GRNO = $Student_GRNO");

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