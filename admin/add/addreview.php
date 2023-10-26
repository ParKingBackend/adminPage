<?php
require('../db.php');

echo "<style>";
echo 'a { text-decoration; none; color:#333; }';
echo "</style>";

// Define the API endpoint and base URL for reviews

$apiUrl = $apiBaseUrl . '/api/reviews/create/';
$apigetclient = $apiBaseUrl . '/api/client/get/all';
$apigetparking = $apiBaseUrl . '/api/parking/get/all';

$response = file_get_contents($apigetclient);

if ($response === false) {
    die('Failed to fetch client data from the API.');
}

$data = json_decode($response, true);

if ($data === null) {
    die('Failed to parse JSON response: ' . json_last_error_msg());
} else {
    // Extract the 'id' values from the API response and store them in an array
    $clientIds = array_column($data, 'id');
}


$response = file_get_contents($apigetparking);

if ($response === false) {
    die('Failed to fetch parking data from the API.');
}

$data = json_decode($response, true);

if ($data === null) {
    die('Failed to parse JSON response: ' . json_last_error_msg());
} else {
    // Extract the 'id' values from the API response and store them in an array
    $parkingIds = array_column($data, 'id');
}

// Check if the form is submitted
if (isset($_POST['create'])) {
    $parkingId = $_POST['parkingId'];

    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $title = $_POST['title'];
    $clientId = $_POST['clientId'];

    // Prepare the data to send to the API
    $postData = [
        'rating' => $rating,
        'description' => $description,
        'title' => $title,
        'clientId' => $clientId,
    ];

    // Create a cURL resource
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiBaseUrl . '/api/review/create/' . $parkingId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    // Execute cURL and get the response
    $resp = curl_exec($ch);

    // Check for errors
    if ($resp === false) {
        echo 'Failed to create the entry.';
    } else {
        // Check if the API response contains an error message
        $responseData = json_decode($resp, true);
        if (isset($responseData['error'])) {
            echo 'Failed to create the entry: ' . $responseData['error'];
        } else {
            echo 'Data created successfully.';
            // Redirect to another page if needed
            header("Location: ../reviews.php"); // Adjust the redirect URL
        }
    }

    // Close cURL resource
    curl_close($ch);
}
?>

<form method="POST" action="">
    <div class="data-entry">
        <label for="title">Title</label>
        <input type="text" name="title" value="">
    </div>
    <div class="data-entry">
        <label for="description">Description</label>
        <input type="text" name="description" value="">
    </div>
    <div class="data-entry">
        <label for="rating">Rating</label>
        <input type="text" name="rating" value="">
    </div>
    <div class="data-entry">
        <label for="clientId">Client ID</label>
        <select name="clientId">
            <?php
            // Generate options for the dropdown based on $clientIds
            foreach ($clientIds as $clientId) {
                echo '<option value="' . $clientId . '">' . $clientId . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="data-entry">
        <label for="parkingId">Parking ID</label>
        <select name="parkingId">
            <?php
            // Generate options for the dropdown based on $parkingIds
            foreach ($parkingIds as $parkingId) {
                echo '<option value="' . $parkingId . '">' . $parkingId . '</option>';
            }
            ?>
        </select>
    </div>

    <input type="submit" name="create" value="Create Entry">
</form>
