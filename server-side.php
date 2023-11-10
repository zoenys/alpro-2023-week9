<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json"); 

// Get form data from the server request
$id = $_POST["id"];
$F_Name = $_POST["F_Name"];
$L_Name = $_POST["L_Name"];
$email = $_POST["email"];
$email2 = $_POST["email2"];
$profesi = $_POST["profesi"];

// Create a CSV string
$new_data = "$id,$F_Name,$L_Name,$email,$email2,$profesi";

// Specify the path to the CSV file on the server
$csv_path = 'datapribadi.csv';

// Append the new data to the CSV file
$result = file_put_contents($csv_path, $new_data . "\n", FILE_APPEND | LOCK_EX);

// Check for errors
if ($result === false) {
    $response = array("status" => "error", "message" => "Error writing data to the CSV file.");
} else {
    $response = array("status" => "success", "message" => "Data successfully written to the CSV file.");
    
    // Redirect to the specified URL
    header("Location: http://zoenyokhanansianiparalproweek4.alwaysdata.net/M9/");
    exit(); // Ensure that the script stops executing after the redirection header
}

// Respond with a JSON-encoded message
echo json_encode($response);
?>
