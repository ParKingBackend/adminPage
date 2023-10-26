<<<<<<< HEAD
=======
<?php
require('../db.php');

echo "<style>";
echo 'a { text-decoration; none; color:#333; }';
echo "</style>";

// Define the API endpoint and base URL for reviews

$apiUrl = $apiBaseUrl . '/api/report/create/';
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
    $description = $_POST['description'];
    $clientId = $_POST['clientId'];

    // Prepare the data to send to the API
    $postData = [
        'description' => $description,
        'clientId' => $clientId,
    ];

    // Create a cURL resource
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiBaseUrl . '/api/report/create/' . $parkingId);
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

<<<<<<< HEAD
>>>>>>> 65bf1d9... put edit and half of add
<!DOCTYPE html>
<html>

<head>
<<<<<<< HEAD
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
    echo 'a { text-decoration; none; color:#333; }';
    echo "</style>";

    // Define the API endpoint and base URL for reviews
    
    $apiUrl = $apiBaseUrl . '/api/report/create/';
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
        $description = $_POST['description'];
        $clientId = $_POST['clientId'];

        // Prepare the data to send to the API
        $postData = [
            'description' => $description,
            'clientId' => $clientId,
        ];

        // Create a cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiBaseUrl . '/api/report/create/' . $parkingId);
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

    <body>
        <div class="container">
            <h1>Add Report</h1>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="label-column">
                        <label for="description">Description</label>
                        <label for="clientId">Client ID</label>
                        <label for="parkingId">Parking ID</label>
                    </div>
                    <div class="input-column">
                        <input type="text" name="description" value="">
                        <select class="select" name="clientId">
                            <?php
                            // Generate options for the dropdown based on $clientIds
                            foreach ($clientIds as $clientId) {
                                echo '<option value="' . $clientId . '">' . $clientId . '</option>';
                            }
                            ?>
                        </select>
                        <select class="select" name="parkingId">
                            <?php
                            // Generate options for the dropdown based on $parkingIds
                            foreach ($parkingIds as $parkingId) {
                                echo '<option value="' . $parkingId . '">' . $parkingId . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" name="create" value="Add report">
            </form>
        </div>
    </body>

</body>


</html>
=======
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/pageLayout.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
</head>

<body>
    <?php include('topBar.php'); ?>
    <div class="grid-container">
        <div class="side-menu">
            <?php include('sideMenu.php'); ?>
        </div>
        <div class="content">
            <form method="POST" action="">
                <div class="data-entry">
                    <label for="address">Address</label>
                    <input type="text" name="address" placeholder="Enter address">
                </div>

                <div class="data-entry">
                    <label for="isPremium">Is Premium</label>
                    <select name="isPremium">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>

                <div class="data-entry">
                    <label for="partnerId">Partner ID</label>
                    <input type="text" name="partnerId" placeholder="Enter Partner ID">
                </div>

                <div class="data-entry">
                    <label for="maxSpotsCount">Max Spots Count</label>
                    <input type="text" name="maxSpotsCount" placeholder="Enter Max Spots Count">
                </div>

                <div class="data-entry">
                    <label for="price">Price</label>
                    <input type="text" name="price" placeholder="Enter Price">
                </div>

                <div class="data-entry">
                    <label for="spotsTaken">Spots Taken</label>
                    <input type="text" name="spotsTaken" placeholder="Enter Spots Taken">
                </div>

                <div class="data-entry">
                    <label for="isDisabled">Is Disabled</label>
                    <select name="isDisabled">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>

                <div class="data-entry">
                    <label for="endTime">End time</label>
                    <input type="text" name="endTime" placeholder="Enter End Time">
                </div>

                <div class="data-entry">
                    <label for="startTime">Start time</label>
                    <input type="text" name="startTime" placeholder="Enter Start Time">
                </div>

                <input type="submit" name="create" value="Create Parking Entry">
            </form>
        </div>
=======
<form method="POST" action="">

    <div class="data-entry">
        <label for="description">Description</label>
        <input type="text" name="description" value="">
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
>>>>>>> 28d2c43... done without edit/add design
    </div>

<<<<<<< HEAD
</html>
>>>>>>> 65bf1d9... put edit and half of add
=======
    <input type="submit" name="create" value="Create Entry">
</form>
>>>>>>> 28d2c43... done without edit/add design
