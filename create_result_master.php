<?php
 
/*
 * Following code will create a new school master 
 * All class details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();

 if(isset($_POST['Exam_name']) && isset($_POST['Exam_Date']) &&isset($_POST['Subject_id']))
 {
	 $Exam_Name=$_POST['Exam_name'];
	 $Exam_Date=$_POST['Exam_Date'];
	 $Subject_id = $_POST['Subject_id'];
	 $result1 = mysql_query("SELECT Exam_id FROM result_master WHERE Exam_name= '$Exam_Name' AND Exam_Date='$Exam_Date' AND Subject_id =  '$Student_GRNO'") or die(mysql_error());
	 
	if (!empty($result1)) {
       	$response["Exam_detail"] = array();
		$Exam_detail = array();
		$response["success"] = "1";
		$response["message"] = " fetche successfully.";
		
       While($row = mysql_fetch_assoc($result)) 
	   {
			  
            $Exam_detail["Exam_id"] = $row["Exam_id"];
            array_push($response["Exam_detail"], $Exam_detail);
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
 }
 
// check for required fields
if (isset($_POST['Exam_id']) && isset($_POST['Result_Date']) && isset($_POST['Class_id']) 
		  && isset($_POST['Student_GRNO']) && isset($_POST['Obtained_marks'])
		  && isset($_POST['Passing_marks']) && isset($_POST['Grade'])) 
		  {
 
    
	$Result_Date = $_POST['Result_Date'];
    $Class_id = $_POST['Class_id'];
    $Student_GRNO = $_POST['Student_GRNO'];	
	$Obtained_marks = $_POST['Obtained_marks'];
	$Passing_marks = $_POST['Passing_marks'];
	$Grade = $_POST['Grade'];
	
	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
 
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO result_master(Exam_id, Result_Date, Class_id, Student_GRNO, Obtained_marks, Passing_marks, Grade) 
							VALUES('$Exam_id', '$Result_Date', '$Class_id', '$Student_GRNO', '$Obtained_marks', '$Passing_marks', '$Grade')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = "1";
        $response["message"] = "Result successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = "0";
        $response["message"] = "Oops! An error occurred.";
 
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