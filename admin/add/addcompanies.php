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
    $apiUrl = $apiBaseUrl . '/api/reservations/create';
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
        $clientId = $_POST['clientId'];
        $parkingId = $_POST['parkingId'];
        $endTime = $_POST['endTime'];

        // Prepare the data to send to the API
        $postData = [
            'clientId' => $clientId,
            'parkingId' => $parkingId,
            'endTime' => $endTime,
        ];

        // Create a cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
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
            echo 'Failed to create the entry. Error: ' . curl_error($ch);
        } else {
            // Check if the API response contains an error message
            $responseData = json_decode($response, true);
            if (isset($responseData['error'])) {
                echo 'Failed to create the entry: ' . $responseData['error'];
            } else {
                echo 'Data created successfully.';
                // Redirect to another page if needed
                header("Location: ../reservations.php");
            }
        }

        // Close cURL resource
        curl_close($ch);
    }
    ?>

    <div class="container">
        <h1>Add Company</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
                    <label for="endTime">End Time</label>
                    <label for="parkingId">Parking ID</label>
                    <label for="clientId">Client ID</label>
                </div>
                <div class="input-column">
                    <div class="data-entry">
                        <input type="text" name="endTime" placeholder="Enter End Time">
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
            <input type="submit" name="create" value="Create Entry">
        </form>
    </div>

</body>

</html>