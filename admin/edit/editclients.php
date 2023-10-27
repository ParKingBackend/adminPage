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
$endpoint = '/api/client/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl . '/api/client/delete/'. $entryId .'';
$editpoint = $apiBaseUrl . '/api/client/get/' . $entryId . '';
$updatepoint = $apiBaseUrl . '/api/client/update/' . $entryId . '';

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
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'image' => $_POST['image'],
        'xp' => $_POST['xp'],
        'level' => $_POST['level']
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
        header('Location: ../clients.php');
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
        header('Location: ../clients.php');
    } else {
        echo 'Failed to delete data. Error: ' . error_get_last()['message']; // Display the error message
    }
}


?>
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
                    <label for="username">Username</label>
                    <label for="password">Password</label>
                    <label for="email">Email</label>
                    <label for="image">Image</label>
                    <label for="xp">XP</label>
                    <label for="level">Level</label>
                </div>
                <div class="input-column">
                    <input type="text" name="username" value="<?php echo $data['username']; ?>">
                    <input type="text" name="password" value="<?php echo $data['password']; ?>">
                    <input type="text" name="email" value="<?php echo $data['email']; ?>">
                    <input type="text" name="image" value="<?php echo $data['image']; ?>">
                    <input type="text" name="xp" value="<?php echo $data['xp']; ?>">
                    <input type="text" name="level" value="<?php echo $data['level']; ?>">
                </div>
            </div>

    <input type="submit" name="update" value="Update Entry">
    <input type="submit" name="delete" value="Delete entry">>

</form>
</div>



</body>

</html>