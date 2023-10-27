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


    $apiUrl = $apiBaseUrl . '/api/partners/get/all';
$createUrl = $apiBaseUrl . '/api/partners/create';



    // Check if the form is submitted
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $bankAmount = $_POST['bankAmount'];

        // Prepare the data to send to the API
        $postData = [
            'name' => $name,
            'bankAmount' => $bankAmount,
        ];

        // Create a cURL resource
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $createUrl);
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
                header("Location: ../partner.php");
            }
        }

        // Close cURL resource
        curl_close($ch);
    }
    ?>

    
        <div class="container">
            <h1>Add partner</h1>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="label-column">
                        <label for="name">Name</label>
                        <label for="bankAmount">Bank Account</label>
                    </div>
                    <div class="input-column">
                        <input type="text" name="name" value="name">
                        <input type="text" name="bankAmount" value="bankAmount">
                    </div>
                </div>
                <input type="submit" name="create" value="Create Entry">
            </form>
        </div>
    </body>


</html>