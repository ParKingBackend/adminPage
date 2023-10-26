<?php
require('db.php');

echo "<style>";
echo 'a { text-decoration: none; color:#333; }';
echo "</style>";

$apiUrl = $apiBaseUrl;
$addpoint = $apiBaseUrl . '/api/parking/create'; // Define the API endpoint for creating parking entries

if (isset($_POST['create'])) {
    $parkingData = [
        'address' => $_POST['address'],
        'isPremium' => $_POST['isPremium'] == "true" ? true : false,
        'partnerId' => (int)$_POST['partnerId'],
        'maxSpotsCount' => (int)$_POST['maxSpotsCount'],
        'price' => $_POST['price'],
        'spotsTaken' => (int)$_POST['spotsTaken'],
        'isDisabled' => $_POST['isDisabled'] == "true" ? true : false,
        'endTime' => (int)$_POST['endTime'],
        'startTime' => (int)$_POST['startTime']
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
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parkingData));

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
            header("Location: parking.php");
        }
    }

    // Close cURL resource
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html>

<head>
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
    </div>
</body>

</html>
