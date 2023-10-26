<<<<<<< HEAD
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
    $endpoint = '/api/subscription/get/all';
    $apiUrl = $apiBaseUrl . $endpoint;
    $delpoint = $apiBaseUrl . '/api/subscription/delete/';

    $editpoint = $apiBaseUrl . '/api/subscription/get/' . $entryId . '';
    $updatepoint = $apiBaseUrl . '/api/subscription/update/premium-subscription/' . $entryId . '';

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
            'endDate' => $_POST['endDate'],
            'discountAmount' => $_POST['discountAmount']
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
            header('Location:../premiumsubs.php');
        } else {
            echo 'Failed to update data.';
        }
    }

    ?>

    <body>
        <div class="container">
            <h1>Edit Client</h1>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="label-column">
                        <label for="endDate">End date</label>
                        <label for="discountAmount">Discount amount</label>
                    </div>
                    <div class="input-column">
                        <input type="text" name="endDate" value="<?php echo $data['endDate']; ?>">
                        <input type="text" name="discountAmount" value="<?php echo $data['discountAmount']; ?>">
                    </div>
                </div>
                <input type="submit" name="update" value="Update Entry">
            </form>
        </div>
    </body>

</body>

</html>
=======
<?php
require('../db.php');
?>

<?php
if (isset($_GET['id'])) {
    $entryId = $_GET['id'];

} else {
   echo "Service broken, no ID";
}
$endpoint = '/api/subscription/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl .'/api/subscription/delete/';

$editpoint = $apiBaseUrl .'/api/subscription/get/'.$entryId.'';
$updatepoint = $apiBaseUrl .'/api/subscription/update/premium-subscription/'.$entryId.'';

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
        'endDate' => $_POST['endDate'],
        'discountAmount' => $_POST['discountAmount']
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
        header('Location:../premiumsubs.php');
    } else {
        echo 'Failed to update data.';
    }
}

?>
<form method="POST" action="">
    <div class="data-entry">
        <label for="endDate">End date</label>
        <input type="text" name="endDate" value="<?php echo $data['endDate']; ?>">
    </div>

    <div class="data-entry">
        <label for="discountAmount">Discount amount</label>
        <input type="text" name="discountAmount" value="<?php echo $data['discountAmount']; ?>">
    </div>

    <input type="submit" name="update" value="Update Entry">
</form>
>>>>>>> 12e5de8... updated some shit
