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
$delpoint = $apiBaseUrl . '/api/client/delete/';
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
        'bankAccount' => $_POST['bankAccount'],
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
?>

<form method="POST" action="">
    <div class="data-entry">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $data['username']; ?>">
    </div>

    <div class="data-entry">
        <label for="password">Password</label>
        <input type="text" name="password" value="<?php echo $data['password']; ?>">
    </div>

    <div class="data-entry">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo $data['email']; ?>">
    </div>

    <div class="data-entry">
        <label for="bankAccount">Bank Account</label>
        <input type="text" name="bankAccount" value="<?php echo $data['bankAccount']; ?>">
    </div>

    <div class="data-entry">
        <label for="image">Image</label>
        <input type="text" name="image" value="<?php echo $data['image']; ?>">
    </div>

    <div class="data-entry">
        <label for="xp">XP</label>
        <input type="text" name="xp" value="<?php echo $data['xp']; ?>">
    </div>

    <div class="data-entry">
        <label for="level">Level</label>
        <input type="text" name="level" value="<?php echo $data['level']; ?>">
    </div>

    <input type="submit" name="update" value="Update Entry">
</form>
