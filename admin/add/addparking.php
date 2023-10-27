<?php
require('../db.php');
?>
<?php


$apiUrl = $apiBaseUrl;
$addpoint = $apiUrl . '/api/parking/create-with-partner'; // Define the API endpoint for creating parking entries
$apiUrl = $apiBaseUrl;
$parpoint = $apiUrl. '/api/partners/get/all';

$response = file_get_contents($parpoint);

    if ($response === false) {
        die('Failed to fetch client data from the API.');
    }

    $data = json_decode($response, true);

    if ($data === null) {
        die('Failed to parse JSON response: ' . json_last_error_msg());
    } else {
        // Extract the 'id' values from the API response and store them in an array
        $partnerIds = array_column($data, 'id');
    }
if (isset($_POST['create'])) {
    $address = $_POST['address'];
    $price = $_POST['price'];
    $isPremium = $_POST['isPremium'] == "true" ? true : false;
    $partnerId = $_POST['partnerId'];
    $maxSpotsCount = $_POST['maxSpotsCount'];
    $spotsTaken = $_POST['spotsTaken'];
    $isDisabled = $_POST['isDisabled'] == "true" ? true : false;
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    // Prepare the data to send to the API
    $postData = [
        'address' => $address,
        'price' => $price,
        'isPremium' => $isPremium,
        'maxSpotsCount' => $maxSpotsCount,
        'spotsTaken' => $spotsTaken,
        'isDisabled' => $isDisabled,
        'startTime' => $startTime,
        'partnerId' => $partnerId,
        'endTime' => $endTime
    ];

    // Create a cURL resource
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $addpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo 'Failed to create the parking entry.';
    } else {
        // Check if the API response contains an error message
        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            echo 'Failed to create the parking entry: ' . $responseData['error'];
        } else {
            echo 'Parking entry created successfully.';
            // Redirect to another page if needed
            header("Location: ../parking.php");
        }
    }

    // Close cURL resource
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/edit.css">
    <style>
        a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
<div class="container">
        <h1>Add Parking</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
        <label for="address">Address</label>
        <label for="price">Price</label>
        <label for="isPremium">Is Premium</label>
        <label for="partnerId">Partner ID</label>
        <label for="maxSpotsCount">Max Spots Count</label>
        <label for="spotsTaken">Spots Taken</label>
        <label for="isDisabled">Is Disabled</label>
        <label for="endTime">End time</label>
        <label for="startTime">Start time</label>
        </div>
                <div class="input-column">
        <input type="text" name="address" value="">

        <input type="text" name="price" value="">

        <select name="isPremium">
            <option value="true" >True</option>
            <option value="false" >False</option>
        </select>

   
        <input type="text" name="partnerId" value="">


        <input type="text" name="maxSpotsCount" value="">

        <input type="text" name="spotsTaken" value="">

        <select name="isDisabled">
            <option value="true" >True</option>
            <option value="false" >False</option>
        </select>

        <input type="text" name="endTime" value="">

        <input type="text" name="startTime" value="">
        </div>
            </div>

    <input type="submit" name="add" value="Add Entry">
</form>
</div>
    </body>


</html>
</form>
