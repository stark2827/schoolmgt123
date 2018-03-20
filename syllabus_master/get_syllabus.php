get_syllabus_details.php
<?php
 
/*
 * Following code will get single syllabus details
 * 
 */
 
// array for JSON response
$response = array();
 
// include db connect Syllabus
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Syllabus_id"])) {
    $Syllabus_id = $_GET['Syllabus_id'];
 
    // get a Syllabus from Syllabus table
    $result = mysql_query("SELECT * FROM syllabus_master WHERE Syllabus_id = Syllabus_id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {    
 
            $result = mysql_fetch_array($result);
 
            $Syllabus = array();
            $Syllabus["Syllabus_id"] = $result["Syllabus_id"];
            $Syllabus["Class_id"] = $result["Class_id"];
            $Syllabus["Subject_id"] = $result["Subject_id"];
			$Syllabus["Chapters"] = $result["Chapters"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["Syllabus"] = array();
 
            array_push($response["Syllabus"], $Syllabus);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // not found
            $response["success"] = 0;
            $response["message"] = "Not found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "Not found";
 
        // echo no users JSON
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