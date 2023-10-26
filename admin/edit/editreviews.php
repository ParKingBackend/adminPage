<?php
require('../db.php');
?>

<?php
if (isset($_GET['id'])) {
    $entryId = $_GET['id'];
} else {
    echo "Service broken, no ID";
}

$endpoint = '/api/review/get/all';
$apiUrl = $apiBaseUrl . $endpoint;
$delpoint = $apiBaseUrl . '/api/review/delete/';

$editpoint = $apiBaseUrl . '/api/review/get/' . $entryId . '';
$updatepoint = $apiBaseUrl . '/api/review/update/' . $entryId . '';

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
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'rating' => $_POST['rating'],

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
        header('Location:../reviews.php');
    } else {
        echo 'Failed to update data.';
    }
}
?>

<form method="POST" action="">
    <div class="data-entry">
    <div class="data-entry">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo $data['title']; ?>">
    </div>
        <label for="description">Description</label>
        <input type="text" name="description" value="<?php echo $data['description']; ?>">
    </div>
    <div class="data-entry">
        <label for="rating">Rating</label>
        <input type="number" name="rating" value="<?php echo $data['rating']; ?>">
    </div>


    <input type="submit" name="update" value="Update Entry">
</form>

