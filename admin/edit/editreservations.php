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
    ?>

    <?php
    if (isset($_GET['id'])) {
        $entryId = $_GET['id'];
    } else {
        echo "Service broken, no ID";
    }

    $endpoint = '/api/reservations/get/all';
    $apiUrl = $apiBaseUrl . $endpoint;
    $delpoint = $apiBaseUrl . '/api/reservations/delete/';

    $editpoint = $apiBaseUrl . '/api/reservations/get/' . $entryId . '';
    $updatepoint = $apiBaseUrl . '/api/reservations/update/' . $entryId . '';

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
            'endTime' => $_POST['endTime']
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
            header('Location:../reservations.php');
        } else {
            echo 'Failed to update data.';
        }
    }
    ?>

    <div class="container">
        <h1>Edit Reservations</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
                    <label for="endTime">End Time</label>
                </div>
                <div class="input-column">
                    <input type="text" name="endTime" value="<?php echo $data['endTime']; ?>">
                </div>
            </div>
            <input type="submit" name="update" value="Update Entry">
        </form>
    </div>

</body>

</html>
=======
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
<?php
require('../db.php');
?>

<?php
if (isset($_GET['id'])) {
    $entryId = $_GET['id'];
} else {
    echo "Service broken, no ID";
}

$endpoint = '/api/reservations/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl . '/api/reservations/delete/';

$editpoint = $apiBaseUrl . '/api/reservations/get/' . $entryId . '';
$updatepoint = $apiBaseUrl . '/api/reservations/update/' . $entryId . '';

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
        'endTime' => $_POST['endTime']
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
        header('Location:../reservations.php');
    } else {
        echo 'Failed to update data.';
    }
}
?>

<form method="POST" action="">
    <div class="data-entry">
        <label for="endTime">End Time</label>
        <input type="text" name="endTime" value="<?php echo $data['endTime']; ?>">
    </div>

    <input type="submit" name="update" value="Update Entry">
</form>
<<<<<<< HEAD
>>>>>>> 65bf1d9... put edit and half of add
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
