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

    <div class="container">
        <h1>Create a new Client</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
                    <label for="username">Username</label>
                    <label for="password">Password</label>
                    <label for="email">Email</label>
                </div>
                <div class="input-column">
                    <div class="data-entry">
                        <input type="text" name="username" value="username">
                    </div>
                    <div class="data-entry">
                        <input type="text" name="password" value="password">
                    </div>
                    <div class="data-entry">
                        <input type="text" name="email" value="email">
                    </div>
                </div>
            </div>
            <input type="submit" name="create" value="Create a new client">
        </form>
    </div>

</body>

</html>
=======
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be

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
<<<<<<< HEAD
>>>>>>> 65bf1d9... put edit and half of add
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
