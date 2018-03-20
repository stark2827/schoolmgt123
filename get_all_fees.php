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
	 
 
 $result = mysql_query("SELECT Fees_Paid_date, Fees_Type, f.Student_GRNO, 
	Total_Amount, Paid_Amount, s.Student_name FROM fees_master f 
	JOIN student_master s ON s.Student_GRNO= f.Student_GRNO WHERE f.Class_id = '$Class_id'");
	 
    if (!empty($result)) {
		$response["student"] = array();
		$student_item = array();
		$response["success"] = "1";
		$response["message"] = "student's fees detail  fetched successfully.";
		
		While($row = mysql_fetch_assoc($result)){
			    $student_item["Fees_Paid_date"] = $row["Fees_Paid_date"];
				//$student_item["Class_id"] = $row["Class_id"];
				$student_item["Fees_Type"] = $row['Fees_Type'];
				$student_item["Student_GRNO"] = $row['Student_GRNO'];
				$student_item["Student_name"] = $row['Student_name'];
				$student_item["Total_Amount"] = $row['Total_Amount'];
				$student_item["Paid_Amount"] = $row['Paid_Amount'];	
					
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
} else
	{
		$response["success"] = "0";
        $response["message"] = "Required fields  is missing";
		
		echo json_encode($response);
	}
?>