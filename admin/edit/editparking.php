<?php
require('../db.php');

if (isset($_GET['id'])) {
    $entryId = $_GET['id'];
} else {
    echo "Service broken, no ID";
}

echo "<style>";
echo 'a { text-decoration: none; color:#333; }';
echo "</style>";

$endpoint = '/api/parking/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl . '/api/parking/delete/';
$editpoint = $apiBaseUrl . '/api/parking/get/' . $entryId . '';
$updatepoint = $apiBaseUrl . '/api/parking/update/' . $entryId . '';

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
        'address' => $_POST['address'],
        'price' => $_POST['price'],
        'isPremium' => $_POST['isPremium'] == "true" ? true : false,
<<<<<<< HEAD
        'partnerId' => $_POST['partnerId'],
        'maxSpotsCount' => $_POST['maxSpotsCount'],
        'spotsTaken' => $_POST['spotsTaken'],
        'isDisabled' => $_POST['isDisabled'] == "true" ? true : false,
        'endTime' => $_POST['endTime'],
        'startTime' => $_POST['startTime']
=======
        'partnerId' => (int)$_POST['partnerId'],
        'maxSpotsCount' => (int)$_POST['maxSpotsCount'],
        'spotsTaken' => (int)$_POST['spotsTaken'],
        'isDisabled' => $_POST['isDisabled'] == "true" ? true : false,
        'endTime' => (int)$_POST['endTime'],
        'startTime' => (int)$_POST['startTime']
>>>>>>> 65bf1d9... put edit and half of add
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
        header('Location: ../parking.php');
    } else {
        echo 'Failed to update data.';
    }
}
?>
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

    <div class="container">
        <h1>Edit Client</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
        <label for="address">Address</label>
        <label for="price">Price</label>
        <label for="isPremium">Is Premium</label>
        <label for="partnerId">Partner ID</label>
        <label for="maxSpotsCount">Max Spots Count</label>
        <label for="spotsTaken">Spots Taken</label>
        <label for="isDisabled">Is Disabled</label>
        <label for="endTime">End time</label>
        <label for="startTime">Start time</label>
        </div>
                <div class="input-column">
        <input type="text" name="address" value="<?php echo $data['address']; ?>">

        <input type="text" name="price" value="<?php echo $data['price']; ?>">

=======

<form method="POST" action="">
    <div class="data-entry">
        <label for="address">Address</label>
        <input type="text" name="address" value="<?php echo $data['address']; ?>">
    </div>

    <div class="data-entry">
        <label for="price">Price</label>
        <input type="text" name="price" value="<?php echo $data['price']; ?>">
    </div>

    <div class="data-entry">
        <label for="isPremium">Is Premium</label>
>>>>>>> 65bf1d9... put edit and half of add
        <select name="isPremium">
            <option value="true" <?php if ($data['isPremium']) echo 'selected'; ?>>True</option>
            <option value="false" <?php if (!$data['isPremium']) echo 'selected'; ?>>False</option>
        </select>
<<<<<<< HEAD

        <input type="text" name="partnerId" value="<?php echo $data['partnerId']; ?>">

        <input type="text" name="maxSpotsCount" value="<?php echo $data['maxSpotsCount']; ?>">

        <input type="text" name="spotsTaken" value="<?php echo $data['spotsTaken']; ?>">

=======
    </div>

    <div class="data-entry">
        <label for="partnerId">Partner ID</label>
        <input type="text" name="partnerId" value="<?php echo $data['partnerId']; ?>">
    </div>

    <div class="data-entry">
        <label for="maxSpotsCount">Max Spots Count</label>
        <input type="text" name="maxSpotsCount" value="<?php echo $data['maxSpotsCount']; ?>">
    </div>

    <div class="data-entry">
        <label for="spotsTaken">Spots Taken</label>
        <input type="text" name="spotsTaken" value="<?php echo $data['spotsTaken']; ?>">
    </div>

    <div class="data-entry">
        <label for="isDisabled">Is Disabled</label>
>>>>>>> 65bf1d9... put edit and half of add
        <select name="isDisabled">
            <option value="true" <?php if ($data['isDisabled']) echo 'selected'; ?>>True</option>
            <option value="false" <?php if (!$data['isDisabled']) echo 'selected'; ?>>False</option>
        </select>
<<<<<<< HEAD

        <input type="text" name="endTime" value="<?php echo $data['endTime']; ?>">

        <input type="text" name="startTime" value="<?php echo $data['startTime']; ?>">
        </div>
            </div>

    <input type="submit" name="update" value="Update Entry">
</form>
</div>



</body>

</html>
=======
    </div>
    <div class="data-entry">
        <label for="endTime">End time</label>
        <input type="text" name="endTime" value="<?php echo $data['endTime']; ?>">
    </div>

    <div class="data-entry">
        <label for="startTime">Start time</label>
        <input type="text" name="startTime" value="<?php echo $data['startTime']; ?>">
    </div>

    <input type="submit" name="update" value="Update Entry">
</form>
>>>>>>> 65bf1d9... put edit and half of add
