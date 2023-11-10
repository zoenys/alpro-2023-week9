<?php

function csvToJson($csvUrl) {
    $csvData = [];

    // Replace 'github.com' with 'raw.githubusercontent.com' in the URL
    $csvUrl = str_replace('github.com', 'raw.githubusercontent.com', $csvUrl);

    if (($handle = fopen($csvUrl, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    } else {
        // Print an error message
        echo "Error opening CSV file: " . error_get_last()['message'];
        return null;
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = array();

    foreach ($csvData as $row) {
        $jsonArrayItem = array();
        for ($i = 0; $i < count($headers); $i++) {
            $jsonArrayItem[$headers[$i]] = $row[$i];
        }
        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

$csvUrl = 'http://zoenyokhanansianiparalproweek4.alwaysdata.net/M9/datapribadi.csv';
$jsonData = csvToJson($csvUrl);

// Set the content type to JSON
header('Content-Type: application/json');

if ($jsonData !== null) {
    // Output the JSON data
    echo $jsonData;
}

?>
