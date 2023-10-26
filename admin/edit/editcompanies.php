<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="\adminPage\admin\css\edit.css">
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
    $endpoint = '/api/companies/get/all';
    $apiUrl = $apiBaseUrl . $endpoint;
    $delpoint = $apiBaseUrl . '/api/companies/delete/';

    $editpoint = $apiBaseUrl . '/api/companies/' . $entryId . '';
    $updatepoint = $apiBaseUrl . '/api/companies/edit/' . $entryId . '';

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
            'compName' => $_POST['compName'],
            'bio' => $_POST['bio']
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
            header('Location:../companies.php');
        } else {
            echo 'Failed to update data.';
        }
    }
    ?>
    <div class="container">
        <h1>Edit Company</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column-comp">
                    <label for="compName">Company name</label>
                    <label for="bio">Bio</label>
                </div>
                <div class="input-column-comp">
                    <input type="text" name="compName" value="<?php echo $data['compName']; ?>">
                    <input type="text" name="bio" value="<?php echo $data['bio']; ?>">
                </div>
            </div>
            <input type="submit" name="update" value="Update Entry">
        </form>
    </div>

</body>

</html>