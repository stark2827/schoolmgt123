<?php
// array for JSON response
$response = array();
if (isset($_POST['Class_name']) && isset($_POST['Class_division'])) {
    $response["message"] = "Required field(s) is missing";
    // echoing JSON response
    echo json_encode($response);
}
?>