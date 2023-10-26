<?php
require('../db.php');



echo "<style>";
echo 'a { text-decoration: none; color:#333; }';
echo "</style>";
$apiUrl = $apiBaseUrl;
$delpoint = $apiBaseUrl . '/api/client/delete/';

$addpoint = $apiBaseUrl . '/api/client/register';



if (isset($_POST['create'])) {
    $updateData = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email']
    ];

    // Send a PUT request to update the entry
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($updateData)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($addpoint, false, $context);

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
        <input type="text" name="username" value="username">
    </div>

    <div class="data-entry">
        <label for="password">Password</label>
        <input type="text" name="password" value="password">
    </div>

    <div class="data-entry">
        <label for="email">Email</label>
        <input type="text" name="email" value="email">
    </div>


    <input type="submit" name="create" value="Update Entry">
</form>
