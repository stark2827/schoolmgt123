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
 
 $result = mysql_query("SELECT * FROM staff_master");
	
    if (!empty($result)) {
		$response["staff"] = array();
		$stff_item = array();
		$response["success"] = "1";
		$response["message"] = "Staff members fetched successfully.";
		
		While($row = mysql_fetch_assoc($result)){
			    $stff_item["Staff_Email_id"] = $row["Staff_Email_id"];
				$stff_item["Staff_name"] = $row['Staff_name'];
				$stff_item["Staff_ProfilePic"] = $row['Staff_ProfilePic'];
				$stff_item['Staff_Qualifications'] = $row['Staff_Qualification'];
				$stff_item['Staff_Type'] = $row['Staff_Type'];			
				$stff_item['Staff_Gender'] = $row['Staff_Gender'];
				$stff_item['Staff_phoneNo']= $row['Staff_phoneNo'];
				$stff_item['Staff_JoinDate'] = $row['Staff_JoinDate'];
				$stff_item['Staff_Experince']= $row['Staff_Experince'];
				array_push($response["staff"], $stff_item);
		}
        
		echo json_encode($response);
        
    } else {
        // no product found
        $response["success"] = "0";
        $response["message"] = "No staff member found";
 
        // echo no users JSON
        echo json_encode($response);
    }
?>