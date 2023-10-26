<<<<<<< HEAD
<<<<<<< HEAD
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
    <?php
    require('../db.php');

    echo "<style>";
    echo 'a { text-decoration: none; color:#333; }';
    echo "</style>";

    // Define the API endpoint and base URL for reservations
    
    $apiUrl = $apiBaseUrl . '/api/reservations/create/';
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

    $resp = file_get_contents($apigetparking);

    if ($resp === false) {
        die('Failed to fetch parking data from the API.');
    }

    $da = json_decode($resp, true);

    if ($da === null) {
        die('Failed to parse JSON response: ' . json_last_error_msg());
    } else {
        // Extract the 'id' values from the API response and store them in an array
        $parkingIds = array_column($da, 'id');
    }

    // Check if the form is submitted
    if (isset($_POST['create'])) {
        $clientId = $_POST['clientId'];
        $parkingId = $_POST['parkingId'];
        $endTime = $_POST['endTime'];

        // Prepare the data to send to the API
        $postData = [
            'clientId' => $clientId,
            'endTime' => $endTime,
        ];

        // Create a cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl . $parkingId);
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
                header("Location: ../reservations.php"); // Adjust the redirect URL
            }
        }

        // Close cURL resource
        curl_close($ch);
    }
    ?>

    <div class="container">
        <h1>Add reservation</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
                    <label for="endTime">End Time</label>
                    <label for="parkingId">Parking ID</label>
                    <label for="clientId">Client ID</label>
                </div>
                <div class="input-column">
                    <div class="data-entry">
                        <input type="text" name="endTime" value="">
                    </div>
                    <div class="data-entry">
                        <select name="parkingId">
                            <?php
                            // Generate options for the dropdown based on $parkingIds
                            foreach ($parkingIds as $parkingId) {
                                echo '<option value="' . $parkingId . '">' . $parkingId . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="data-entry">
                        <select name="clientId">
                            <?php
                            // Generate options for the dropdown based on $clientIds
                            foreach ($clientIds as $clientId) {
                                echo '<option value="' . $clientId . '">' . $clientId . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" name="create" value="Add reservation">
        </form>
    </div>

</body>


</html>
=======
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
<?php
require('../db.php');

echo "<style>";
echo 'a { text-decoration: none; color:#333; }';
echo "</style>";

// Define the API endpoint and base URL for reservations

$apiUrl = $apiBaseUrl . '/api/reservations/create/';
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

$resp = file_get_contents($apigetparking);

if ($resp === false) {
    die('Failed to fetch parking data from the API.');
}

$da = json_decode($resp, true);

if ($da === null) {
    die('Failed to parse JSON response: ' . json_last_error_msg());
} else {
    // Extract the 'id' values from the API response and store them in an array
    $parkingIds = array_column($da, 'id');
}

// Check if the form is submitted
if (isset($_POST['create'])) {
    $clientId = $_POST['clientId'];
    $parkingId = $_POST['parkingId'];
    $endTime = $_POST['endTime'];

    // Prepare the data to send to the API
    $postData = [
        'clientId' => $clientId,
        'endTime' => $endTime,
    ];

    // Create a cURL resource
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiUrl . $parkingId);
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
            header("Location: ../reservations.php"); // Adjust the redirect URL
        }
    }

    // Close cURL resource
    curl_close($ch);
}
?>

<form method="POST" action="">
    <div class="data-entry">
        <label for="endTime">End Time</label>
        <input type="text" name="endTime" value="">
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

    <input type="submit" name="create" value="Create Entry">
</form>
<<<<<<< HEAD
>>>>>>> 28d2c43... done without edit/add design
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
