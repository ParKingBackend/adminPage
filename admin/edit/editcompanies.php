<?php
require('../db.php');
?>

<?php
if (isset($_GET['id'])) {
    $entryId = $_GET['id'];

} else {
<<<<<<< HEAD
<<<<<<< HEAD
    echo "Service broken, no ID";
}
$endpoint = '/api/companies/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl . '/api/companies/delete/';

$editpoint = $apiBaseUrl . '/api/companies/' . $entryId . '';
$updatepoint = $apiBaseUrl . '/api/companies/update/' . $entryId . '';
=======
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
   echo "Service broken, no ID";
}
$endpoint = '/api/companies/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl .'/api/companies/delete/';

$editpoint = $apiBaseUrl .'/api/companies/'.$entryId.'';
<<<<<<< HEAD
<<<<<<< HEAD
$updatepoint = $apiBaseUrl .'/api/companies/edit/'.$entryId.'';
>>>>>>> 12e5de8... updated some shit
=======
$updatepoint = $apiBaseUrl .'/api/companies/update/'.$entryId.'';
>>>>>>> 28d2c43... done without edit/add design
=======
$updatepoint = $apiBaseUrl .'/api/companies/update/'.$entryId.'';
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be

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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 28d2c43... done without edit/add design
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
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
<<<<<<< HEAD
<<<<<<< HEAD
        <h1>Edit Company</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="label-column">
                    <label for="compName">Company name</label>
                    <label for="bio">Bio</label>
                </div>
                <div class="input-column">
                    <input type="text" name="compName" value="<?php echo $data['compName']; ?>">
                    <input type="text" name="bio" value="<?php echo $data['bio']; ?>">
                </div>
            </div>
            <input type="submit" name="update" value="Update Entry">
        </form>
    </div>


</body>

</html>
=======
<form method="POST" action="">
    <div class="data-entry">
=======
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
        <h1>Edit Client</h1>
        <form method="POST" action="">
            <div class="form-row">
    <div class="label-column">
<<<<<<< HEAD
>>>>>>> 28d2c43... done without edit/add design
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
        <label for="compName">compName</label>
        <label for="bio">bio</label>
       
    </div>

    <div class="input-column">
        <input type="text" name="compName" value="<?php echo $data['compName']; ?>">
        <input type="text" name="bio" value="<?php echo $data['bio']; ?>">
    </div>

    <input type="submit" name="update" value="Update Entry">
</form>
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 12e5de8... updated some shit
=======
=======
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
</div>



</body>

<<<<<<< HEAD
</html>
>>>>>>> 28d2c43... done without edit/add design
=======
</html>
>>>>>>> 28d2c43d323f0e921f17cf3e3f32fd70a68b14be
