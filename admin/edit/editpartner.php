<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/edit.css">
</head>

<body>

    <?php
    require('../db.php');
    ?>

    <?php
    if (isset($_GET['id'])) {
        $entryId = $_GET['id'];

    } else {
        echo "Service broken, no ID";
    }
    $endpoint = '/api/partners/get/all';
    $apiUrl = $apiBaseUrl . $endpoint;
    $delpoint = $apiBaseUrl . '/api/partners/delete/' . $entryId . '';

    $editpoint = $apiBaseUrl . '/api/partners/get/' . $entryId . '';
    $updatepoint = $apiBaseUrl . '/api/partners/update/' . $entryId . '';

    $response = file_get_contents($editpoint);

    if ($response === false) {
        die('Failed to fetch data from the API.');
    }

    $data = json_decode($response, true);

    if ($data === null) {
        die('Failed to parse JSON response: ' . json_last_error_msg());
    }


    if (isset($_POST['update'])) {
        $updateData = [
            'name' => $_POST['name'],
            'bankAccount' => $_POST['bankAccount']
        ];

        // Send a PUT request to update the entry
        $options = [
            'http' => [
                'method' => 'PUT',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($updateData)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($updatepoint, false, $context);

        if ($result !== false) {
            echo 'Data updated successfully.';
            sleep(1);
            header('Location:../partner.php');
        } else {
            echo 'Failed to update data.';
        }
    }
    if (isset($_POST['delete'])) {
        // Send a DELETE request to delete the entry
        $options = [
            'http' => [
                'method' => 'DELETE',
                'header' => 'Content-Type: application/json', // Check if this header is required
            ],
        ];
        $context = stream_context_create($options);
        $result = @file_get_contents($delpoint, false, $context); // Use @ to suppress warnings
    
        if ($result !== false) {
            echo 'Data deleted successfully.';
            sleep(1);
            header('Location: ../partner.php');
        } else {
            echo 'Failed to delete data. Error: ' . error_get_last()['message']; // Display the error message
        }
    }
    ?>

    <body>
        <div class="container">
            <h1>Edit Partner</h1>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="label-column">
                        <label for="name">Name</label>
                        <label for="bankAccount">Bank Account</label>
                    </div>
                    <div class="input-column">
                        <input type="text" name="name" value="<?php echo $data['name']; ?>">
                        <input type="text" name="bankAccount" value="<?php echo $data['bankAccount']; ?>">
                    </div>
                </div>
                <input type="submit" name="delete" value="Delete entry">>

                <input type="submit" name="update" value="Update Entry">
            </form>
        </div>
    </body>

</body>

</html>