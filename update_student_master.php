<?php
 // Following code will update a information
 
// array for JSON response
$response = array();
 
// check for required fields
if(isset($_POST['Student_GRNO']) && isset($_POST['Student_name']) && isset($_POST['Student_RollNo'])  
	&& isset($_POST['Class_id']) 
	&& isset($_POST['Student_Joined_Class']) && isset($_POST['Student_Mother_name']) && isset($_POST['Student_Father_name']) 
	&& isset($_POST['Student_DOB'])&& isset($_POST['Student_Gender'])) 
		   {
 
    $Student_GRNO = $_POST['Student_GRNO'];
	$Student_name = $_POST['Student_name'];
	$Student_RollNo = $_POST['Student_RollNo'];
    $Student_ProfilePic = $_POST['Student_ProfilePic'];
	$Student_Address = $_POST['Student_Address']; 
	$Student_AdmissionDate = $_POST['Student_AdmissionDate'];
    $Class_id = $_POST['Class_id'];
	$Student_Joined_Class = $_POST['Student_Joined_Class'];
	$Student_Father_name = $_POST['Student_Father_name'];
	$Student_Mother_name = $_POST['Student_Mother_name'];
    $Student_DOB = $_POST['Student_DOB'];
	$Student_Gender = $_POST['Student_Gender'];
    $Father_phoneNo = $_POST['Father_phoneNo'];
	$Mother_phoneNo = $_POST['Mother_phoneNo'];
   
   // include db connect student_master
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched student_GRNO
    
   
	$result = mysql_query("UPDATE student_master SET Student_name = '".$Student_name."',
	Student_RollNo = '".$Student_RollNo."', Student_ProfilePic = '".$Student_ProfilePic."', Student_Address= '".$Student_AdmissionDate."', 
	Class_id = '".$Class_id."', Student_Father_name = '".$Student_Father_name."', Student_Mother_name = '".$Student_Mother_name."',
	Student_DOB = '".$Student_DOB."', Student_Gender = '".$Student_Gender."', Father_phoneNo = '".$Father_phoneNo."', 
	Mother_phoneNo = '".$Mother_phoneNo."', Student_Joined_Class = '".$Student_Joined_Class."' WHERE Student_GRNO = '".$Student_GRNO."'");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = "1";
        $response["message"] = "successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    }
	else{
		$response["success"] = "0";
        $response["message"] = "somthing happen!";
		      // echoing JSON response
        echo json_encode($response);
 
	}
} else {
    // required field is missing
    $response["success"] = "0";
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>