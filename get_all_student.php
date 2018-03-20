<?php
 /*
 * Following code will get perticuler staff details
 * A staff  is identified by staff_maill_id
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

if (isset($_POST['Class_id'])){
	 $Class_id = $_POST['Class_id'];

 $result = mysql_query("SELECT * FROM student_master WHERE Class_id= '$Class_id'");
	
    if (!empty($result)) {
		$response["student"] = array();
		$student_item = array();
		$response["success"] = "1";
		$response["message"] = "Student members fetched successfully.";
		
		While($row = mysql_fetch_assoc($result)){
			    $student_item["Student_GRNO"] = $row["Student_GRNO"];
				$student_item["Student_name"] = $row['Student_name'];
				$student_item["Student_RollNo"] = $row['Student_RollNo'];
				$student_item['Student_ProfilePic'] = $row['Student_ProfilePic'];
				$student_item['Student_Address'] = $row['Student_Address'];			
				$student_item['Student_AdmissionDate'] = $row['Student_AdmissionDate'];
				$student_item['Class_id']= $row['Class_id'];
				$student_item['Student_Joined_Class'] = $row['Student_Joined_Class'];
				$student_item['Student_Father_name']= $row['Student_Father_name'];
				$student_item['Student_Mother_name']= $row['Student_Mother_name'];
				$student_item['Student_DOB'] = $row['Student_DOB'];
				$student_item['Student_Gender']= $row['Student_Gender'];
				$student_item['Father_phoneNo'] = $row['Father_phoneNo'];
				$student_item['Mother_phoneNo']= $row['Mother_phoneNo'];
				
				
				array_push($response["student"], $student_item);
		}
        
		echo json_encode($response);
        
    } else {
        // no product found
        $response["success"] = "0";
        $response["message"] = "No student member found";
 
        // echo no users JSON
        echo json_encode($response);
    }
}else
	{
		$response["success"] = "0";
        $response["message"] = "Required fields  is missing";
		
		echo json_encode($response);
	}
?>