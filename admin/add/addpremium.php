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

    $delpoint = $apiBaseUrl . '/api/subscription/delete/';
    $apiUrl = $apiBaseUrl . '/api/client/get/all';

    // Fetch client data from the API
    $response = file_get_contents($apiUrl);

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

    // Check if the form is submitted
    if (isset($_POST['create'])) {
        $endDate = $_POST['endDate'];
        $discountAmount = $_POST['discountAmount'];
        $clientId = $_POST['clientId'];

        // Prepare the data to send to the API
        $postData = [
            'endDate' => $endDate,
            'discountAmount' => $discountAmount,
        ];

        // Create a cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiBaseUrl . '/api/subscription/create/' . $clientId);
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
            echo 'Failed to create the entry.';
        } else {
            // Check if the API response contains an error message
            $responseData = json_decode($response, true);
            if (isset($responseData['error'])) {
                echo 'Failed to create the entry: ' . $responseData['error'];
            } else {
                echo 'Data created successfully.';
                // Redirect to another page if needed
                header("Location: ../premiumsubs.php");
            }
        }

        // Close cURL resource
        curl_close($ch);
    }
    ?>

    
        <div class="container">
            <h1>Add premium</h1>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="label-column">
                        <label for="endDate">End Date</label>
                        <label for="discountAmount">Discount amount</label>
                        <label for="clientId">Client ID</label>
                    </div>
                    <div class="input-column">
                        <input type="text" name="endDate" value="endDate">
                        <input type="text" name="discountAmount" value="discountAmount">
                        <select class = "select" name="clientId">
                            <?php
                            // Generate options for the dropdown based on $clientIds
                            foreach ($clientIds as $clientId) {
                                echo '<option value="' . $clientId . '">' . $clientId . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" name="create" value="Create Entry">
            </form>
        </div>
    </body>


</html>